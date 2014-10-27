<?php

namespace Usuarios\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Usuarios\Form\Menu;
use Usuarios\Form\MenuValidator;
use Application\Model\Entity\Menu as MenuEntity;


class MenuController extends AbstractActionController {
	
	protected $aplicacionDao;
	protected $menuDao;
	
	public function indexAction() {
	    $this->layout()->setVariable('activo', '6');
		return array (
				'menu' => $this->getMenuDao ()->traerTodos (),
		        'navegacion' => array('datos' =>  array ( 'Inicio' => array('parametros','index','video'), 'Men&uacute; de Opciones' => array('usuarios','menu','index')) ),
		);
	}
	public function ingresarAction() {
		$form = $this->getForm();
		
		return new ViewModel ( array (
				'formulario' => $form 
		) );
	}
	public function editarAction() {
		
		$id = $this->params ()->fromRoute ( 'id', 0 );
		
		if (! $id) {
			return $this->redirect ()->toRoute ( 'usuarios', array('controller' => 'menu', 'action' => 'index') );
		}
		
		$form = $this->getForm();
		$usuario = $this->getMenuDao()->traer($id);
		$form->bind ( $usuario );
		
		$form->get('ingresar')->setValue('Actualizar');
		$form->get('men_id')->setValue($usuario->getMen_id());
		
		$viewModel = new ViewModel ( array (
				'formulario' => $form ,
				'edit' => true
		) );
		
		$viewModel->setTemplate ( 'usuarios/menu/ingresar' );
		return $viewModel;
	}
	
	public function eliminarAction(){
		
		$men_id = $this->params ()->fromRoute ( 'id', 0 );
		
		if (! $men_id) {
			return $this->redirect ()->toRoute ( 'usuarios' );
		}
		
		$this->getMenuDao()->eliminar($men_id);
		
		return $this->redirect ()->toRoute ( 'usuarios', array (
				'controller' => 'menu',
				'action' => 'index'
		) );
	}
	
	public function validarAction(){
	
		//VERIFICA QUE SE HAYA REALIZADO UN POST DE INFORMACION
		if (! $this->request->isPost ()) {
			return $this->redirect ()->toRoute ( 'usuarios', array (
					'controller' => 'menu',
					'action' => 'index'
			) );
		}
	
		//CAPTURA LA INFORMACION ENVIADA EN EL POST
		$data = $this->request->getPost ();
	
		//VERIFICA EL IDIOMA INGRESADO PARA TRAER EL FORMULARIO SEGUN EL IDIOMA
		$form = $this->getForm();
	
		//SE VALIDA EL FORMULARIO
		$form->setInputFilter ( new MenuValidator() );
	
		//SE LLENAN LOS DATOS DEL FORMULARIO
		$form->setData ( $data );
		
		//SE VALIDA EL FORMULARIO ES CORRECTO
		if (! $form->isValid ()) {
			
			// SI EL FORMULARIO NO ES CORRECTO
			$modelView = new ViewModel ( array (
					'formulario' => $form
			) ); 
			 
			$modelView->setTemplate ( 'usuarios/menu/ingresar' );
			return $modelView;
		}
	
		
		//->AQUI EL FORMULARIO ES CORRECTO, SE VALIDO CORRECTAMENTE
	
		//SE GENERA EL OBJETO 
		$menu = new MenuEntity();
		//SE CARGA LA ENTIDAD CON LA INFORMACION DEL POST
		$menu->exchangeArray ( $data );
	
		//SE GRABA LA INFORMACION EN LA BDD
		$this->getMenuDao()->guardar ( $menu );
	
		//SI SE EJECUTO EXITOSAMENTE SE REGRESA AL LISTADO DE CONTACTOS
		return $this->redirect ()->toRoute ( 'usuarios', array (
				'controller' => 'menu',
				'action' => 'index'
		) );
	}
	
	/* public function validarRolUsuarioAction()
	{
		if(!$this->getRequest()->isPost()){
			return $this->redirect()->toRoute('usuarios',array('controller'=>'usuarios'));
		}
	
		$params=$this->request->getPost();
	
		$rolUsuario=new RolUsuarioEntity();
		$rolUsuario->exchangeArray($params);
		$this->getRolUsuarioDao()->eliminarPorUsuario($params['usu_id']);
		$this->getRolUsuarioDao()->guardar($rolUsuario);
	
		return $this->redirect()->toRoute('usuarios',array('controller'=>'usuarios'));
	} */
	
