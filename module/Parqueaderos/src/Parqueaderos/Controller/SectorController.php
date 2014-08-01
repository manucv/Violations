<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonModule for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Parqueaderos\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Parqueaderos\Form\Sector;
use Parqueaderos\Form\SectorValidator;
use Application\Model\Entity\Sector as SectorEntity;

class SectorController extends AbstractActionController
{
    protected $sectorDao;
    protected $parqueaderoDao;
    public function indexAction(){

        $id = ( int ) $this->params()->fromRoute ( 'id', 0 );
        $form = $this->getForm ();
        $sector = $this->getSectorDao()->traer ( $id );
        $parqueaderos = $this->getParqueaderoDao()->traerTodosPorSector($id);

        return new ViewModel ( array (
            'parqueaderos'  =>  $parqueaderos,
            'sector'        =>  $sector
        ) );
    }

    public function getForm() {
        $form = new Sector ();
        return $form;
    }

    public function getSectorDao() {
        if (! $this->sectorDao) {
            $sm = $this->getServiceLocator ();
            $this->sectorDao = $sm->get ( 'Application\Model\Dao\SectorDao' );
        }
        return $this->sectorDao;
    }    

    public function getParqueaderoDao() {
        if (! $this->parqueaderoDao) {
            $sm = $this->getServiceLocator ();
            $this->parqueaderoDao = $sm->get ( 'Application\Model\Dao\ParqueaderoDao' );
        }
        return $this->parqueaderoDao;
    }    


	/*protected $sectorDao;
	protected $ciudadDao;
	protected $paisDao;
	protected $estadoDao;
	
    public function listadoAction()
    {
        return array('sector' => $this->getSectorDao()->traerTodos());
    }
    
    public function indexAction(){
    	
    	$id = ( int ) $this->params ()->fromRoute ( 'id', 0 );
    	$form = $this->getForm ();
    	echo 'test';
        die();
    	//FORMULARIO DE INGRESO DE INFORMACION
    	return new ViewModel ( array (
    			'formulario' => $form ,
    	) );
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
    	
    	$form->get('pai_id_hidden')->setValue($data['pai_id']);
    	$form->get('est_id_hidden')->setValue($data['est_id']);
    	$form->get('ciu_id_hidden')->setValue($data['ciu_id']);
    	
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
    	$sector = new SectorEntity();
    	//SE CARGA LA ENTIDAD CON LA INFORMACION DEL POST
    	$sector->exchangeArray ( $data );
    	
    	//SE GRABA LA INFORMACION EN LA BDD
    	$this->getSectorDao() ->guardar ( $sector );
    	
    	//SI SE EJECUTO EXITOSAMENTE SE REGRESA AL LISTADO DE CONTACTOS
    	return $this->redirect ()->toRoute ( 'parametros', array (
    			'controller' => 'sector',
    			'action' => 'listado'
    	) );
    }
    

    

    */
}