<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace Application;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Validator\AbstractValidator;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\ConsoleUsageProviderInterface;
use Zend\Console\Adapter\AdapterInterface as Console;
use Application\Model\Entity\Usuario;
use Application\Model\Dao\UsuarioDao;
use Application\Model\Entity\RolUsuario;
use Application\Model\Dao\RolUsuarioDao;
use Application\Model\Login;
use Application\Controller\LoginController;
use Application\Permissions\AclListener;
use Application\Model\Entity\Sitio;
use Application\Model\Dao\SitioDao;
use Application\Model\Entity\Componente;
use Application\Model\Dao\ComponenteDao;
use Application\Model\Entity\Pais;
use Application\Model\Dao\PaisDao;
use Application\Model\Entity\Estado;
use Application\Model\Dao\EstadoDao;
use Application\Model\Entity\Ciudad;
use Application\Model\Dao\CiudadDao;
use Application\Model\Entity\Rol;
use Application\Model\Dao\RolDao;
use Application\Model\Entity\Aplicacion;
use Application\Model\Dao\AplicacionDao;
use Application\Model\Entity\RolAplicacion;
use Application\Model\Dao\RolAplicacionDao;
use Application\Model\Entity\TipoComponente;
use Application\Model\Dao\TipoComponenteDao;
use Application\Model\Entity\TipoInfraccion;
use Application\Model\Dao\TipoInfraccionDao;
use Application\Model\Entity\TipoVehiculo;
use Application\Model\Dao\TipoVehiculoDao;
use Application\Model\Entity\Vehiculo;
use Application\Model\Dao\VehiculoDao;
use Application\Model\Entity\Dispositivo;
use Application\Model\Dao\DispositivoDao;
use Application\Model\Entity\Parqueadero;
use Application\Model\Dao\ParqueaderoDao;
use Application\Model\Entity\Sector;
use Application\Model\Dao\SectorDao;
use Application\Model\Entity\Infraccion;
use Application\Model\Dao\InfraccionDao;
use Application\Model\Entity\MultaParqueadero;
use Application\Model\Dao\MultaParqueaderoDao;
use Application\Model\Entity\Automovil;
use Application\Model\Dao\AutomovilDao;
use Application\Model\Entity\LogParqueadero;
use Application\Model\Dao\LogParqueaderoDao;
use Application\Model\Entity\Cliente;
use Application\Model\Dao\ClienteDao;
use Application\Model\Entity\Categoria;
use Application\Model\Dao\CategoriaDao;
use Application\Model\Entity\Establecimiento;
use Application\Model\Dao\EstablecimientoDao;

class Module implements AutoloaderProviderInterface, ConfigProviderInterface, ConsoleUsageProviderInterface{
	public function onBootstrap(MvcEvent $e) {
		
		//AYUDA A QUE SE VALIDEN LOS ERRORES DEL FORMULARIO
		$translator = $e->getApplication()->getServiceManager()->get('translator');
		AbstractValidator::setDefaultTranslator($translator);
		
		$eventManager = $e->getApplication ()->getEventManager ();
		$moduleRouteListener = new ModuleRouteListener ();
		$moduleRouteListener->attach ( $eventManager );
		
		$app = $e->getParam('application');
		$app->getEventManager()->attach('dispatch', array($this, 'initAuth'), 100);
		
		$aclListener = new AclListener();
		$aclListener->attach($eventManager);
		
		$eventManager->getSharedManager()->attach('Zend\Mvc\Controller\AbstractActionController', 'dispatch', function($e) {
			$controller      = $e->getTarget();
			$controllerClass = get_class($controller);
			$moduleNamespace = substr($controllerClass, 0, strpos($controllerClass, '\\'));
			$config          = $e->getApplication()->getServiceManager()->get('config');
			if (isset($config['module_layouts'][$moduleNamespace])) {
				$controller->layout($config['module_layouts'][$moduleNamespace]);
			}
		}, 100);
		$moduleRouteListener = new ModuleRouteListener();
		$moduleRouteListener->attach($eventManager);
		
	}
	public function getConfig() {
		return include __DIR__ . '/config/module.config.php';
	}
	public function getAutoloaderConfig() {
		return array (
				'Zend\Loader\StandardAutoloader' => array (
						'namespaces' => array (
								__NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__ 
						) 
				) 
		);
	}
	
