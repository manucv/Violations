<?php

namespace Usuarios\Controller;

// use Usuarios\Model\Entity\RolUsuario;
use Application\Model\Entity\RolAplicacion;
use Application\Model\Entity\Rol as RolEntity;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Usuarios\Form\Rol;

class RolesController extends AbstractActionController {
	
	protected $rolDao;
	protected $aplicacionDao;
	protected $rolAplicacionDao;
	
	public function listadoAction() {
	    $this->layout()->setVariable('menupadre', 'administracion')->setVariable('menuhijo', 'roles');
		return array (
		      'roles' => $this->getRolDao ()->traerTodos (),
		      'navegacion' => array('datos' =>  array ( 'Inicio' => array('parametros','index','video'), 'Listado de Roles' => array('usuarios','roles','listado')) ),
		);
	}
	
	public function ingresarAction() {
		$form = $this->getForm ();
		
		$this->layout()->setVariable('menupadre', 'administracion')->setVariable('menuhijo', 'roles');
		return new ViewModel ( array (
				'form' => $form,
		        'navegacion' => array('datos' =>  array ( 'Inicio' => array('parametros','index','video'), 'Listado de Roles' => array('usuarios','roles','listado'), 'Ingresar Rol' => array('usuarios','roles','ingresar')) ),
		        'titulo' => 'Nuevo'
		) );
	}
	
	public function validarAction() {
		
		if (! $this->getRequest ()->isPost ()) {
			return $this->redirect ()->toRoute ( 'usuarios', array (
					'controller' => 'roles',
					'action' => 'listado' 
			) );
		}
		
		$params = $this->request->getPost ();
		
		$rol = new RolEntity ();
		$rol->exchangeArray ( $params );
		$rol_id_bdd = $this->getRolDao ()->guardar ( $rol );
		
		if (!empty($params ['rol_id']) && !is_null($params ['rol_id']) ){
			$this->getRolAplicacionDao ()->eliminarPorRol ( $params ['rol_id'] );
		}
		
		foreach ( $params ['aplicacion'] as $aplicacionParams ) {
			
			if (!empty($aplicacionParams) && !is_null($aplicacionParams)) {
				
				$rolAplicacion = new RolAplicacion ();
				$aplicacionesArray ['rol_id'] = $rol_id_bdd;
				$aplicacionesArray ['apl_id'] = $aplicacionParams;
				
				$rolAplicacion->exchangeArray ( $aplicacionesArray );
				$this->getRolAplicacionDao ()->guardar ( $rolAplicacion );
			}
		}
		
		$this->layout()->setVariable('menupadre', 'administracion')->setVariable('menuhijo', 'roles');
		return $this->redirect ()->toRoute ( 'usuarios', array (
				'controller' => 'roles',
				'action' => 'listado' 
		) );
	}
	
	public function eliminarAction(){
		
		$rol_id = $this->params()->fromRoute('id', 0);

		$this->getRolAplicacionDao()->eliminarPorRol($rol_id);
		$this->getRolDao()->eliminar($rol_id);
		
		return $this->redirect ()->toRoute ( 'usuarios', array (
				'controller' => 'roles',
				'action' => 'listado'
		) );
	}
	
	public function editarAction() { 
		
		$rol_id = $this->params()->fromRoute ( 'id', 0 ); 
		
		if (! $rol_id) { 
			return $this->redirect()->toRoute ( 'usuarios ' ,array('controller'=>'roles', 'action' => 'listado')); 
		}
		 
		$form = $this->getForm();
		$rol = $this->getRolDao()->traer ( $rol_id );
		 
		$form->bind ( $rol );
		$aplicaciones=$this->getAplicacionDao()->traerTodos(); 
		
		$opciones_checkbox = $form->get('aplicacion')->getValueOptions();
		
		$checked = $this->getRolAplicacionDao()->traerPorRol($rol_id);
		
		$seleccionado = array();
		foreach ($checked as $check){
			$sel = $check->getApl_id();
			$seleccionado[] =  $sel;
		}
		$form->get('aplicacion')->setAttributes(array('value' => $seleccionado));
		
		$this->layout()->setVariable('menupadre', 'administracion')->setVariable('menuhijo', 'roles');
		$viewModel = new ViewModel ( 
		    array ( 
		        'title' => 'Editar Rol', 
		        'form' => $form, 
		        'aplicaciones' => $aplicaciones,
		        'navegacion' => array('datos' =>  array ( 'Inicio' => array('parametros','index','video'), 'Listado de Roles' => array('usuarios','roles','listado'), 'Actualizar Rol' => array('usuarios','roles','editar', $rol_id)) ),
		        'titulo' => 'Actualizar'
		 )); 
		$viewModel->setTemplate ( 'usuarios/roles/ingresar.phtml' ); 
		return $viewModel; 
	}
	
	
	public function getAplicacionDao() {
		if (! $this->aplicacionDao) {
			$sm = $this->getServiceLocator ();
			$this->aplicacionDao = $sm->get ( 'Application\Model\Dao\AplicacionDao' );
		}
		return $this->aplicacionDao;
	}
	public function getRolDao() {
		if (! $this->rolDao) {
			$sm = $this->getServiceLocator ();
			$this->rolDao = $sm->get ( 'Application\Model\Dao\RolDao' );
		}
		return $this->rolDao;
	}
	
	public function getRolAplicacionDao() { 
		if (!$this->rolAplicacionDao) { 
			$sm = $this->getServiceLocator(); $this->rolAplicacionDao = $sm->get('Application\Model\Dao\RolAplicacionDao'); 
		} 
		return $this->rolAplicacionDao; 
	}
	
	public function getForm() {
		$form = new Rol ();
		$form->get('aplicacion')->setValueOptions($this->getAplicacionDao()->traerArreglo());
		return $form;
	}
	
}