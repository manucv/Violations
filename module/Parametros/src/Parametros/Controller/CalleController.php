<?php //CalleController.php

	namespace Parametros\Controller;

	use Zend\Mvc\Controller\AbstractActionController;
	use Zend\View\Model\ViewModel;
	use Parametros\Form\Calle;
	use Parametros\Form\CalleValidator;
	use Application\Model\Entity\Calle as CalleEntity;

	class CalleController extends AbstractActionController
	{
		protected $calleDao;

		public function listadoAction()
	    {
	        $this->layout()->setVariable('menupadre', 'parametros')->setVariable('menuhijo', 'Calles');
	        
	        return array(
	            'placas' => $this->getCalleDao()->traerTodos(),
	            'navegacion' => array('datos' =>  array ( 'Inicio' => array('parametros','index','video'), 'Calles' => array('parametros','calle','listado')) ),
	        );
	    }

	    public function getForm() {
			$form = new Calle ();
			return $form;
		}
	    
	    public function getCalleDao() {
	    	if (!$this->calleDao) {
	    		$sm = $this->getServiceLocator ();
	    		$this->calleDao = $sm->get ( 'Application\Model\Dao\CalleDao' );
	    	}
	    	return $this->calleDao;
	    }

	    public function ingresarAction(){
    	
	    	$form = $this->getForm ();	    	

	    	return new ViewModel ( array (
	    			'formulario' => $form ,
	    	        'navegacion' => array('datos' =>  array ( 	'Inicio' => array('parametros','index','video'), 
	    	        											'Listado de Puntos de Recarga' => array('parametros','calle','listado'), 
	    	        											'Ingresar Punto de Recarga' => array('parametros','calle','ingresar')) ),
	    	        'titulo' => 'Nuevo'
	    	) );
	    }

        public function validarAction(){

	    	//VERIFICA QUE SE HAYA REALIZADO UN POST DE INFORMACION
	    	if (! $this->request->isPost ()) {
	    		return $this->redirect ()->toRoute ( 'parametros', array (
	    				'controller' => 'calle',
	    				'action' => 'listado'
	    		) );
	    	}
	    	
	    	//CAPTURA LA INFORMACION ENVIADA EN EL POST
	    	$data = $this->request->getPost ();
	    	
	    	//VERIFICA EL IDIOMA INGRESADO PARA TRAER EL FORMULARIO SEGUN EL IDIOMA
	    	$form = $this->getForm();
	    	
	    	//SE VALIDA EL FORMULARIO
	    	$form->setInputFilter ( new CalleValidator() );
	    	
	    	//SE LLENAN LOS DATOS DEL FORMULARIO
	    	$form->setData ( $data );
	    	
	    	//SE VALIDA EL FORMULARIO ES CORRECTO
	    	if (! $form->isValid ()) {
	    	    
	    	    $this->layout()->setVariable('menupadre', 'parametros')->setVariable('menuhijo', 'calle');
	    		// SI EL FORMULARIO NO ES CORRECTO
	    		$modelView = new ViewModel ( array (
	    				'formulario' => $form,
	    		        'navegacion' => array('datos' =>  array ( 	'Inicio' => array('parametros','index','video'), 
	    	        											'Listado de Puntos de Recarga' => array('parametros','calle','listado'), 
	    	        											'Ingresar Punto de Recarga' => array('parametros','calle','ingresar')) ),
	    		        'titulo' => 'Validar informaci&oacute;n de'
	    		) );
	    			
	    		$modelView->setTemplate ( 'parametros/calle/ingresar' );
	    		return $modelView;
	    	}
	    	
	    	//->AQUI EL FORMULARIO ES CORRECTO, SE VALIDO CORRECTAMENTE
	    	
	    	//SE GENERA EL OBJETO DE CONTACTO
	    	$calle = new CalleEntity();
	    	//SE CARGA LA ENTIDAD CON LA INFORMACION DEL POST
	    	$calle->exchangeArray ( $data );
	    	
	    	if(!empty($data['cal_id']) && !is_null($data['cal_id'])){
	    	    //SE GRABA LA INFORMACION EN LA BDD
	    	    $this->getCalleDao() ->actualizar ( $calle, $data['cal_id'] );
	    	} else{
	    	    //SE GRABA LA INFORMACION EN LA BDD
	    	    $this->getCalleDao() ->guardar ( $calle );
	    	}
	    	
	    	//SI SE EJECUTO EXITOSAMENTE SE REGRESA AL LISTADO DE CONTACTOS
	    	return $this->redirect ()->toRoute ( 'parametros', array (
	    			'controller' => 'calle',
	    			'action' => 'listado'
	    	) );
	    }

	    public function editarAction(){
    
			$id = $this->params ()->fromRoute ( 'id', 0 );
			$form = $this->getForm ();

			//FORMULARIO DE ACTUALIZACION DE INFORMACION
			$calle = $this->getCalleDao()->traer ( $id );
			
			$form->bind ( $calle );
				
			$form->get ( 'ingresar' )->setAttribute ( 'value', 'Actualizar' );
			$form->get ( 'cal_id' )->setAttribute ( 'value', $calle->getCal_id() );
				
			$this->layout()->setVariable('menupadre', 'parametros')->setVariable('menuhijo', 'calle');
			$view = new ViewModel ( array (
					'formulario' => $form ,
			        'navegacion' => array('datos' =>  array ( 	'Inicio' => array('parametros','index','video'), 
	    	        											'Listado de Puntos de Recarga' => array('parametros','calle','listado'), 
	    	        											'Ingresar Punto de Recarga' => array('parametros','calle','editar', $id)) ),
			        'titulo' => 'Actualizar'
			) );

			$view->setTemplate('parametros/calle/ingresar');
			return $view;
		}
	}