	public function initAuth(MvcEvent $e){
		$application = $e->getApplication();
        $matches = $e->getRouteMatch();
        $controller = $matches->getParam('controller');
        $action = $matches->getParam('action');
		
        if(0 === strpos($controller, __NAMESPACE__, 0)){
        	switch($controller){
        		case 'Application\Controller\Login':
        			if(in_array($action, array('index', 'autenticar'))){
        				return;
        			}
        			break;
        
        		case 'Application\Controller\Error':
        			return;
        			break;

        		case 'Application\Controller\Index':
        				return;
        				break;
        				
        		case 'Console\Controller\Index':
        				return;
	        			break;	
	        	
        	}
        }
        
		$sm = $application->getServiceManager();
		$auth = $sm->get('Application\Model\Login');
		if($controller != 'Api\Controller\Api' ){
			if(!$auth->isLoggedIn()){
				$matches->setParam('controller', 'Application\Controller\Login');
				$matches->setParam('action', 'index');
			}
		}
	}
	
	public function getServiceConfig() {
		return array (
				'factories' => array (
						'Application\Model\Login' => function ($sm){
							$config = $sm->get ( 'config' );
							$db_auth = new \Zend\Db\Adapter\Adapter ( $config ['db'] );
							return new Login($db_auth);
						},

						'Application\Permissions\AclListener' => function ($sm){
							$config = $sm->get ( 'config' );
							$db_auth = new \Zend\Db\Adapter\Adapter ( $config ['db'] );
							return new AclListener($db_auth);
						},
						
		                'Application\Model\Dao\RolUsuarioDao' => function($sm){
		                	$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
		                	$resultSetPrototype = new ResultSet();
		                	$resultSetPrototype->setArrayObjectPrototype(new RolUsuario());
		                	$tableGateway = new TableGateway('rol_usuario', $dbAdapter, null, $resultSetPrototype);
		                	return new RolUsuarioDao($tableGateway);
		                },
		                
		                'Application\Model\Dao\UsuarioDao' => function($sm){
		                	$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
		                	$resultSetPrototype = new ResultSet();
		                	$resultSetPrototype->setArrayObjectPrototype(new Usuario());
		                	$tableGateway = new TableGateway('usuario', $dbAdapter, null, $resultSetPrototype);
		                	return new UsuarioDao($tableGateway);
		                },
		                
		                'Application\Model\Dao\SitioDao' => function($sm){
		                	$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
		                	$resultSetPrototype = new ResultSet();
		                	$resultSetPrototype->setArrayObjectPrototype(new Sitio());
		                	$tableGateway = new TableGateway('sitio', $dbAdapter, null, $resultSetPrototype);
		                	return new SitioDao($tableGateway);
		                },
		                
		                'Application\Model\Dao\ComponenteDao' => function($sm){
		                	$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
		                	$resultSetPrototype = new ResultSet();
		                	$resultSetPrototype->setArrayObjectPrototype(new Componente());
		                	$tableGateway = new TableGateway('componente', $dbAdapter, null, $resultSetPrototype);
		                	return new ComponenteDao($tableGateway);
		                },
		                
		                'Application\Model\Dao\PaisDao' => function($sm){
		                	$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
		                	$resultSetPrototype = new ResultSet();
		                	$resultSetPrototype->setArrayObjectPrototype(new Pais());
		                	$tableGateway = new TableGateway('pais', $dbAdapter, null, $resultSetPrototype);
		                	return new PaisDao($tableGateway);
		                },
		                
		                'Application\Model\Dao\EstadoDao' => function($sm){
		                	$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
		                	$resultSetPrototype = new ResultSet();
		                	$resultSetPrototype->setArrayObjectPrototype(new Estado());
		                	$tableGateway = new TableGateway('estado', $dbAdapter, null, $resultSetPrototype);
		                	return new EstadoDao($tableGateway);
		                },
		                
		                'Application\Model\Dao\CiudadDao' => function($sm){
		                	$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
		                	$resultSetPrototype = new ResultSet();
		                	$resultSetPrototype->setArrayObjectPrototype(new Ciudad());
		                	$tableGateway = new TableGateway('ciudad', $dbAdapter, null, $resultSetPrototype);
		                	return new CiudadDao($tableGateway);
		                },
		                
		                'Application\Model\Dao\RolDao' => function($sm){
		                	$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
		                	$resultSetPrototype = new ResultSet();
		                	$resultSetPrototype->setArrayObjectPrototype(new Rol());
		                	$tableGateway = new TableGateway('rol', $dbAdapter, null, $resultSetPrototype);
		                	return new RolDao($tableGateway);
		                },
		                
		                'Application\Model\Dao\AplicacionDao' => function($sm){
		                	$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
		                	$resultSetPrototype = new ResultSet();
		                	$resultSetPrototype->setArrayObjectPrototype(new Aplicacion());
		                	$tableGateway = new TableGateway('aplicacion', $dbAdapter, null, $resultSetPrototype);
		                	return new AplicacionDao($tableGateway);
		                },
		                
		                'Application\Model\Dao\RolAplicacionDao' => function($sm){
		                	$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
		                	$resultSetPrototype = new ResultSet();
		                	$resultSetPrototype->setArrayObjectPrototype(new RolAplicacion());
		                	$tableGateway = new TableGateway('rol_aplicacion', $dbAdapter, null, $resultSetPrototype);
		                	return new RolAplicacionDao($tableGateway);
		                },
		                
		                'Application\Model\Dao\TipoComponenteDao' => function($sm){
		                	$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
		                	$resultSetPrototype = new ResultSet();
		                	$resultSetPrototype->setArrayObjectPrototype(new TipoComponente());
		                	$tableGateway = new TableGateway('tipo_componente', $dbAdapter, null, $resultSetPrototype);
		                	return new TipoComponenteDao($tableGateway);
		                },
		                
		                'Application\Model\Dao\TipoInfraccionDao' => function($sm){
		                	$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
		                	$resultSetPrototype = new ResultSet();
		                	$resultSetPrototype->setArrayObjectPrototype(new TipoInfraccion());
		                	$tableGateway = new TableGateway('tipo_infraccion', $dbAdapter, null, $resultSetPrototype);
		                	return new TipoInfraccionDao($tableGateway);
		                },
		                
		                'Application\Model\Dao\TipoVehiculoDao' => function($sm){
		                	$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
		                	$resultSetPrototype = new ResultSet();
		                	$resultSetPrototype->setArrayObjectPrototype(new TipoVehiculo());
		                	$tableGateway = new TableGateway('tipo_vehiculo', $dbAdapter, null, $resultSetPrototype);
		                	return new TipoVehiculoDao($tableGateway);
		                },
		                
		                'Application\Model\Dao\VehiculoDao' => function($sm){
		                	$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
		                	$resultSetPrototype = new ResultSet();
		                	$resultSetPrototype->setArrayObjectPrototype(new Vehiculo());
		                	$tableGateway = new TableGateway('vehiculo', $dbAdapter, null, $resultSetPrototype);
		                	return new VehiculoDao($tableGateway);
		                },
		                
		                'Application\Model\Dao\DispositivoDao' => function($sm){
		                	$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
		                	$resultSetPrototype = new ResultSet();
		                	$resultSetPrototype->setArrayObjectPrototype(new Dispositivo());
		                	$tableGateway = new TableGateway('dispositivo', $dbAdapter, null, $resultSetPrototype);
		                	return new DispositivoDao($tableGateway);
		                },
		                
		                'Application\Model\Dao\ParqueaderoDao' => function($sm){
		                	$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
		                	$resultSetPrototype = new ResultSet();
		                	$resultSetPrototype->setArrayObjectPrototype(new Parqueadero());
		                	$tableGateway = new TableGateway('parqueadero', $dbAdapter, null, $resultSetPrototype);
		                	return new ParqueaderoDao($tableGateway);
		                },
		                
		                'Application\Model\Dao\SectorDao' => function($sm){
		                	$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
		                	$resultSetPrototype = new ResultSet();
		                	$resultSetPrototype->setArrayObjectPrototype(new Sector());
		                	$tableGateway = new TableGateway('sector', $dbAdapter, null, $resultSetPrototype);
		                	return new SectorDao($tableGateway);
		                },
		                
		                'Application\Model\Dao\InfraccionDao' => function($sm){
		                	$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
		                	$resultSetPrototype = new ResultSet();
		                	$resultSetPrototype->setArrayObjectPrototype(new Infraccion());
		                	$tableGateway = new TableGateway('infraccion', $dbAdapter, null, $resultSetPrototype);
		                	return new InfraccionDao($tableGateway);
		                },		  

  		                'Application\Model\Dao\MultaParqueaderoDao' => function($sm){
		                	$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
		                	$resultSetPrototype = new ResultSet();
		                	$resultSetPrototype->setArrayObjectPrototype(new MultaParqueadero());
		                	$tableGateway = new TableGateway('multa_parqueadero', $dbAdapter, null, $resultSetPrototype);
		                	return new MultaParqueaderoDao($tableGateway);
		                },

  		                'Application\Model\Dao\AutomovilDao' => function($sm){
		                	$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
		                	$resultSetPrototype = new ResultSet();
		                	$resultSetPrototype->setArrayObjectPrototype(new Automovil());
		                	$tableGateway = new TableGateway('automovil', $dbAdapter, null, $resultSetPrototype);
		                	return new AutomovilDao($tableGateway);
		                },		                
		                
		                'Application\Model\Dao\LogParqueaderoDao' => function($sm){
		                	$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
		                	$resultSetPrototype = new ResultSet();
		                	$resultSetPrototype->setArrayObjectPrototype(new LogParqueadero());
		                	$tableGateway = new TableGateway('log_parqueadero', $dbAdapter, null, $resultSetPrototype);
		                	return new LogParqueaderoDao($tableGateway);
		                },

		                'Application\Model\Dao\ClienteDao' => function($sm){
		                	$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
		                	$resultSetPrototype = new ResultSet();
		                	$resultSetPrototype->setArrayObjectPrototype(new Cliente());
		                	$tableGateway = new TableGateway('cliente', $dbAdapter, null, $resultSetPrototype);
		                	return new ClienteDao($tableGateway);
		                },

		                'Application\Model\Dao\CategoriaDao' => function($sm){
		                	$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
		                	$resultSetPrototype = new ResultSet();
		                	$resultSetPrototype->setArrayObjectPrototype(new Categoria());
		                	$tableGateway = new TableGateway('categoria', $dbAdapter, null, $resultSetPrototype);
		                	return new CategoriaDao($tableGateway);
		                },		  

  		                'Application\Model\Dao\EstablecimientoDao' => function($sm){
		                	$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
		                	$resultSetPrototype = new ResultSet();
		                	$resultSetPrototype->setArrayObjectPrototype(new Establecimiento());
		                	$tableGateway = new TableGateway('establecimiento', $dbAdapter, null, $resultSetPrototype);
		                	return new EstablecimientoDao($tableGateway);
		                },	
				),
		);
	}
	
	public function getControllerConfig(){
		return array(
				'factories' => array(
						'Application\Controller\Login' => function ($sm){
							$controller = new LoginController();
							$locator = $sm->getServiceLocator();
							$controller->setLogin($locator->get('Application\Model\Login'));
							return $controller;
						},
				)
		);
	}
	
	public function getConsoleUsage(Console $console)
	{
		return array(
				// Describe available commands
				'user resetpassword [--verbose|-v] EMAIL PASSWORD'    => 'Reset password for a user',
	
				// Describe expected parameters
				array( 'EMAIL',            'Email of the user for a password reset' ),
				array( '--verbose|-v',     '(optional) turn on verbose mode'        ),
				array( 'PASSWORD',     'Valid Password to execute the cron job'     ),
		);
	}
}