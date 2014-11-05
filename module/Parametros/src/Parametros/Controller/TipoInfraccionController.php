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
use Parametros\Form\TipoInfraccion;
use Parametros\Form\TipoInfraccionValidator;
use Application\Model\Entity\TipoInfraccion as TipoComponentEntity;

class TipoInfraccionController extends AbstractActionController
{
	protected $tipoInfraccionDao;
	
    public function listadoAction()
    {
        $this->layout()->setVariable('activo', '5');
        return array(
            'infraccion' => $this->getTipoInfraccionDao()->traerTodos(),
            'navegacion' => array('datos' =>  array ( 'Inicio' => array('parametros','index','video'), 'Listado Tipos de Infracci&oacute;n' => array('parametros','tipoinfraccion','listado')) ),
        );
        
    }
    
    public function ingresarAction(){
    	 
    	$id = ( int ) $this->params ()->fromRoute ( 'id', 0 );
    	$form = $this->getForm ();
    	 
    	//FORMULARIO DE INGRESO DE INFORMACION
    	return new ViewModel ( array (
    			'formulario' => $form ,
    	        'navegacion' => array('datos' =>  array ( 'Inicio' => array('parametros','index','video'), 'Listado Tipos de Infracci&oacute;n' => array('parametros','tipoinfraccion','listado'), 'Ingresar Tipo de Infracci&oacute;n' => array('parametros','tipoinfraccion','ingresar')) ),
    	        'titulo' => 'Nuevo'
    	) );
    }
    
    public function editarAction(){
    
    	$id = ( int ) $this->params ()->fromRoute ( 'id', 0 );
    	$form = $this->getForm ();
    
    	//FORMULARIO DE ACTUALIZACION DE INFORMACION
    	$estado = $this->getTipoInfraccionDao()->traer ( $id );
    	$form->bind ( $estado );
    
    	$form->get ( 'ingresar' )->setAttribute ( 'value', 'Actualizar' );
    	$form->get ( 'tip_inf_id' )->setAttribute ( 'value', $estado->getTip_inf_id() );
    
    	$view = new ViewModel ( array (
    			'formulario' => $form ,
    	        'navegacion' => array('datos' =>  array ( 'Inicio' => array('parametros','index','video'), 'Listado Tipos de Infracci&oacute;n' => array('parametros','tipoinfraccion','listado'), 'Actualizar Tipo de Infracci&oacute;n' => array('parametros','tipoinfraccion','editar', $id)) ),
    	        'titulo' => 'Actualizar'
    	) );
    
    	$view->setTemplate('parametros/tipo-infraccion/ingresar');
    	return $view;
    }
    
    public function eliminarAction(){

    	$id = ( int ) $this->params ()->fromRoute ( 'id', 0 );
    	 
    	//SE ELIMINA LA INFORMACION EN LA BDD
    	if($this->getTipoInfraccionDao() ->eliminar ( $id )){
            //SI SE EJECUTO EXITOSAMENTE SE REGRESA AL LISTADO DE CONTACTOS
            return $this->redirect ()->toRoute ( 'parametros', array (
                    'controller' => 'tipoinfraccion',
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
    				'controller' => 'tipoinfraccion',
    				'action' => 'listado'
    		) );
    	}
    	
    	//CAPTURA LA INFORMACION ENVIADA EN EL POST
    	$data = $this->request->getPost ();
    	 
    	//VERIFICA EL IDIOMA INGRESADO PARA TRAER EL FORMULARIO SEGUN EL IDIOMA
    	$form = $this->getForm();
    	 
    	//SE VALIDA EL FORMULARIO
    	$form->setInputFilter ( new TipoInfraccionValidator() );
    	 
    	//SE LLENAN LOS DATOS DEL FORMULARIO
    	$form->setData ( $data );
    	 
    	//SE VALIDA EL FORMULARIO ES CORRECTO
    	if (! $form->isValid ()) {
    		// SI EL FORMULARIO NO ES CORRECTO
    		$modelView = new ViewModel ( array (
    				'formulario' => $form ,
    		        'navegacion' => array('datos' =>  array ( 'Inicio' => array('parametros','index','video'), 'Listado Tipos de Infracci&oacute;n' => array('parametros','tipoinfraccion','listado'), 'Ingresar Tipo de Infracci&oacute;n' => array('parametros','tipoinfraccion','ingresar')) ),
    		        'titulo' => 'Validar informaci&oacute;n de la'
    		) );
    		 
    		$modelView->setTemplate ( 'parametros/tipo-infraccion/ingresar' );
    		return $modelView;
    	}
    	 
    	//->AQUI EL FORMULARIO ES CORRECTO, SE VALIDO CORRECTAMENTE
    	 
    	//SE GENERA EL OBJETO DE CONTACTO
    	$tipo_infraccion = new TipoComponentEntity();
    	//SE CARGA LA ENTIDAD CON LA INFORMACION DEL POST
    	$tipo_infraccion->exchangeArray ( $data );
    	 
    	//SE GRABA LA INFORMACION EN LA BDD
    	$this->getTipoInfraccionDao()->guardar ( $tipo_infraccion );
    	 
    	//SI SE EJECUTO EXITOSAMENTE SE REGRESA AL LISTADO DE CONTACTOS
    	return $this->redirect ()->toRoute ( 'parametros', array (
    			'controller' => 'tipoinfraccion',
    			'action' => 'listado'
    	) );
    }
    
   public function getForm() {
    	return new TipoInfraccion();
    	
    }
 
    public function getTipoInfraccionDao() {
    	if (! $this->tipoInfraccionDao) {
    		$sm = $this->getServiceLocator ();
    		$this->tipoInfraccionDao = $sm->get ( 'Application\Model\Dao\TipoInfraccionDao' );
    	}
    	return $this->tipoInfraccionDao;
    }

}