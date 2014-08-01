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
use Monitoreo\Form\Localidad;
use Monitoreo\Form\LocalidadValidator;

class ControlController extends AbstractActionController
{
	protected $sitioDao;
	protected $componenteDao;
	protected $paisDao;
	protected $estadoDao;
	protected $ciudadDao;
	
	public function buscarAction(){
		return array('formulario' =>  $this->getForm());
	}
	
	public function generalAction(){
		
		$data = $this->getComponenteDao()->traerRegistrosHastaCiudad();

		$arreglo = array();
		
		foreach($data as $row){
			$arreglo[$row['pai_id']]['nombre']=$row['pai_nombre_es'];
			$arreglo[$row['pai_id']]['estado'][$row['est_id']]['nombre']=$row['est_nombre_es'];
			$arreglo[$row['pai_id']]['estado'][$row['est_id']]['ciudades'][$row['ciu_id']]['nombre']=$row['ciu_nombre_es'];
			$arreglo[$row['pai_id']]['estado'][$row['est_id']]['ciudades'][$row['ciu_id']]['sitios'][$row['sit_id']]['nombre']=$row['sit_descripcion'];
			$arreglo[$row['pai_id']]['estado'][$row['est_id']]['ciudades'][$row['ciu_id']]['sitios'][$row['sit_id']]['estado']=$row['sit_estado'];
			$arreglo[$row['pai_id']]['estado'][$row['est_id']]['ciudades'][$row['ciu_id']]['sitios'][$row['sit_id']]['referencia']=$row['sit_reference_number'];
			$arreglo[$row['pai_id']]['estado'][$row['est_id']]['ciudades'][$row['ciu_id']]['sitios'][$row['sit_id']]['componentes'][$row['com_id']]['nombre']=$row['com_descripcion'];
			$arreglo[$row['pai_id']]['estado'][$row['est_id']]['ciudades'][$row['ciu_id']]['sitios'][$row['sit_id']]['componentes'][$row['com_id']]['estado']=$row['com_estado'];
		} 
			
		return array('data' => $arreglo);
		
	}
	
    public function controlAction(){
    	
    	$form = $this->getForm();
    	
    	//VERIFICA QUE SE HAYA REALIZADO UN POST DE INFORMACION
    	if ( ! $this->request->isPost () ) {
    		return $this->redirect ()->toRoute ( 'monitoreo', array (
    				'controller' => 'control',
    				'action' => 'buscar'
    		) );
    	}
    	
    	//CAPTURA LA INFORMACION ENVIADA EN EL POST
    	$data = $this->request->getPost ();
    	
    	//SE VALIDA EL FORMULARIO
    	$form->setInputFilter ( new LocalidadValidator() );
    	
    	//SE LLENAN LOS DATOS DEL FORMULARIO
    	$form->setData ( $data );
    	
    	$form->get('pai_id')->setValue($data['pai_id']);
    	$form->get('pai_id_hidden')->setValue($data['pai_id']);
    	$form->get('est_id_hidden')->setValue($data['est_id']);
    	$form->get('ciu_id_hidden')->setValue($data['ciu_id']);
    	
    	//SE VALIDA EL FORMULARIO ES CORRECTO
    	if (! $form->isValid ()) {
    		// SI EL FORMULARIO NO ES CORRECTO
    		$modelView = new ViewModel ( array (
    				'formulario' => $form ,
    		) );
    	
    		$modelView->setTemplate ( 'monitoreo/control/buscar' );
    		return $modelView;
    	}
    		
   		//->AQUI EL FORMULARIO ES CORRECTO, SE VALIDO CORRECTAMENTE
    		
   		$sitios = $this->getSitioDao()->traerTodosPorCiudad( $data['ciu_id'] );
    		 
   		$componentes = array();
    		 
   		if(count($sitios) > 0){
	   		foreach ($sitios as $sitio){
	   			$componentes[$sitio->getSit_id()] = $this->getComponenteDao()->traerPorSitio($sitio->getSit_id());
	   		}
	   		$sitios = $this->getSitioDao()->traerTodos();
   		}else{
   			$sitios = array();
   		}
    		
   		return array('sitios' => $sitios, 'componentes' => $componentes, 'formulario' =>  $form);
    	
    }
    
    public function getForm(){
   		$form = new Localidad();
   		$form->get ( 'pai_id' )->setValueOptions ( $this->getPaisDao()->traerTodosArreglo() );
    	return $form;
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
    
    public function getPaisDao(){
    	if (!$this->paisDao) {
    		$sm = $this->getServiceLocator();
    		$this->paisDao = $sm->get('Application\Model\Dao\PaisDao');
    	}
    	return $this->paisDao;
    }
    
    public function getEstadoDao(){
    	if (!$this->estadoDao) {
    		$sm = $this->getServiceLocator();
    		$this->estadoDao = $sm->get('Application\Model\Dao\EstadoDao');
    	}
    	return $this->estadoDao;
    }
    
    public function getCiudadDao(){
    	if (!$this->ciudadDao) {
    		$sm = $this->getServiceLocator();
    		$this->ciudadDao = $sm->get('Application\Model\Dao\CiudadDao');
    	}
    	return $this->ciudadDao;
    }
    
    public function sucursalesAjaxAction(){
    	if($this->getRequest()->isXmlHttpRequest()){
    		$pais = $this->request->getPost('pais');
    		$data = $this->getEstadoDao()->getEstadosPorPais($pais);
    			
    		$jsonData = json_encode($data);
    		$response = $this->getResponse();
    		$response->setStatusCode(200);
    		$response->setContent($jsonData);
    			
    		return $response;
    	}else{
    		return $this->redirect()->toRoute('monitoreo', array('control' => 'control'));
    	}
    }
    
    public function ciudadesAjaxAction(){
    	if($this->getRequest()->isXmlHttpRequest()){
    		$estado = $this->request->getPost('estado');
    		$data = $this->getCiudadDao()->getCiudadesPorEstado($estado);
    
    		$jsonData = json_encode($data);
    		$response = $this->getResponse();
    		$response->setStatusCode(200);
    		$response->setContent($jsonData);
    
    		return $response;
    	}else{
    		return $this->redirect()->toRoute('monitoreo', array('control' => 'control'));
    	}
    }
    
}