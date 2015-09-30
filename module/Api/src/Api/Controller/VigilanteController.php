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
	use Application\Model\Entity\Infraccion as InfraccionEntity;
	use Application\Model\Entity\MultaParqueadero as MultaParqueaderoEntity;

	use Zend\Http\PhpEnvironment\Request;
	use Zend\Filter\File;

	class VigilanteController extends AbstractActionController
	{

	    protected $clienteDao;
	    protected $usuarioDao;
	    protected $rolUsuarioDao;
	    protected $sectorVigilanteDao;
	    protected $parqueaderoDao;
	    protected $tipoInfraccionDao;
		protected $infraccionDao;
		protected $multaParqueaderoDao;

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

	    public function categoriaInfraccionesAction() //categoria_infracciones
	    {	 	    
	    	if($this->getRequest()->isGET()){
	    		if(!is_null($this->params('id'))){
	    			$cat_inf_id=$this->params('id');
	    			if(!is_null($this->params('option'))){
	    				$option=$this->params('option');	
	    				switch($option){
	    					case 'tipo_infracciones':
								$tiposInfraccion=$this->getTipoInfraccionDao()->traerTodosPorCategoria($cat_inf_id);

				                $tiposInfraccionArray=array();
					            foreach($tiposInfraccion as $tipoInfraccion){
					                $tiposInfraccionArray[]=$tipoInfraccion->getArrayCopy();
					            }
	    						$content=json_encode($tiposInfraccionArray);
	    						
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

	    public function tipoInfraccionesAction() //tipo_infracciones
	    {	 	    
	    	if($this->getRequest()->isGET()){
	    		if(!is_null($this->params('id'))){
	    			$tip_inf_id=$this->params('id');
	    			if(!is_null($this->params('option'))){
	    				$option=$this->params('option');	
	    				switch($option){
	    					default:
	    						return $this->redirect()->toRoute('parametros',array('controller' => 'index','action' => 'index'));
	    					break;
	    				}
	    			}else{
	    				//Funcionalidad sí no hay opción, es decir solo el id del vigilante
	    				$tipoInfraccion=$this->getTipoInfraccionDao()->traer($tip_inf_id);
	    				$content=json_encode($tipoInfraccion);
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


	    public function infraccionesAction()
	    {

	    	$content="";
			
	        if($this->getRequest()->isPOST()){ //hay que cambiar esto
	        	$data = $this->request->getPost ();

	        	if(!is_null($this->params('id'))){
	        		if(!is_null($this->params('option'))){
	    				$option=$this->params('option');	
	    				switch($option){
	    					case 'liberar':
	    						$par_id = $this->params('id');
	    						$this->getParqueaderoDao()->liberarParqueaderos($par_id);
	    						echo $data['observation'];

	    					break;
	    				}
	    			}
	        	}else{
					$par_id 		= $data['par_id'];
					$aut_placa 		= $data['aut_placa'];
					$inf_latitud 	= floatval($data['inf_latitud']);
					$inf_longitud 	= floatval($data['inf_longitud']);
					$inf_fecha 		= $data['inf_fecha'];
					$tip_inf_id 	= $data['tip_inf_id'];

			    	$target_dir = "/var/www/html/violations/files/";
					$target_file = $target_dir . basename($_FILES["image"]["name"]);
					move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

					$infraccion = new InfraccionEntity();

					$infraccionData=array();
					$infraccionData['inf_fecha']	=$inf_fecha;
					$infraccionData['inf_detalles']	="(Ningún)";
					$infraccionData['usu_id']		=1;	//Reemplazar
					$infraccionData['tip_inf_id']	=$tip_inf_id;
					$infraccionData['sec_id']		=5;	//Reemplazar
					$infraccionData['inf_latitud']	=$inf_latitud;
					$infraccionData['inf_longitud']	=$inf_longitud;

					$infraccion->exchangeArray ( $infraccionData );
	                $inf_id=$this->getInfraccionDao()->guardar($infraccion);

					$multaParqueadero = new MultaParqueaderoEntity();
					$multaParqueaderoData=array();
					$multaParqueaderoData['par_id']			= $par_id;
					$multaParqueaderoData['aut_placa']		= $aut_placa;
					$multaParqueaderoData['inf_id']			= $inf_id;
					$multaParqueaderoData['mul_par_estado']	= 'R'; //Reemplazar
					$multaParqueaderoData['mul_par_valor']	= 0; //Reemplazar
					$multaParqueaderoData['mul_par_imagen']	= $target_file;

					$multaParqueadero->exchangeArray ( $multaParqueaderoData );
					$mul_par_id=$this->getMultaParqueaderoDao()->guardar($multaParqueadero);

					$content=json_encode($multaParqueadero->getArrayCopy());
				}	
	        }else{
	        	//Funcionalidad sí es q es GET, es decir consulta de infracciones
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
	    public function getInfraccionDao() {
	        if (! $this->infraccionDao) {
	            $sm = $this->getServiceLocator ();
	            $this->infraccionDao = $sm->get ( 'Application\Model\Dao\InfraccionDao' );
	        }
	        return $this->infraccionDao;
	    }			    
	    public function getTipoInfraccionDao() {
	        if (! $this->tipoInfraccionDao) {
	            $sm = $this->getServiceLocator ();
	            $this->tipoInfraccionDao = $sm->get ( 'Application\Model\Dao\TipoInfraccionDao' );
	        }
	        return $this->tipoInfraccionDao;
	    }		
	    public function getMultaParqueaderoDao(){
	    	if (! $this->multaParqueaderoDao) {
	            $sm = $this->getServiceLocator ();
	            $this->multaParqueaderoDao = $sm->get ( 'Application\Model\Dao\MultaParqueaderoDao' );
	        }
	        return $this->multaParqueaderoDao;
	    }

	}