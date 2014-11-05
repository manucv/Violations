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
use Parametros\Form\Estado;
use Parametros\Form\EstadoValidator;
use Application\Model\Entity\Estado as EstadoEntity;

class EstadoController extends AbstractActionController
{
	protected $estadoDao;
	protected $paisDao;
	
    public function listadoAction()
    {
        
        $this->layout()->setVariable('menupadre', 'parametros')->setVariable('menuhijo', 'estados');
        
        return array(
            'estado' => $this->getEstadoDao()->traerTodos(),
            'navegacion' => array('datos' =>  array ( 'Inicio' => array('parametros','index','video'), 'Listado de Estados' => array('parametros','estado','listado')) ),
        );
    }
    
    public function ingresarAction(){
    	 
    	$id = ( int ) $this->params ()->fromRoute ( 'id', 0 );
    	$form = $this->getForm ();
    	 
    	$this->layout()->setVariable('menupadre', 'parametros')->setVariable('menuhijo', 'estados');
    	//FORMULARIO DE INGRESO DE INFORMACION
    	return new ViewModel ( array (
    			'formulario' => $form ,
    	        'navegacion' => array('datos' =>  array ( 'Inicio' => array('parametros','index','video'), 'Listado de Estados' => array('parametros','estado','listado'), 'Ingresar Estados' => array('parametros','estado','ingresar')) ),
    	        'titulo' => 'Nuevo'
    	) );
    }
    
    public function editarAction(){
    
    	$id = ( int ) $this->params ()->fromRoute ( 'id', 0 );
    	$form = $this->getForm ();
    
    	//FORMULARIO DE ACTUALIZACION DE INFORMACION
    	$estado = $this->getEstadoDao()->traer ( $id );
    	$form->bind ( $estado );
    
    	$form->get ( 'ingresar' )->setAttribute ( 'value', 'Actualizar' );
    	$form->get ( 'est_id' )->setAttribute ( 'value', $estado->getEst_id() );
    
    	$this->layout()->setVariable('menupadre', 'parametros')->setVariable('menuhijo', 'estados');
    	$view = new ViewModel ( array (
    			'formulario' => $form ,
    	        'navegacion' => array('datos' =>  array ( 'Inicio' => array('parametros','index','video'), 'Listado de Estados' => array('parametros','estado','listado'), 'Actualizar Estados' => array('parametros','estado','editar', $id)) ),
    	        'titulo' => 'Actualizar'
    	) );
    
    	$view->setTemplate('parametros/estado/ingresar');
    	return $view;
    }
    
    public function eliminarAction(){

    	$id = ( int ) $this->params ()->fromRoute ( 'id', 0 );
    	 
    	//SE ELIMINA LA INFORMACION EN LA BDD
    	if($this->getEstadoDao() ->eliminar ( $id )){
            //SI SE EJECUTO EXITOSAMENTE SE REGRESA AL LISTADO DE CONTACTOS
            return $this->redirect ()->toRoute ( 'parametros', array (
                    'controller' => 'estado',
                    'action' => 'listado'
            ) );
        }
//         else{
//             $view = new ViewModel ();
        
//             $view->setTemplate('parametros/estado/errorBorrado');
//             return $view;                  
//         }
    	 
    	
    }
    
    public function validarAction(){
    
    	//VERIFICA QUE SE HAYA REALIZADO UN POST DE INFORMACION
    	if (! $this->request->isPost ()) {
    		return $this->redirect ()->toRoute ( 'parametros', array (
    				'controller' => 'estado',
    				'action' => 'listado'
    		) );
    	}
    	 
    	//CAPTURA LA INFORMACION ENVIADA EN EL POST
    	$data = $this->request->getPost ();
    	 
    	//VERIFICA EL IDIOMA INGRESADO PARA TRAER EL FORMULARIO SEGUN EL IDIOMA
    	$form = $this->getForm();
    	 
    	//SE VALIDA EL FORMULARIO
    	$form->setInputFilter ( new EstadoValidator() );
    	 
    	//SE LLENAN LOS DATOS DEL FORMULARIO
    	$form->setData ( $data );
    	 
    	//SE VALIDA EL FORMULARIO ES CORRECTO
    	if (! $form->isValid ()) {
    	    
    	    $this->layout()->setVariable('menupadre', 'parametros')->setVariable('menuhijo', 'estados');
    		// SI EL FORMULARIO NO ES CORRECTO
    		$modelView = new ViewModel ( array (
    				'formulario' => $form ,
    		        'navegacion' => array('datos' =>  array ( 'Inicio' => array('parametros','index','video'), 'Listado de Estados' => array('parametros','estado','listado'), 'Ingresar Estados' => array('parametros','estado','ingresar')) ),
    		        'titulo' => 'Validar informaci&oacute;n del',
    		) );
    		 
    		$modelView->setTemplate ( 'parametros/estado/ingresar' );
    		return $modelView;
    	}
    	 
    	//->AQUI EL FORMULARIO ES CORRECTO, SE VALIDO CORRECTAMENTE
    	 
    	//SE GENERA EL OBJETO DE CONTACTO
    	$estado = new EstadoEntity();
    	//SE CARGA LA ENTIDAD CON LA INFORMACION DEL POST
    	$estado->exchangeArray ( $data );
    	 
    	//SE GRABA LA INFORMACION EN LA BDD
    	$this->getEstadoDao()->guardar ( $estado );
    	 
    	//SI SE EJECUTO EXITOSAMENTE SE REGRESA AL LISTADO DE CONTACTOS
    	return $this->redirect ()->toRoute ( 'parametros', array (
    			'controller' => 'estado',
    			'action' => 'listado'
    	) );
    }
    
    public function getForm() {
    	$form = new Estado ();
    	$form->get ( 'pai_id' )->setValueOptions ( $this->getPaisDao ()->traerTodosArreglo () );
    	return $form;
    }
    
    public function getEstadoDao() {
    	if (! $this->estadoDao) {
    		$sm = $this->getServiceLocator ();
    		$this->estadoDao = $sm->get ( 'Application\Model\Dao\EstadoDao' );
    	}
    	return $this->estadoDao;
    }
    
    public function getPaisDao() {
    	if (! $this->paisDao) {
    		$sm = $this->getServiceLocator ();
    		$this->paisDao = $sm->get ( 'Application\Model\Dao\PaisDao' );
    	}
    	return $this->paisDao;
    }

}