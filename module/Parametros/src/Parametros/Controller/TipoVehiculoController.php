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
use Parametros\Form\TipoVehiculo;
use Parametros\Form\TipoVehiculoValidator;
use Application\Model\Entity\TipoVehiculo as TipoComponentEntity;

class TipoVehiculoController extends AbstractActionController
{
	protected $tipoVehiculoDao;
	
    public function listadoAction()
    {
        return array('vehiculos' => $this->getTipoVehiculoDao()->traerTodos());
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
    	$estado = $this->getTipoVehiculoDao()->traer ( $id );
    	$form->bind ( $estado );
    
    	$form->get ( 'ingresar' )->setAttribute ( 'value', 'Actualizar' );
    	$form->get ( 'tip_veh_id' )->setAttribute ( 'value', $estado->getTip_veh_id() );
    
    	$view = new ViewModel ( array (
    			'formulario' => $form ,
    	) );
    
    	$view->setTemplate('parametros/tipo-vehiculo/ingresar');
    	return $view;
    }
    
    public function eliminarAction(){

    	$id = ( int ) $this->params ()->fromRoute ( 'id', 0 );
    	 
    	//SE ELIMINA LA INFORMACION EN LA BDD
    	if($this->getTipoVehiculoDao() ->eliminar ( $id )){
            //SI SE EJECUTO EXITOSAMENTE SE REGRESA AL LISTADO DE CONTACTOS
            return $this->redirect ()->toRoute ( 'parametros', array (
                    'controller' => 'tipovehiculo',
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
    				'controller' => 'tipovehiculo',
    				'action' => 'listado'
    		) );
    	}
    	
    	//CAPTURA LA INFORMACION ENVIADA EN EL POST
    	$data = $this->request->getPost ();
    	 
    	//VERIFICA EL IDIOMA INGRESADO PARA TRAER EL FORMULARIO SEGUN EL IDIOMA
    	$form = $this->getForm();
    	 
    	//SE VALIDA EL FORMULARIO
    	$form->setInputFilter ( new TipoVehiculoValidator() );
    	 
    	//SE LLENAN LOS DATOS DEL FORMULARIO
    	$form->setData ( $data );
    	 
    	//SE VALIDA EL FORMULARIO ES CORRECTO
    	if (! $form->isValid ()) {
    		// SI EL FORMULARIO NO ES CORRECTO
    		$modelView = new ViewModel ( array (
    				'formulario' => $form ,
    		) );
    		 
    		$modelView->setTemplate ( 'parametros/tipo-vehiculo/ingresar' );
    		return $modelView;
    	}
    	 
    	//->AQUI EL FORMULARIO ES CORRECTO, SE VALIDO CORRECTAMENTE
    	 
    	//SE GENERA EL OBJETO DE CONTACTO
    	$tipo_infraccion = new TipoComponentEntity();
    	//SE CARGA LA ENTIDAD CON LA INFORMACION DEL POST
    	$tipo_infraccion->exchangeArray ( $data );
    	 
    	//SE GRABA LA INFORMACION EN LA BDD
    	$this->getTipoVehiculoDao()->guardar ( $tipo_infraccion );
    	 
    	//SI SE EJECUTO EXITOSAMENTE SE REGRESA AL LISTADO DE CONTACTOS
    	return $this->redirect ()->toRoute ( 'parametros', array (
    			'controller' => 'tipovehiculo',
    			'action' => 'listado'
    	) );
    }
    
   public function getForm() {
    	return new TipoVehiculo();
    	
    }
 
    public function getTipoVehiculoDao() {
    	if (! $this->tipoVehiculoDao) {
    		$sm = $this->getServiceLocator ();
    		$this->tipoVehiculoDao = $sm->get ( 'Application\Model\Dao\TipoVehiculoDao' );
    	}
    	return $this->tipoVehiculoDao;
    }

}