	/* public function cifrarClave($password){
		return md5($password);
	} */
	
	 /* public function rolesAction() { 
	 	return new ViewModel(array( 'roles' => $this->getRolDao()->traerTodos() )); 
	 }  */
	 	
	 	/* public function addRolAction() { 
	 		
	 		$form = new RolForm(); 
	 		$aplicaciones=$this->getAplicacionDao()->traerTodos(); 
	 		return new ViewModel ( array ( 'title' => 'Crear Rol', 'form' => $form, 'aplicaciones' => $aplicaciones )); } 
	 		
	 		public function editRolAction() { $rol_id = $this->params()->fromRoute ( 'id', 0 ); if (! $rol_id) { return $this->redirect()->toRoute ( 'usuarios ' ,array('controller'=>'usuarios', 'action' => 'roles')); } $form = new RolForm(); $aplicaciones=$this->getAplicacionDao()->traerTodos(); $rol = $this->getRolDao()->traerPorId ( $rol_id ); $rolApl=$this->getRolAplicacionDao()->traerPorRol ($rol_id ); $form->bind ( $rol ); $viewModel = new ViewModel ( array ( 'title' => 'Editar Rol', 'form' => $form, 'aplicaciones' => $aplicaciones, 'rolApl' =>$rolApl )); $viewModel->setTemplate ( 'usuarios/usuarios/add-rol.phtml' ); return $viewModel; } public function guardarRolAction() { if(!$this->getRequest()->isPost()){ return $this->redirect()->toRoute('usuarios',array('controller'=>'usuarios', 'action'=>'roles')); } $params=$this->request->getPost(); $rol=new Rol(); $rol->exchangeArray($params); $this->getRolDao()->guardar($rol); $aplicacionesArray=$params['APLICACION']; if($params['ROL_ID']!='') $this->getRolAplicacionDao()->eliminarPorRol($params['ROL_ID']); foreach($aplicacionesArray as $aplicacionParams){ if($aplicacionParams!='' && $aplicacionParams!=NULL){ $rolAplicacion=new RolAplicacion(); $aplicacionParams['ROL_ID']=$params['ROL_ID']; $rolAplicacion->exchangeArray($aplicacionParams); $this->getRolAplicacionDao()->guardar($rolAplicacion); } } return $this->redirect()->toRoute('usuarios',array('controller'=>'usuarios', 'action'=>'roles')); } 
	 		 public function getRolAplicacionDao() { if (!$this->rolAplicacionDao) { $sm = $this->getServiceLocator(); $this->rolAplicacionDao = $sm->get('Usuarios\Model\Dao\RolAplicacionDao'); } return $this->rolAplicacionDao; } public function getAplicacionDao() { if (!$this->aplicacionDao) { $sm = $this->getServiceLocator(); $this->aplicacionDao = $sm->get('Usuarios\Model\Dao\AplicacionDao'); } return $this->aplicacionDao; } public function getRolUsuarioDao() { if (!$this->rolUsuarioDao) { $sm = $this->getServiceLocator(); $this->rolUsuarioDao = $sm->get('Usuarios\Model\Dao\RolUsuarioDao'); } return $this->rolUsuarioDao; 
	 } */
	
	public function getMenuDao() {
		if (! $this->usuarioDao) {
			$sm = $this->getServiceLocator ();
			$this->usuarioDao = $sm->get ( 'Application\Model\Dao\MenuDao' );
		}
		return $this->usuarioDao;
	}
	
	public function getAplicacionDao() {
		if (! $this->aplicacionDao) {
			$sm = $this->getServiceLocator ();
			$this->aplicacionDao = $sm->get ( 'Application\Model\Dao\AplicacionDao' );
		}
		return $this->aplicacionDao;
	}
	
	public function getForm() {
		$form = new Menu ();
		$form->get ( 'apl_id' )->setValueOptions ( $this->getAplicacionDao ()->traerArreglo () );
		return $form;
	}
	
}