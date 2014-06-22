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
use Zend\View\Model\ViewModel;

class ControlController extends AbstractActionController
{
	protected $sitioDao;
	
    public function controlAction(){
    	
    	$sitios = $this->getSitioDao()->traerTodos();
    	
    	$componentes = array();
    	
    	foreach ($sitios as $sitio){
    		$componentes[$sitio->getSit_id()] = $this->getComponenteDao()->traerPorSitio($sitio->getSit_id());
    	}
    	
//     	$domain = '200.124.254.216';
//     	$resultados = $this->getPing($domain);

    	foreach ($componentes as $det_com => $val_com){ //INFORMACION DE SITIO
    		foreach ($val_com as $det_com2 => $val_com2){ //INFORMACION DE COMPONENTES
	    		foreach ($val_com2 as $det_com3 => $val_com3){ //INFORMACION DE COMPONENTES
	    			if(strtolower($det_com3) == 'com_ip_local'){
	    				if(!empty($val_com3) && !is_null($val_com3)){
	    					$componentes[$det_com][$det_com2]['output_local'] = $this->getPing($val_com3);
	    				}
	    			}
	    			
	    			if(strtolower($det_com3) == 'com_ip_publica'){
	    				if(!empty($val_com3) && !is_null($val_com3)){
	    					$componentes[$det_com][$det_com2]['output_publica'] = $this->getPing($val_com3);
	    				}
	    			}
	    		}
    		}
    	}
    	 
        return array('sitios' => $this->getSitioDao()->traerTodos(), 'componentes' => $componentes);
    }
    
    public function pingAction(){
    	
    	/* $domain = '200.124.254.216';
    	//$domain = '192.168.0.101';
    	
    	$id = ( int ) $this->params ()->fromRoute ( 'id', 0 );
    	
	    $resultados = $this->getPing($domain);
	    
	    $sitios = $this->getSitioDao()->traerTodos();
	    $componentes = array();
	    foreach ($sitios as $sitio){
	    	$componentes[$sitio->getSit_id()] = $this->getComponenteDao()->traerPorSitio($sitio->getSit_id());
	    }
	
	   	$modelView = new ViewModel ( array ('sitios' => $this->getSitioDao()->traerTodos(), 'componentes' => $componentes, 'totalPing' => $replyTotal, 'respuesta' => $output, 'sitio' => $id) );
	   	$modelView->setTemplate ( 'monitoreo/control/control' );
	   	return $modelView; */
    }
    
    public function getPing($domain){
    	
    	$output = 'No existe una ip';
    	$replyTotal = 0;
    	$resultados = array();
    	
    	if(filter_var($domain, FILTER_VALIDATE_IP)){
    		$comando = "ping " . $domain;
    		$output = shell_exec($comando);
    		$replyTotal = substr_count($output, 'Reply');
    	}
    	
    	$resultados['output'] = $output;
    	$resultados['total'] = $replyTotal;
    	
    	return $resultados;
    	
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