<?php
namespace Application\Permissions;

use Zend\Mvc\MvcEvent;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\Permissions\Acl\Acl;
use Zend\Permissions\Acl\Role\GenericRole as Role;
use Zend\Permissions\Acl\Resource\GenericResource as Resource;

use Zend\Db\Sql\Sql;
//use Zend\Db\Sql\Expression;

use Zend\Db\Adapter\Adapter;
use Zend\Console\Console;

class AclListener implements ListenerAggregateInterface{
    
    protected $listeners = array();
    protected $rolUsuarioDao;
    protected $permisosArray = array();
    /*public function __construct($dbauth){
        print_r($dbauth);
    }*/
    
    public function attach(EventManagerInterface $events, $priority = 100){
        $this->listeners[] = $events->attach(MvcEvent::EVENT_DISPATCH, array($this, 'onDispatch'), $priority);
    }
    
    public function detach(EventManagerInterface $events){
        foreach ($this->listeners as $index => $listener){
            if($events->detach($listener)){
                unset($this->listeners[$index]);
            }
        }
    }
    

    public function onDispatch(MvcEvent $e){
    	
    		//session_unset();
    		$app = $e->getParam('application');
    		$sm = $app->getServiceManager();
    		$config = $sm->get('config');
    		
    		$db_auth = new Adapter( $config ['db'] );
    		
    		$sql = new Sql($db_auth);
    		$selectRoles = $sql->select();
    		 
    		$selectRoles->from('rol');
    		$selectRoles->join(array('ra' => 'rol_aplicacion'),'rol.rol_id = ra.rol_id');
    		$selectRoles->join(array('a' => 'aplicacion'),'ra.apl_id = a.apl_id');
    		 
    		$statement = $sql->prepareStatementForSqlObject($selectRoles);
    		
    		$results = $statement->execute();
    		
    		$acl = new Acl();
    		
    		$permissionsArray=array();
    		
    		foreach($results as $rol){
    			$permissionsArray[$rol['rol_id']][$rol['apl_id']]=$rol['apl_descripcion'];
    		}
    		
    		$selectResource = $sql->select();
    		$selectResource->from('aplicacion');
    		$statement = $sql->prepareStatementForSqlObject($selectResource);
    		$results = $statement->execute();
    		 
    		foreach($results as $resource){
    			$acl->addResource(new Resource($resource['apl_descripcion']));
    		}
    		
    		foreach($permissionsArray as $rol_id=>$permission){
    			$acl->addRole(new Role($rol_id));
    			foreach($permission as $apl_id=>$resource){
    				$acl->allow($rol_id, $resource);
    				$this->permisosArray[$rol_id][]=$resource;
    			}
    		}
    		
    		if (isset($_SESSION['Zend_Auth']) && is_object($_SESSION['Zend_Auth'])){
    			$_SESSION['Zend_Auth']['storage']->menu=$this->permisosArray;
    		}
    		
    		$application = $e->getApplication();
    		$services = $application->getServiceManager();
    		$services->setService('AclService', $acl);
    		
    		$matches = $e->getRouteMatch();
    		
    		$controllerClass = $matches->getParam('controller');
    		$controllerArray = explode("\\", $controllerClass);
    		
    		$module = strtolower($controllerArray[0]);
    		$controller = strtolower($controllerArray[2]);
    		$action = $matches->getParam('action');
    		
    		$resourceName = $module . ':' . $controller;
    		
    		if(!$acl->isAllowed($this->getRole($services), $resourceName, $action)){
    			 
    			$matches->setParam('controller', 'Application\Controller\Error');
    			$matches->setParam('action','denied');
    		}
        
   }
    
    private function getRole($sm){
    	
        $auth = $sm->get('Application\Model\Login');
        
        if($auth->isLoggedIn()){
        	
            if(!empty($auth->getIdentity()->rol_id)){

                $role = $auth->getIdentity()->rol_id;
            } else {
                $auth->getIdentity()->rol_id = '1';
                $role = $auth->getIdentity()->rol_id;
            }
        }else{
            $role = '1';
        }
        return $role;
    }
    
}