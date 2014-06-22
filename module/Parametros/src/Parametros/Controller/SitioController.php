<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonModule for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Parametros\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Model\Entity\Sitio as SitioEntity;
use Parametros\Form\Sitio;
use Parametros\Form\SitioValidator;

class SitioController extends AbstractActionController
{
	protected $sitioDao;
	protected $ciudadDao;
	
    public function listadoAction(){
        return array('sitios' => $this->getSitioDao()->traerTodos());
    }
    
    public function ingresarAction(){
    	
    	$form = $this->getForm ();
    	
    	//FORMULARIO DE INGRESO DE INFORMACION
    	return new ViewModel ( array (
    			'formulario' => $form ,
    	) );
    }
    
    public function editarAction(){
    
    	$id = ( int ) $this->params ()->fromRoute ( 'id', 0 );
    	$form = $this->getForm ();
    
    	//FORMULARIO DE ACTUALIZACION DE INFORMACION
    	$sitio = $this->getSitioDao()->traer ( $id );
    	$form->bind ( $sitio );
    		
    	$form->get ( 'ingresar' )->setAttribute ( 'value', 'Actualizar' );
    	$form->get ( 'sit_id' )->setAttribute ( 'value', $sitio->getSit_id() );
    		
    	$view = new ViewModel ( array (
    			'formulario' => $form ,
    	) );
    
    	$view->setTemplate('parametros/sitio/ingresar');
    	return $view;
    }
    
    public function eliminarAction(){
    
    	$id = ( int ) $this->params ()->fromRoute ( 'id', 0 );
    	
    	//SE ELIMINA LA INFORMACION EN LA BDD
    	if($this->getSitioDao() ->eliminar ( $id )){
            //SI SE EJECUTO EXITOSAMENTE SE REGRESA AL LISTADO DE CONTACTOS
            return $this->redirect ()->toRoute ( 'parametros', array (
                    'controller' => 'sitio',
                    'action' => 'listado'
            ) );            
        }
        /* else{
            $view = new ViewModel ();
        
            $view->setTemplate('parametros/sitio/errorBorrado');
            return $view;  
        } */
    	

    }
    
    public function validarAction(){

    	//VERIFICA QUE SE HAYA REALIZADO UN POST DE INFORMACION
    	if (! $this->request->isPost ()) {
    		return $this->redirect ()->toRoute ( 'parametros', array (
    				'controller' => 'sitio',
    				'action' => 'listado'
    		) );
    	}
    	
    	//CAPTURA LA INFORMACION ENVIADA EN EL POST
    	$data = $this->request->getPost ();
    	
    	//VERIFICA EL IDIOMA INGRESADO PARA TRAER EL FORMULARIO SEGUN EL IDIOMA
    	$form = $this->getForm();
    	
    	//SE VALIDA EL FORMULARIO
    	$form->setInputFilter ( new SitioValidator() );
    	
    	//SE LLENAN LOS DATOS DEL FORMULARIO
    	$form->setData ( $data );
    	
    	//SE VALIDA EL FORMULARIO ES CORRECTO
    	if (! $form->isValid ()) {
    		// SI EL FORMULARIO NO ES CORRECTO
    		$modelView = new ViewModel ( array (
    				'formulario' => $form ,
    		) );
    			
    		$modelView->setTemplate ( 'parametros/sitio/ingresar' );
    		return $modelView;
    	}
    	
    	//->AQUI EL FORMULARIO ES CORRECTO, SE VALIDO CORRECTAMENTE
    	
    	//SE GENERA EL OBJETO DE CONTACTO
    	$sitio = new SitioEntity();
    	//SE CARGA LA ENTIDAD CON LA INFORMACION DEL POST
    	$sitio->exchangeArray ( $data );
    	
    	//SE GRABA LA INFORMACION EN LA BDD
    	$this->getSitioDao() ->guardar ( $sitio );
    	
    	//SI SE EJECUTO EXITOSAMENTE SE REGRESA AL LISTADO DE CONTACTOS
    	return $this->redirect ()->toRoute ( 'parametros', array (
    			'controller' => 'sitio',
    			'action' => 'listado'
    	) );
    }
    
    /**
     * Ajax action that returns the dynamic form field
     */
   /*  public function newfieldAction() {
    	
    	if($this->getRequest()->isXmlHttpRequest()){
    		$id = $this->request->getPost('id');
    		
    		$element = new Zend\Form\Element\Text("newName$id");
    		
    		//$element = new Zend_Form_Element_Text("newName$id");
    		$element->setRequired(true)->setLabel('Name');
    		
    		//$this->view->field = $element->__toString();
    		
    	
    	}else{
    		return $this->redirect()->toRoute('contactos', array('contactos' => 'ingresar'));
    	}
    
    	//$ajaxContext = $this->helper->getHelper('AjaxContext');
    	
    	//$ajaxContext->addActionContext('newfield', 'html')->initContext();
    
//     	$id = $this->_getParam('id', null);
    
//     	$element = new Zend_Form_Element_Text("newName$id");
//     	$element->setRequired(true)->setLabel('Name');
    
//     	$this->view->field = $element->__toString();
    } */
    
	public function getForm() {
		$form = new Sitio();
		$form->get ( 'ciu_id' )->setValueOptions ( $this->getCiudadDao ()->traerTodosArreglo () );
		return $form;
	}
    
    public function getSitioDao() {
    	if (! $this->sitioDao) {
    		$sm = $this->getServiceLocator ();
    		$this->sitioDao = $sm->get ( 'Application\Model\Dao\SitioDao' );
    	}
    	return $this->sitioDao;
    }
    
    public function getCiudadDao() {
    	if (! $this->ciudadDao) {
    		$sm = $this->getServiceLocator ();
    		$this->ciudadDao = $sm->get ( 'Application\Model\Dao\CiudadDao' );
    	}
    	return $this->ciudadDao;
    }

}