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

	use Application\Model\Entity\Cliente as ClienteEntity;
	use Application\Model\Entity\RolUsuario as RolUsuarioEntity;
	

	class VigilanteController extends AbstractActionController
	{

	    protected $clienteDao;
	    protected $usuarioDao;
	    protected $rolUsuarioDao;
	    protected $sectorVigilanteDao;
	    protected $parqueaderoDao;

	    public function indexAction()
	    {
	        return new ViewModel();
	    }

	    public function loginAction()
	    {
	        if($this->getRequest()->isPOST()){
	        	$data = $this->request->getPost ();

	            $email =  $data['email'];
	            $passw =  $data['passw'];

	            $usuario = $this->getUsuarioDao()->traerPorUsuarioClave($email,$passw);
	            $content='';
	            if(is_object($usuario)){
	            	/* Validamos que el usuario que trata de logearse tiene por rol el #4 = Vigilante */
	            	$rol_usuario=$this->getRolUsuarioDao()->traerPorUsCodigo($usuario->getUsu_id());
	            	if(is_object($rol_usuario)){
						$rol=$rol_usuario->getRol_id();
						if($rol=4){
							$total_sectores=$this->getSectorVigilanteDao()->traerTodos($usuario->getUsu_id())->count();
							if($total_sectores>0){
								$content=json_encode($usuario->getArrayCopy());		
							}
						}
					}	
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

	    public function vigilantesAction()
	    {	    
	    	if($this->getRequest()->isGET()){
	    		if(!is_null($this->params('id'))){
	    			$usu_id=$this->params('id');

	    			if(!is_null($this->params('option'))){
	    				$option=$this->params('option');	
	    				switch($option){
	    					case 'sectores':
	    						//Functionalidad sí es que buscamos los sectores de un vigilante X
	    						$sectores=$this->getSectorVigilanteDao()->traerTodos($usu_id);
				                $sectoresArray=array();
					            foreach($sectores as $sector){
					                $sectoresArray[]=$sector->getArrayCopy();
					            }
	    						$content=json_encode($sectoresArray);
	    					break;
	    					deafult:
	    						return $this->redirect()->toRoute('parametros',array('controller' => 'index','action' => 'index'));
	    					break;
	    				}
	    			}else{
	    				//Funcionalidad sí no hay opción, es decir solo el id del vigilante
	    				return $this->redirect()->toRoute('parametros',array('controller' => 'index','action' => 'index'));
	    			}
	    		}else{
	    			//Funcionalidad sí no hay id, es decir retorne todos los vigilantes
	    			return $this->redirect()->toRoute('parametros',array('controller' => 'index','action' => 'index'));
	    		}
	    	}else{
	    		//Funcionalidad sí es q es post, es decir guarde un vigilante
	            return $this->redirect()->toRoute('parametros',array('controller' => 'index','action' => 'index'));
	    	}

            $response=$this->getResponse();
            $response->setStatusCode(200);
            $response->setContent($content);
            return $response;
	    }
	    public function sectoresAction()
	    {	 	    
	    	if($this->getRequest()->isGET()){
	    		if(!is_null($this->params('id'))){
	    			$sec_id=$this->params('id');

	    			if(!is_null($this->params('option'))){
	    				$option=$this->params('option');	
	    				switch($option){
	    					case 'parqueaderos':
	    						if($this->getRequest()->getQuery('par_estado')){
	    							$par_estado=$this->getRequest()->getQuery('par_estado');
	    							$parqueaderos=$this->getParqueaderoDao()->traerTodosPorSector($sec_id,$par_estado);	
	    						}else{
	    							//Functionalidad sí es que buscamos los sectores de un vigilante X
	    							$parqueaderos=$this->getParqueaderoDao()->traerTodosPorSector($sec_id);	
	    						}

				                $parqueaderosArray=array();
					            foreach($parqueaderos as $parqueadero){
					                $parqueaderosArray[]=$parqueadero->getArrayCopy();
					            }
	    						$content=json_encode($parqueaderosArray);
	    					break;
	    					deafult:
	    						return $this->redirect()->toRoute('parametros',array('controller' => 'index','action' => 'index'));
	    					break;
	    				}
	    			}else{
	    				//Funcionalidad sí no hay opción, es decir solo el id del vigilante
	    				return $this->redirect()->toRoute('parametros',array('controller' => 'index','action' => 'index'));
	    			}
	    		}else{
	    			//Funcionalidad sí no hay id, es decir retorne todos los vigilantes
	    			return $this->redirect()->toRoute('parametros',array('controller' => 'index','action' => 'index'));
	    		}
	    	}else{
	    		//Funcionalidad sí es q es post, es decir guarde un vigilante
	            return $this->redirect()->toRoute('parametros',array('controller' => 'index','action' => 'index'));
	    	}

            $response=$this->getResponse();
            $response->setStatusCode(200);
            $response->setContent($content);
            return $response;

	    }

		public function getUsuarioDao() {
		    if (! $this->usuarioDao) {
		        $sm = $this->getServiceLocator ();
		        $this->usuarioDao = $sm->get ( 'Application\Model\Dao\UsuarioDao' );
		    }
		    return $this->usuarioDao;
		}

		public function getRolUsuarioDao() {
		    if (! $this->rolUsuarioDao) {
		        $sm = $this->getServiceLocator ();
		        $this->rolUsuarioDao = $sm->get ( 'Application\Model\Dao\RolUsuarioDao' );
		    }
		    return $this->rolUsuarioDao;
		}    

		public function getSectorVigilanteDao() {
		    if (! $this->sectorVigilanteDao) {
		        $sm = $this->getServiceLocator();
		        $this->sectorVigilanteDao = $sm->get ( 'Application\Model\Dao\SectorVigilanteDao' );
		    }
		    return $this->sectorVigilanteDao;
		}

	    public function getParqueaderoDao() {
	        if (! $this->parqueaderoDao) {
	            $sm = $this->getServiceLocator ();
	            $this->parqueaderoDao = $sm->get ( 'Application\Model\Dao\ParqueaderoDao' );
	        }
	        return $this->parqueaderoDao;
	    }		
	}