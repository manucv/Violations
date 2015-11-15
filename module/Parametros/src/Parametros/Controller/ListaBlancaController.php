<?php 
//ListaBlancaController.php


	namespace Parametros\Controller;

	use Zend\Mvc\Controller\AbstractActionController;
	use Zend\View\Model\ViewModel;
	use Parametros\Form\ListaBlanca;
	use Parametros\Form\ListaBlancaValidator;
	use Application\Model\Entity\ListaBlanca as ListaBlancaEntity;

	class ListaBlancaController extends AbstractActionController
	{
		protected $listaBlancaDao;

		public function listadoAction()
	    {
	        $this->layout()->setVariable('menupadre', 'parametros')->setVariable('menuhijo', 'Lista Blanca');
	        
	        return array(
	            'placas' => $this->getListaBlancaDao()->traerTodos(),
	            'navegacion' => array('datos' =>  array ( 'Inicio' => array('parametros','index','video'), 'Lista Blanca' => array('parametros','listablanca','listado')) ),
	        );
	    }

	    public function getForm() {
			$form = new ListaBlanca ();
			return $form;
		}
	    
	    public function getListaBlancaDao() {
	    	if (!$this->listaBlancaDao) {
	    		$sm = $this->getServiceLocator ();
	    		$this->listaBlancaDao = $sm->get ( 'Application\Model\Dao\ListaBlancaDao' );
	    	}
	    	return $this->listaBlancaDao;
	    }

	    public function ingresarAction(){
    	
	    	$form = $this->getForm ();	    	

	    	return new ViewModel ( array (
	    			'formulario' => $form ,
	    	        'navegacion' => array('datos' =>  array ( 	'Inicio' => array('parametros','index','video'), 
	    	        											'Listado de Puntos de Recarga' => array('parametros','listablanca','listado'), 
	    	        											'Ingresar Punto de Recarga' => array('parametros','listablanca','ingresar')) ),
	    	        'titulo' => 'Nuevo'
	    	) );
	    }

        public function validarAction(){

	    	//VERIFICA QUE SE HAYA REALIZADO UN POST DE INFORMACION
	    	if (! $this->request->isPost ()) {
	    		return $this->redirect ()->toRoute ( 'parametros', array (
	    				'controller' => 'listablanca',
	    				'action' => 'listado'
	    		) );
	    	}
	    	
	    	//CAPTURA LA INFORMACION ENVIADA EN EL POST
	    	$data = $this->request->getPost ();
	    	
	    	//VERIFICA EL IDIOMA INGRESADO PARA TRAER EL FORMULARIO SEGUN EL IDIOMA
	    	$form = $this->getForm();
	    	
	    	//SE VALIDA EL FORMULARIO
	    	$form->setInputFilter ( new ListaBlancaValidator() );
	    	
	    	//SE LLENAN LOS DATOS DEL FORMULARIO
	    	$form->setData ( $data );

	    	//SE VALIDA EL FORMULARIO ES CORRECTO
	    	if (! $form->isValid ()) {
	    	    
	    	    $this->layout()->setVariable('menupadre', 'parametros')->setVariable('menuhijo', 'listablanca');
	    		// SI EL FORMULARIO NO ES CORRECTO
	    		$modelView = new ViewModel ( array (
	    				'formulario' => $form,
	    		        'navegacion' => array('datos' =>  array ( 	'Inicio' => array('parametros','index','video'), 
	    	        											'Listado de Puntos de Recarga' => array('parametros','listablanca','listado'), 
	    	        											'Ingresar Punto de Recarga' => array('parametros','listablanca','ingresar')) ),
	    		        'titulo' => 'Validar informaci&oacute;n de'
	    		) );
	    			
	    		$modelView->setTemplate ( 'parametros/lista-blanca/ingresar' );
	    		return $modelView;
	    	}
	    	
	    	//->AQUI EL FORMULARIO ES CORRECTO, SE VALIDO CORRECTAMENTE
	    	
	    	//SE GENERA EL OBJETO DE CONTACTO
	    	$listablanca = new ListaBlancaEntity();
	    	//SE CARGA LA ENTIDAD CON LA INFORMACION DEL POST
	    	$listablanca->exchangeArray ( $data );
	    	
	    	if(!empty($data['lis_bla_id']) && !is_null($data['lis_bla_id'])){
	    	    //SE GRABA LA INFORMACION EN LA BDD
	    	    $this->getListaBlancaDao() ->actualizar ( $listablanca, $data['lis_bla_id'] );
	    	} else{
	    	    //SE GRABA LA INFORMACION EN LA BDD
	    	    $this->getListaBlancaDao() ->guardar ( $listablanca );
	    	}
	    	
	    	//SI SE EJECUTO EXITOSAMENTE SE REGRESA AL LISTADO DE CONTACTOS
	    	return $this->redirect ()->toRoute ( 'parametros', array (
	    			'controller' => 'listablanca',
	    			'action' => 'listado'
	    	) );
	    }

	    public function editarAction(){
    
			$id = $this->params ()->fromRoute ( 'id', 0 );
			$form = $this->getForm ();

			//FORMULARIO DE ACTUALIZACION DE INFORMACION
			$listablanca = $this->getListaBlancaDao()->traer ( $id );
			
			$form->bind ( $listablanca );
				
			$form->get ( 'ingresar' )->setAttribute ( 'value', 'Actualizar' );
			$form->get ( 'lis_bla_id' )->setAttribute ( 'value', $listablanca->getLis_bla_id() );
				
			$this->layout()->setVariable('menupadre', 'parametros')->setVariable('menuhijo', 'listablanca');
			$view = new ViewModel ( array (
					'formulario' => $form ,
			        'navegacion' => array('datos' =>  array ( 	'Inicio' => array('parametros','index','video'), 
	    	        											'Listado de Puntos de Recarga' => array('parametros','listablanca','listado'), 
	    	        											'Ingresar Punto de Recarga' => array('parametros','listablanca','editar', $id)) ),
			        'titulo' => 'Actualizar'
			) );

			$view->setTemplate('parametros/lista-blanca/ingresar');
			return $view;
		}
	}