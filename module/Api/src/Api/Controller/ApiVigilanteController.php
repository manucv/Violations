<?php
	//ApiVigilanteController.php

	namespace Api\Controller;

	use Zend\Mvc\Controller\AbstractActionController;
	use Zend\View\Model\ViewModel;

	use Zend\Mail;
	use Zend\Mime\Message as MimeMessage;
	use Zend\Mime\Part as MimePart;
	use Zend\Mail\Transport\Smtp as SmtpTransport;
	use Zend\Mail\Transport\SmtpOptions;

	use Zend\Json\Json;

	use Application\Model\Entity\LogParqueadero as LogParqueaderoEntity;
	use Application\Model\Entity\Automovil as AutomovilEntity;
	use Application\Model\Entity\Transaccion as TransaccionEntity;
	use Application\Model\Entity\RelacionCliente as RelacionClienteEntity;
	use Application\Model\Entity\TransferenciaSaldo as TransferenciaSaldoEntity;
	use Application\Model\Entity\Cliente as ClienteEntity;
	use Application\Model\Entity\Usuario as UsuarioEntity;
	use Application\Model\Entity\Publicidad as PublicidadEntity;

	class ApiVigilanteController extends AbstractActionController
	{
	    public function indexAction()
	    {
	        return new ViewModel();
	    }

	    public function loginAction()
	    {
	        if($this->getRequest()->isGET()){
	            $email =  $this->getRequest()->getQuery('email');
	            $passw =  $this->getRequest()->getQuery('passw');

	            $cliente = $this->getClienteDao()->buscarPorEmailOUsuario($email,$passw);
	            $content='';
	            if(is_object($cliente)){
	                $content=json_encode($cliente->getArrayCopy());
	            }else{
	                $content=json_encode(new stdClass());
	            }

	            $response=$this->getResponse();
	            $response->setStatusCode(200);
	            $response->setContent($content);
	            return $response;
	        }else{
				return $this->redirect()->toRoute ( 'parametros', array (
						'controller' => 'index',
						'action' => 'index'
				) );
	        }
	    }
	}