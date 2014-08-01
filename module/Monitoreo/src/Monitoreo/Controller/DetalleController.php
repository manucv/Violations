<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonModule for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Monitoreo\Controller;

use Zend\Mvc\Controller\AbstractActionController;
//use Zend\View\Model\ViewModel;

class DetalleController extends AbstractActionController
{
	protected $sitioDao;
	protected $componenteDao;
	
    public function detalleAction(){
    	
    	$sit_id = ( int ) $this->params ()->fromRoute ( 'id', 0 );
    	
   		$sitios = $this->getSitioDao()->traer($sit_id);
   		
   		$componentes = array();
    		 
   		if(count($sitios) > 0){
	   		$componentes[$sitios->getSit_id()] = $this->getComponenteDao()->traerPorSitio($sitios->getSit_id());
	   		$sitios = $this->getSitioDao()->traer( $sit_id );
   		}else{
   			$sitios = array();
   		}
   		
   		return array('sitio' => $sitios, 'componentes' => $componentes);
    	
    }
    
    public function getSitioDao()
    {
    	if (!$this->sitioDao) {
    		$sm = $this->getServiceLocator();
    		$this->sitioDao = $sm->get('Application\Model\Dao\SitioDao');
    	}
    	return $this->sitioDao;
    }
    
    public function getComponenteDao()
    {
    	if (!$this->componenteDao) {
    		$sm = $this->getServiceLocator();
    		$this->componenteDao = $sm->get('Application\Model\Dao\ComponenteDao');
    	}
    	return $this->componenteDao;
    }
    
}