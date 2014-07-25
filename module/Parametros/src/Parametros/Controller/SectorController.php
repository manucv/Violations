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
use Parametros\Form\Sector;
use Parametros\Form\SectorValidator;
use Application\Model\Entity\Sector as SectorEntity;

class SectorController extends AbstractActionController
{
	protected $sectorDao;
	protected $ciudadDao;
	
    public function listadoAction()
    {
        return array('sector' => $this->getSectorDao()->traerTodos());
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
    	$sector = $this->getSectorDao()->traer ( $id );
    	$form->bind ( $sector );
    		
    	$form->get ( 'ingresar' )->setAttribute ( 'value', 'Actualizar' );
    	$form->get ( 'par_id' )->setAttribute ( 'value', $sector->getSec_id() );
    		
    	$view = new ViewModel ( array (
    			'formulario' => $form ,
    	) );
    
    	$view->setTemplate('parametros/sector/ingresar');
    	return $view;
    }
    
    public function eliminarAction(){
    
    	$id = ( int ) $this->params ()->fromRoute ( 'id', 0 );
    	
    	//SE ELIMINA LA INFORMACION EN LA BDD
    	if($this->getSectorDao() ->eliminar ( $id )){
            //SI SE EJECUTO EXITOSAMENTE SE REGRESA AL LISTADO DE CONTACTOS
            return $this->redirect ()->toRoute ( 'parametros', array (
                    'controller' => 'sector',
                    'action' => 'listado'
            ) );            
        }else{
            $view = new ViewModel ();
        
            $view->setTemplate('parametros/sector/errorBorrado');
            return $view;  
        }
    }
    
    public function validarAction(){

    	//VERIFICA QUE SE HAYA REALIZADO UN POST DE INFORMACION
    	if (! $this->request->isPost ()) {
    		return $this->redirect ()->toRoute ( 'parametros', array (
    				'controller' => 'sector',
    				'action' => 'listado'
    		) );
    	}
    	
    	//CAPTURA LA INFORMACION ENVIADA EN EL POST
    	$data = $this->request->getPost ();
    	
    	//VERIFICA EL IDIOMA INGRESADO PARA TRAER EL FORMULARIO SEGUN EL IDIOMA
    	$form = $this->getForm();
    	
    	//SE VALIDA EL FORMULARIO
    	$form->setInputFilter ( new SectorValidator() );
    	
    	//SE LLENAN LOS DATOS DEL FORMULARIO
    	$form->setData ( $data );
    	
    	//SE VALIDA EL FORMULARIO ES CORRECTO
    	if (! $form->isValid ()) {
    		// SI EL FORMULARIO NO ES CORRECTO
    		$modelView = new ViewModel ( array (
    				'formulario' => $form ,
    		) );
    			
    		$modelView->setTemplate ( 'parametros/sector/ingresar' );
    		return $modelView;
    	}
    	
    	//->AQUI EL FORMULARIO ES CORRECTO, SE VALIDO CORRECTAMENTE
    	
    	//SE GENERA EL OBJETO DE CONTACTO
    	$pais = new SectorEntity();
    	//SE CARGA LA ENTIDAD CON LA INFORMACION DEL POST
    	$pais->exchangeArray ( $data );
    	
    	//SE GRABA LA INFORMACION EN LA BDD
    	$this->getSectorDao() ->guardar ( $pais );
    	
    	//SI SE EJECUTO EXITOSAMENTE SE REGRESA AL LISTADO DE CONTACTOS
    	return $this->redirect ()->toRoute ( 'parametros', array (
    			'controller' => 'sector',
    			'action' => 'listado'
    	) );
    }
    
	public function getForm() {
		$form = new Sector ();
		$form->get ( 'ciu_id' )->setValueOptions ( $this->getCiudadDao ()->traerTodosArreglo() );
		return $form;
	}
    
    public function getSectorDao() {
    	if (! $this->sectorDao) {
    		$sm = $this->getServiceLocator ();
    		$this->sectorDao = $sm->get ( 'Application\Model\Dao\SectorDao' );
    	}
    	return $this->sectorDao;
    }
    
    public function getCiudadDao() {
    	if (! $this->ciudadDao) {
    		$sm = $this->getServiceLocator ();
    		$this->ciudadDao = $sm->get ( 'Application\Model\Dao\CiudadDao' );
    	}
    	return $this->ciudadDao;
    }

}