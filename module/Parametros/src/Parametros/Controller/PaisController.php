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
use Parametros\Form\Pais;
use Parametros\Form\PaisValidator;
use Application\Model\Entity\Pais as PaisEntity;

class PaisController extends AbstractActionController
{
	protected $paisDao;
	
	public function indexAction(){
		return $this->redirect ()->toRoute ( 'parametros', array (
				'controller' => 'pais',
				'action' => 'listado'
		) );
	}
	
    public function listadoAction()
    {
        return array('pais' => $this->getPaisDao()->traerTodos());
    }
    
    public function ingresarAction(){
    	
    	$id = ( int ) $this->params ()->fromRoute ( 'id', 0 );
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
    	$pais = $this->getPaisDao()->traer ( $id );
    	$form->bind ( $pais );
    		
    	$form->get ( 'ingresar' )->setAttribute ( 'value', 'Actualizar' );
    	$form->get ( 'pai_id' )->setAttribute ( 'value', $pais->getPai_id() );
    		
    	$view = new ViewModel ( array (
    			'formulario' => $form ,
    	) );
    
    	$view->setTemplate('parametros/pais/ingresar');
    	return $view;
    }
    
    public function eliminarAction(){
    
    	$id = ( int ) $this->params ()->fromRoute ( 'id', 0 );
    	
    	//SE ELIMINA LA INFORMACION EN LA BDD
    	if($this->getPaisDao() ->eliminar ( $id )){
            //SI SE EJECUTO EXITOSAMENTE SE REGRESA AL LISTADO DE CONTACTOS
            return $this->redirect ()->toRoute ( 'parametros', array (
                    'controller' => 'pais',
                    'action' => 'listado'
            ) );            
        }else{
            $view = new ViewModel ();
        
            $view->setTemplate('parametros/pais/errorBorrado');
            return $view;  
        }
    	

    }
    
    public function validarAction(){

    	//VERIFICA QUE SE HAYA REALIZADO UN POST DE INFORMACION
    	if (! $this->request->isPost ()) {
    		return $this->redirect ()->toRoute ( 'parametros', array (
    				'controller' => 'pais',
    				'action' => 'listado'
    		) );
    	}
    	
    	//CAPTURA LA INFORMACION ENVIADA EN EL POST
    	$data = $this->request->getPost ();
    	
    	//VERIFICA EL IDIOMA INGRESADO PARA TRAER EL FORMULARIO SEGUN EL IDIOMA
    	$form = $this->getForm();
    	
    	//SE VALIDA EL FORMULARIO
    	$form->setInputFilter ( new PaisValidator() );
    	
    	//SE LLENAN LOS DATOS DEL FORMULARIO
    	$form->setData ( $data );
    	
    	//SE VALIDA EL FORMULARIO ES CORRECTO
    	if (! $form->isValid ()) {
    		// SI EL FORMULARIO NO ES CORRECTO
    		$modelView = new ViewModel ( array (
    				'formulario' => $form ,
    		) );
    			
    		$modelView->setTemplate ( 'parametros/pais/ingresar' );
    		return $modelView;
    	}
    	
    	//->AQUI EL FORMULARIO ES CORRECTO, SE VALIDO CORRECTAMENTE
    	
    	//SE GENERA EL OBJETO DE CONTACTO
    	$pais = new PaisEntity();
    	//SE CARGA LA ENTIDAD CON LA INFORMACION DEL POST
    	$pais->exchangeArray ( $data );
    	
    	//SE GRABA LA INFORMACION EN LA BDD
    	$this->getPaisDao() ->guardar ( $pais );
    	
    	//SI SE EJECUTO EXITOSAMENTE SE REGRESA AL LISTADO DE CONTACTOS
    	return $this->redirect ()->toRoute ( 'parametros', array (
    			'controller' => 'pais',
    			'action' => 'listado'
    	) );
    }
    
	public function getForm() {
		$form = new Pais ();
		return $form;
	}
    
    public function getPaisDao() {
    	if (! $this->paisDao) {
    		$sm = $this->getServiceLocator ();
    		$this->paisDao = $sm->get ( 'Application\Model\Dao\PaisDao' );
    	}
    	return $this->paisDao;
    }

}