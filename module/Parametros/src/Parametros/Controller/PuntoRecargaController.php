<?php 
	//PuntoRecargaController.php

	namespace Parametros\Controller;

	use Zend\Mvc\Controller\AbstractActionController;
	use Zend\View\Model\ViewModel;

	use Parametros\Form\PuntoRecarga;
	use Parametros\Form\PuntoRecargaValidator;

	use Parametros\Form\Carga;
	use Parametros\Form\CargaValidator;

	use Application\Model\Entity\PuntoRecarga as PuntoRecargaEntity;
	use Application\Model\Entity\Carga as CargaEntity;



	class PuntoRecargaController extends AbstractActionController
	{
		protected $puntoRecargaDao;
		protected $cargaDao;

		public function listadoAction()
	    {

	    	$this->getPuntoRecargaDao()->traerTodosMunicipio();
	        $this->layout()->setVariable('menupadre', 'parametros')->setVariable('menuhijo', 'Puntos de Recarga');
	        
	        return array(
	            'punto_recarga' => $this->getPuntoRecargaDao()->traerTodos(),
	            'navegacion' => array('datos' =>  array ( 'Inicio' => array('parametros','index','video'), 'Listado de Puntos de Recarga' => array('parametros','puntorecarga','listado')) ),
	        );
	    }

	    /* Formularios */
	    public function getForm() {
			$form = new PuntoRecarga ();
			return $form;
		}

		public function getCargaForm() {
			$form = new Carga ();
			return $form;
		}
	    
	    public function getPuntoRecargaDao() {
	    	if (!$this->puntoRecargaDao) {
	    		$sm = $this->getServiceLocator ();
	    		$this->puntoRecargaDao = $sm->get ( 'Application\Model\Dao\PuntoRecargaDao' );
	    	}
	    	return $this->puntoRecargaDao;
	    }

	    public function getCargaDao() {
	    	if (!$this->cargaDao) {
	    		$sm = $this->getServiceLocator ();
	    		$this->cargaDao = $sm->get ( 'Application\Model\Dao\CargaDao' );
	    	}
	    	return $this->cargaDao;
	    }

	    public function ingresarAction(){
	    	$form = $this->getForm ();	    	
	    	return new ViewModel ( array (
	    			'formulario' => $form ,
	    	        'navegacion' => array('datos' =>  array ( 	'Inicio' => array('parametros','index','video'), 
	    	        											'Listado de Puntos de Recarga' => array('parametros','puntorecarga','listado'), 
	    	        											'Ingresar Punto de Recarga' => array('parametros','puntorecarga','ingresar')) ),
	    	        'titulo' => 'Nuevo'
	    	) );
	    }

        public function validarAction(){

	    	//VERIFICA QUE SE HAYA REALIZADO UN POST DE INFORMACION
	    	if (! $this->request->isPost ()) {
	    		return $this->redirect ()->toRoute ( 'parametros', array (
	    				'controller' => 'puntorecarga',
	    				'action' => 'listado'
	    		) );
	    	}
	    	
	    	//CAPTURA LA INFORMACION ENVIADA EN EL POST
	    	$data = $this->request->getPost ();
	    	
	    	//VERIFICA EL IDIOMA INGRESADO PARA TRAER EL FORMULARIO SEGUN EL IDIOMA
	    	$form = $this->getForm();
	    	
	    	//SE VALIDA EL FORMULARIO
	    	$form->setInputFilter ( new PuntoRecargaValidator() );
	    	
	    	//SE LLENAN LOS DATOS DEL FORMULARIO
	    	$form->setData ( $data );
	    	
	    	//SE VALIDA EL FORMULARIO ES CORRECTO
	    	if (! $form->isValid ()) {
	    	    
	    	    $this->layout()->setVariable('menupadre', 'parametros')->setVariable('menuhijo', 'puntorecarga');
	    		// SI EL FORMULARIO NO ES CORRECTO
	    		$modelView = new ViewModel ( array (
	    				'formulario' => $form,
	    		        'navegacion' => array('datos' =>  array ( 	'Inicio' => array('parametros','index','video'), 
	    	        											'Listado de Puntos de Recarga' => array('parametros','puntorecarga','listado'), 
	    	        											'Ingresar Punto de Recarga' => array('parametros','puntorecarga','ingresar')) ),
	    		        'titulo' => 'Validar informaci&oacute;n de'
	    		) );
	    			
	    		$modelView->setTemplate ( 'parametros/puntorecarga/ingresar' );
	    		return $modelView;
	    	}
	    	
	    	//->AQUI EL FORMULARIO ES CORRECTO, SE VALIDO CORRECTAMENTE
	    	
	    	//SE GENERA EL OBJETO DE CONTACTO
	    	$puntorecarga = new PuntoRecargaEntity();
	    	//SE CARGA LA ENTIDAD CON LA INFORMACION DEL POST
	    	$puntorecarga->exchangeArray ( $data );
	    	
	    	if(!empty($data['pun_rec_id']) && !is_null($data['pun_rec_id'])){
	    	    //SE GRABA LA INFORMACION EN LA BDD
	    	    $this->getPuntoRecargaDao() ->actualizar ( $puntorecarga, $data['pun_rec_id'] );
	    	} else{
	    	    //SE GRABA LA INFORMACION EN LA BDD
	    	    $this->getPuntoRecargaDao() ->guardar ( $puntorecarga );
	    	}
	    	
	    	//SI SE EJECUTO EXITOSAMENTE SE REGRESA AL LISTADO DE CONTACTOS
	    	return $this->redirect ()->toRoute ( 'parametros', array (
	    			'controller' => 'puntorecarga',
	    			'action' => 'listado'
	    	) );
	    }

	    public function editarAction(){
    
			$id = $this->params ()->fromRoute ( 'id', 0 );
			$form = $this->getForm ();

			//FORMULARIO DE ACTUALIZACION DE INFORMACION
			$puntorecarga = $this->getPuntoRecargaDao()->traer ( $id );
			
			$form->bind ( $puntorecarga );
				
			$form->get ( 'ingresar' )->setAttribute ( 'value', 'Actualizar' );
			$form->get ( 'pun_rec_id' )->setAttribute ( 'value', $puntorecarga->getPun_rec_id() );
				
			$this->layout()->setVariable('menupadre', 'parametros')->setVariable('menuhijo', 'puntorecarga');
			$view = new ViewModel ( array (
					'formulario' => $form ,
			        'navegacion' => array('datos' =>  array ( 	'Inicio' => array('parametros','index','video'), 
	    	        											'Listado de Puntos de Recarga' => array('parametros','puntorecarga','listado'), 
	    	        											'Ingresar Punto de Recarga' => array('parametros','puntorecarga','editar', $id)) ),
			        'titulo' => 'Actualizar'
			) );

			$view->setTemplate('parametros/punto-recarga/ingresar');
			return $view;
		}

	    public function cargarAction(){
    
			$id = $this->params ()->fromRoute ( 'id', 0 );
			$form = $this->getCargaForm ();

			//FORMULARIO DE ACTUALIZACION DE INFORMACION
			$puntorecarga = $this->getPuntoRecargaDao()->traer ( $id );
			
			$form->bind ( $puntorecarga );
			$form->get ( 'pun_rec_id' )->setAttribute ( 'value', $puntorecarga->getPun_rec_id() );
				
			$this->layout()->setVariable('menupadre', 'parametros')->setVariable('menuhijo', 'carga');
			return new ViewModel ( array (
					'formulario' => $form ,
					'puntorecarga' => $puntorecarga,
			        'navegacion' => array('datos' =>  array ( 	'Inicio' => array('parametros','index','video'), 
	    	        											'Listado de Puntos de Recarga' => array('parametros','puntorecarga','listado'), 
	    	        											'Ingresar Punto de Recarga' => array('parametros','puntorecarga','cargar', $id)) ),
			        'titulo' => 'Cargar Saldo'
			) );

		}

        public function saldoAction(){

        	

	    	//VERIFICA QUE SE HAYA REALIZADO UN POST DE INFORMACION
	    	if (! $this->request->isPost ()) {
	    		return $this->redirect ()->toRoute ( 'parametros', array (
	    				'controller' => 'puntorecarga',
	    				'action' => 'listado'
	    		) );
	    	}
	    	
	    	//CAPTURA LA INFORMACION ENVIADA EN EL POST
	    	$data = $this->request->getPost ();
	    	
	    	//VERIFICA EL IDIOMA INGRESADO PARA TRAER EL FORMULARIO SEGUN EL IDIOMA
	    	$form = $this->getCargaForm();
	    	
	    	//SE VALIDA EL FORMULARIO
	    	$form->setInputFilter ( new CargaValidator() );
	    	
	    	//SE LLENAN LOS DATOS DEL FORMULARIO
	    	$form->setData ( $data );
	    	
	    	$id=$data['pun_rec_id'];
	    	//SE VALIDA EL FORMULARIO ES CORRECTO
	    	if (! $form->isValid ()) {
	    	    
	    	    $this->layout()->setVariable('menupadre', 'parametros')->setVariable('menuhijo', 'carga');
	    	    $puntorecarga = $this->getPuntoRecargaDao()->traer ( $id );
				
	    		// SI EL FORMULARIO NO ES CORRECTO
	    		$modelView = new ViewModel ( array (
	    				'formulario' => $form,
	    		        'navegacion' => array('datos' =>  array ( 	'Inicio' => array('parametros','index','video'), 
	    	        											'Listado de Puntos de Recarga' => array('parametros','puntorecarga','listado'), 
	    	        											'Ingresar Punto de Recarga' => array('parametros','puntorecarga','cargar')) ),
	    		        'titulo' => 'Validar Cargar Saldo',
	    		        'puntorecarga' => $puntorecarga
	    		) );
	    			
	    		$modelView->setTemplate ( 'parametros/punto-recarga/cargar' );
	    		return $modelView;
	    	}

	    	
	    	//SE GENERA EL OBJETO DE CONTACTO
	    	$carga = new CargaEntity();
	    	//SE CARGA LA ENTIDAD CON LA INFORMACION DEL POST
	    	$carga->exchangeArray ( $data );
	    	
	    	if(!empty($data['car_id']) && !is_null($data['car_id'])){
	    	    //SE GRABA LA INFORMACION EN LA BDD
	    	    $this->getCargaDao() ->actualizar ( $carga, $data['car_id'] );
	    	} else{
	    	    //SE GRABA LA INFORMACION EN LA BDD
	    	    $this->getCargaDao() ->guardar ( $carga );
	    	}
	    	
	    	//SI SE EJECUTO EXITOSAMENTE SE REGRESA AL LISTADO DE CONTACTOS
	    	return $this->redirect ()->toRoute ( 'parametros', array (
	    			'controller' => 'puntorecarga',
	    			'action' => 'listado'
	    	) );
	    	
	    }	


	    public function verificarAction(){
    
		
	        $this->layout()->setVariable('menupadre', 'parametros')->setVariable('menuhijo', 'Puntos de Recarga');
	        
	        return array(
	            'cargas' =>	$this->getCargaDao()->traerPendientes(),
	            'navegacion' => array('datos' =>  array ( 'Inicio' => array('parametros','index','video'), 'Listado de Pagos por Verificar' => array('parametros','puntorecarga','verificar')) ),
	        );
		}
	}