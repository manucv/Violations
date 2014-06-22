<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonModule for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Vehiculo\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class VehiculoController extends AbstractActionController
{
	
	protected $vehiculoDao;
	
    public function indexAction()
    {
        return array();
    }
    
    public function listadoAction(){
    	$camara = $this->getVehiculoDao()->traerTodosConCamara();
    	$listado = $this->getVehiculoDao()->traerTodos();
    	
    	return $viewModel = new ViewModel ( array (
    			'camara' => $camara ,
    			'vehiculos' => $listado
    	) );
    	
    }
    
    public function camaraAction(){
    	
    	$veh_id = (int) $this->params()->fromRoute('id',0);
    	
    	if(!$veh_id){
    		return $this->redirect()->toRoute('vehiculo', array('controller' => 'vehiculo', 'action' => 'listado'));
    	}
    	
    	$vehiculo = $this->getVehiculoDao()->traer($veh_id);
    	$dispositivos = $this->getDispositivoDao()->traerTodosPorVehiculo($veh_id);
    	
    	return  new ViewModel ( array (
    			'vehiculo' => $vehiculo ,
    			'dispositivos' => $dispositivos
    	) );
    	
    }
    
	public function getVehiculoDao() {
		if (!$this->vehiculoDao) {
			$sm = $this->getServiceLocator();
			$this->vehiculoDao = $sm->get('Application\Model\Dao\VehiculoDao');
		}
		return $this->vehiculoDao;
	}
	
	public function getDispositivoDao() {
		if (!$this->dispositivoDao) {
			$sm = $this->getServiceLocator();
			$this->dispositivoDao = $sm->get('Application\Model\Dao\DispositivoDao');
		}
		return $this->dispositivoDao;
	}
}
