<?php

namespace Usuarios\Controller;

use Application\Model\Entity\RolUsuario as RolUsuarioEntity;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Usuarios\Form\Usuario;
use Usuarios\Form\UsuarioValidator;
use Application\Model\Entity\Usuario as UsuarioEntity;
use Usuarios\Form\RolUsuario;

class UsuariosController extends AbstractActionController {
	
	protected $rolDao;
	// protected $rolAplicacionDao;
	// protected $aplicacionDao;
	protected $rolUsuarioDao;
	protected $usuarioDao;
	protected $ciudadDao;
	
	// protected $max_detalle_contacto=5;
	public function indexAction() {
	    $this->layout()->setVariable('menupadre', 'administracion')->setVariable('menuhijo', 'usuarios');
		return array (
			'usuarios' => $this->getUsuarioDao ()->traerTodos (),
		    'navegacion' => array('datos' =>  array ( 'Inicio' => array('parametros','index','video'), 'Listado de Usuarios' => array('usuarios','usuarios','index')) ),
		) ;
	}
	public function addAction() {
		$form = $this->getForm();
		
		$this->layout()->setVariable('menupadre', 'administracion')->setVariable('menuhijo', 'usuarios');
		return new ViewModel ( array (
				'formulario' => $form,
		        'navegacion' => array('datos' =>  array ( 'Inicio' => array('parametros','index','video'), 'Listado de Usuarios' => array('usuarios','usuarios','index'), 'Ingresar Usuarios' => array('usuarios','usuarios','add')) ),
		        'titulo' => 'Nuevo'
		) );
	}
	public function editAction() {
		
		$usu_id = $this->params ()->fromRoute ( 'id', 0 );
		
		if (! $usu_id) {
			return $this->redirect ()->toRoute ( 'usuarios' );
		}
		
		$form = $this->getForm();
		$usuario = $this->getUsuarioDao()->traer($usu_id);
		$form->bind ( $usuario );
		
		$form->get('ingresar')->setValue('Actualizar');
		$form->get('usu_id')->setValue($usuario->getUsu_id());
		
		$this->layout()->setVariable('menupadre', 'administracion')->setVariable('menuhijo', 'usuarios');
		$viewModel = new ViewModel ( array (
				'formulario' => $form ,
				'edit' => true,
		        'navegacion' => array('datos' =>  array ( 'Inicio' => array('parametros','index','video'), 'Listado de Usuarios' => array('usuarios','usuarios','index'), 'Actualizar Usuarios' => array('usuarios','usuarios','edit', $usu_id)) ),
		        'titulo' => 'Actualizar'
		) );
		
		$viewModel->setTemplate ( 'usuarios/usuarios/add' );
		return $viewModel;
	}
	
	public function asociarAction(){
		
		$usu_id = $this->params()->fromRoute ( 'id', 0 );
		if (! $usu_id) {
			return $this->redirect()->toRoute ( 'usuarios' );
		}
		
		$form = $this->getFormRolUsuario();
		
		$usuario = $this->getUsuarioDao()->traer($usu_id);
		
		$form->get('usu_id')->setValue($usu_id);
		$form->get('usu_nombre')->setValue($usuario->getUsu_nombre() . ' ' . $usuario->getUsu_apellido());
		
		$rolUsuario = $this->getRolUsuarioDao()->traerPorUsCodigo ( $usu_id );
		
		if(is_object($rolUsuario)){
			$form->bind ( $rolUsuario );
		}
		
		$this->layout()->setVariable('menupadre', 'administracion')->setVariable('menuhijo', 'usuarios');
		$viewModel = new ViewModel (array(
				'title' => 'Editar Empresa',
				'formulario' => $form
		));
		
		return $viewModel;
		
	}
	
	public function eliminarAction(){
		
		$usu_id = $this->params ()->fromRoute ( 'id', 0 );
		
		if (! $usu_id) {
			return $this->redirect ()->toRoute ( 'usuarios' );
		}
		
		$this->getUsuarioDao()->eliminar($usu_id);
		
		return $this->redirect ()->toRoute ( 'usuarios', array (
				'controller' => 'usuarios',
				'action' => 'index'
		) );
	}
	
