<?php 
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Model\Login as LoginService;
use Application\Form\Login;
use Application\Form\LoginValidator;

class LoginController extends AbstractActionController {
	
	private $login;
	protected $rolUsuarioDao;
	protected $usuarioDao;
	
	public function indexAction	() {
		
		$form = new Login ( 'login' );
		$loggedIn = $this->login->isLoggedIn ();

		$viewParams = array ('form' => $form );	
		
		if ($loggedIn) {
			
			return $this->redirect ()->toRoute ( 'parametros', array (
					'controller' => 'index',
					'action' => 'index'
			) );
		}
		
		return $viewParams;
	}
	
	public function autenticarAction() {
		
		if (! $this->request->isPost ()) {
			$this->redirect ()->toRoute ( 'application', array (
					'controller' => 'login'
			) );
		}
		
		$form = new Login ( 'login' );
		$form->setInputFilter ( new LoginValidator () );
		
		$data = $this->request->getPost ();
		$form->setData ( $data );
		
		if (! $form->isValid ()) {
			$modelView = new ViewModel ( array ( 'form' => $form	) );
			$modelView->setTemplate ( 'application/login/index' );
			return $modelView;
		}
		
		$values = $form->getData ();
		
		$usuario = $values ['usu_usuario'];
		$clave = $values ['usu_clave'];

		try {
			
			$this->login->setMessage ( 'El nombre de usuario o la contrase&ntilde;a son incorrectas.', LoginService::NOT_IDENTITY );
			$this->login->setMessage ( 'La contrase&ntilde;a ingresada no es correcta. Intentelo de nuevo', LoginService::INVALID_CREDENTIAL );
			$this->login->setMessage ( 'Los campos de usuario y contrase&ntilde;a no pueden dejarse en blanco.', LoginService::INVALID_LOGIN );
			$this->login->setMessage ( 'Usuario inactivo. Comun&iacute;quese con el administrador', LoginService::USER_INACTIVE );
			
			$this->login->login ( $usuario, $this->secret($clave) );
			
			$usuario_rol = $this->getUsuarioDao()->traerPorUsuarioClave($usuario, $clave);
		    $rolUsuarioObjeto = $this->getRolUsuarioDao()->rolPorCodigo( $usuario_rol->getUsu_id() );
			
			if(is_object($rolUsuarioObjeto)){ 
				$role=$rolUsuarioObjeto->getRol_id();
				$this->login->getIdentity()->rol_id=$role;
				
			}else{	
				return $this->redirect()->toRoute('application', array('controller' => 'login','action' => 'denied'));
			}

			return $this->redirect ()->toRoute ( 'parametros', array (
				'controller' => 'index',
				'action' => 'index'
			) );

		} catch ( \Exception $e ) {
			
			$this->layout ()->mensaje = $e->getMessage ();
			
			$viewModel = new ViewModel ( array ( 'form' => new Login ( 'login' ) ) );
			$viewModel->setTemplate ( 'application/login/index' );
				
			return $viewModel;
			
		}
	}
	
	public function setLogin(LoginService $login) {
		$this->login = $login;
	}
	
	public function logoutAction(){
		$this->login->logout();
		session_unset();
		session_destroy();
		
		return $this->redirect ()->toRoute ( 'application', array (
				'controller' => 'login',
				'action' => 'logout'
			) );
		
	}

	public function deniedAction(){
		$this->login->logout();
		session_unset();
		session_destroy();
		
		return $this->redirect ()->toRoute ( 'application', array (
				'controller' => 'error',
				'action' => 'denied'
			) );
		
	}	

	public function secret($password){
		/*Aqui va la llamada a la librer�a de validaci�n de contrase�as de Azul*/
		return md5($password);
// 		$eclave='';
// 			for ($i = 0; $i < strlen($password); $i++) {
// 				$c=(ord(strtoupper($password[$i])));  
// 				$eclave.=$c.'%';
// 			}
// 			return ($eclave);
	}

    public function getRolUsuarioDao()
 	{
		if (!$this->rolUsuarioDao) {
			$sm = $this->getServiceLocator();
			$this->rolUsuarioDao = $sm->get('Application\Model\Dao\RolUsuarioDao');
		}
		return $this->rolUsuarioDao;
    }
    
    public function getUsuarioDao()
    {
    	if (!$this->usuarioDao) {
    		$sm = $this->getServiceLocator();
    		$this->usuarioDao = $sm->get('Application\Model\Dao\UsuarioDao');
    	}
    	return $this->usuarioDao;
    }
}