	public function validarAction(){
	
		//VERIFICA QUE SE HAYA REALIZADO UN POST DE INFORMACION
		if (! $this->request->isPost ()) {
			return $this->redirect ()->toRoute ( 'usuarios', array (
					'controller' => 'usuarios',
					'action' => 'index'
			) );
		}
	
		//CAPTURA LA INFORMACION ENVIADA EN EL POST
		$data = $this->request->getPost ();
	
		//VERIFICA EL IDIOMA INGRESADO PARA TRAER EL FORMULARIO SEGUN EL IDIOMA
		$form = $this->getForm();
	
		//SE VALIDA EL FORMULARIO
		$form->setInputFilter ( new UsuarioValidator() );
	
		//SE LLENAN LOS DATOS DEL FORMULARIO
		$form->setData ( $data );
		
		if(!empty($data['usu_id']) && !is_null($data['usu_id'])){
			$form->getInputFilter()->get('usu_clave')->setRequired(false);
			$form->getInputFilter()->get('usu_clave_check')->setRequired(false);
		}
	
		//SE VALIDA EL FORMULARIO ES CORRECTO
		if (! $form->isValid ()) {
			
			$edit = false;
			if(!empty($data['usu_id']) && !is_null($data['usu_id'])){
				$edit = true;
			}
			
			$this->layout()->setVariable('menupadre', 'administracion')->setVariable('menuhijo', 'usuarios');
			// SI EL FORMULARIO NO ES CORRECTO
			$modelView = new ViewModel ( array (
					'formulario' => $form ,
					'edit' => $edit,
			        'navegacion' => array('datos' =>  array ( 'Inicio' => array('parametros','index','video'), 'Listado de Usuarios' => array('usuarios','usuarios','index'), 'Ingresar Usuarios' => array('usuarios','usuarios','add')) ),
			        'titulo' => 'Validar informaci&oacute;n del'
			) );
			 
			$modelView->setTemplate ( 'usuarios/usuarios/add' );
			return $modelView;
		}
	
		
		//->AQUI EL FORMULARIO ES CORRECTO, SE VALIDO CORRECTAMENTE
	
		if(!empty($data['usu_id']) && !is_null($data['usu_id'])){
			unset($data['usu_clave'], $data['usu_clave_check']);
		}else{
			$data['usu_clave'] = $this->cifrarClave($data['usu_clave']);
		}
		
		//SE GENERA EL OBJETO 
		$usuario = new UsuarioEntity();
		//SE CARGA LA ENTIDAD CON LA INFORMACION DEL POST
		$usuario->exchangeArray ( $data );
	
		//SE GRABA LA INFORMACION EN LA BDD
		$this->getUsuarioDao()->guardar ( $usuario );
	
		//SI SE EJECUTO EXITOSAMENTE SE REGRESA AL LISTADO DE CONTACTOS
		return $this->redirect ()->toRoute ( 'usuarios', array (
				'controller' => 'usuarios',
				'action' => 'index'
		) );
	}
	
	public function validarRolUsuarioAction()
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
	}
	
	public function cifrarClave($password){
		return md5($password);
	}
	
	 public function rolesAction() { 
	 	return new ViewModel(array( 'roles' => $this->getRolDao()->traerTodos() )); 
	 } 
	 	
	 	/* public function addRolAction() { 
	 		
	 		$form = new RolForm(); 
	 		$aplicaciones=$this->getAplicacionDao()->traerTodos(); 
	 		return new ViewModel ( array ( 'title' => 'Crear Rol', 'form' => $form, 'aplicaciones' => $aplicaciones )); } 
	 		
	 		public function editRolAction() { $rol_id = $this->params()->fromRoute ( 'id', 0 ); if (! $rol_id) { return $this->redirect()->toRoute ( 'usuarios ' ,array('controller'=>'usuarios', 'action' => 'roles')); } $form = new RolForm(); $aplicaciones=$this->getAplicacionDao()->traerTodos(); $rol = $this->getRolDao()->traerPorId ( $rol_id ); $rolApl=$this->getRolAplicacionDao()->traerPorRol ($rol_id ); $form->bind ( $rol ); $viewModel = new ViewModel ( array ( 'title' => 'Editar Rol', 'form' => $form, 'aplicaciones' => $aplicaciones, 'rolApl' =>$rolApl )); $viewModel->setTemplate ( 'usuarios/usuarios/add-rol.phtml' ); return $viewModel; } public function guardarRolAction() { if(!$this->getRequest()->isPost()){ return $this->redirect()->toRoute('usuarios',array('controller'=>'usuarios', 'action'=>'roles')); } $params=$this->request->getPost(); $rol=new Rol(); $rol->exchangeArray($params); $this->getRolDao()->guardar($rol); $aplicacionesArray=$params['APLICACION']; if($params['ROL_ID']!='') $this->getRolAplicacionDao()->eliminarPorRol($params['ROL_ID']); foreach($aplicacionesArray as $aplicacionParams){ if($aplicacionParams!='' && $aplicacionParams!=NULL){ $rolAplicacion=new RolAplicacion(); $aplicacionParams['ROL_ID']=$params['ROL_ID']; $rolAplicacion->exchangeArray($aplicacionParams); $this->getRolAplicacionDao()->guardar($rolAplicacion); } } return $this->redirect()->toRoute('usuarios',array('controller'=>'usuarios', 'action'=>'roles')); } 
	 		 public function getRolAplicacionDao() { if (!$this->rolAplicacionDao) { $sm = $this->getServiceLocator(); $this->rolAplicacionDao = $sm->get('Usuarios\Model\Dao\RolAplicacionDao'); } return $this->rolAplicacionDao; } public function getAplicacionDao() { if (!$this->aplicacionDao) { $sm = $this->getServiceLocator(); $this->aplicacionDao = $sm->get('Usuarios\Model\Dao\AplicacionDao'); } return $this->aplicacionDao; } public function getRolUsuarioDao() { if (!$this->rolUsuarioDao) { $sm = $this->getServiceLocator(); $this->rolUsuarioDao = $sm->get('Usuarios\Model\Dao\RolUsuarioDao'); } return $this->rolUsuarioDao; 
	 } */
	
	public function getCiudadDao() {
		if (! $this->ciudadDao) {
			$sm = $this->getServiceLocator ();
			$this->ciudadDao = $sm->get ( 'Application\Model\Dao\CiudadDao' );
		}
		return $this->ciudadDao;
	}
	public function getUsuarioDao() {
		if (! $this->usuarioDao) {
			$sm = $this->getServiceLocator ();
			$this->usuarioDao = $sm->get ( 'Application\Model\Dao\UsuarioDao' );
		}
		return $this->usuarioDao;
	}
	
	public function getRolDao() { 
		if (!$this->rolDao) { 
			$sm = $this->getServiceLocator(); 
			$this->rolDao = $sm->get('Application\Model\Dao\RolDao'); 
		} 
		return $this->rolDao; 
	}
	
	public function getRolUsuarioDao() {
		if (!$this->rolUsuarioDao) {
			$sm = $this->getServiceLocator();
			$this->rolUsuarioDao = $sm->get('Application\Model\Dao\RolUsuarioDao');
		}
		return $this->rolUsuarioDao;
	}
	
	public function getForm() {
		$form = new Usuario ();
		$form->get ( 'ciu_id' )->setValueOptions ( $this->getCiudadDao ()->traerTodosArreglo () );
		return $form;
	}
	
	public function getFormRolUsuario() {
		$form = new RolUsuario();
		$form->get ( 'rol_id' )->setValueOptions ( $this->getRolDao()->getRolesSelect() );
		return $form;
	}
	
	/*
	 * public function consultaNombreRolXmlHttpAction(){ if($this->getRequest()->isXmlHttpRequest()){ $rol_descripcion = $this->getRequest()->getPost('ROL_DESCRIPCION'); $rol_id = $this->getRequest()->getPost('ROL_ID'); $listado = $this->getRolDao()->existeDescripcion($rol_descripcion,$rol_id); $response=$this->getResponse(); $response->setStatusCode(200); $response->setContent($listado); return $response; }else{ return $this->redirect()->toRoute('empresas',array('controller'=>'empresas')); } }
	 */
}
