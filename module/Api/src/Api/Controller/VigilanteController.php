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
	use Zend\Http\PhpEnvironment\Request;
	use Zend\Filter\File;
	use Zend\Soap\Client as SoapClient;

	use Application\Model\Entity\Cliente as ClienteEntity;
	use Application\Model\Entity\RolUsuario as RolUsuarioEntity;
	use Application\Model\Entity\Infraccion as InfraccionEntity;
	use Application\Model\Entity\TipoInfraccion as TipoInfraccionEntity;
	use Application\Model\Entity\MultaParqueadero as MultaParqueaderoEntity;
	use Application\Model\Entity\Automovil as AutomovilEntity;
	use Application\Model\Entity\LogParqueadero as LogParqueaderoEntity;
	use Application\Model\Entity\ListaBlanca as ListaBlancaEntity;

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
		protected $automovilDao;
		protected $logParqueaderoDao;
		protected $listaBlancaDao;


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
	    							$parqueaderos=$this->getParqueaderoDao()->traerTodosPorSectorJSON($sec_id,$par_estado);	
	    						}else{
	    							//Functionalidad sí es que buscamos los sectores de un vigilante X
	    							$parqueaderos=$this->getParqueaderoDao()->traerTodosPorSectorJSON($sec_id);	
	    						}
	    						/*	
				                $parqueaderosArray=array();
					            foreach($parqueaderos as $parqueadero){
					                $parqueaderosArray[]=$parqueadero->getArrayCopy();
					            }

	    						$content=json_encode($parqueaderosArray);
	    						*/
	    						$content = $parqueaderos; 
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

		public function ticketsAction(){

			$content="";
	        if($this->getRequest()->isPOST()){

	        	$data = $this->request->getPost();

	        	if(!is_null($this->params('id'))){
	        		
	        		return $this->redirect()->toRoute('parametros',array('controller' => 'index','action' => 'index'));
	        	}else{
	        		
	        		//curl -X POST --data "par_id=Q004&aut_placa=PO0110&nro_ticket=2345656&hora_ini=07&minutos_ini=15&log_par_horas_parqueo=1" https://localhost/hawa/violations/public/api/vigilante/tickets
	        		if(isset($data['par_id'])){

	        			$par_id= $data['par_id'];

	        			if(strlen($par_id)<5){
			                $alfa=substr($par_id,0,1);
			                $num=substr($par_id,1,strlen($par_id));
			                $num=str_pad($num,4,0,STR_PAD_LEFT);
			                $par_id=$alfa.$num;
			            }else{
			                if(!is_numeric(substr($par_id,-1))){
			                    $alfa=substr($par_id,0,1);
			                    $num=substr($par_id,1,strlen($par_id));
			                    $num=str_pad($num,5,0,STR_PAD_LEFT);
			                    $par_id=$alfa.$num;
			                }
			            }
	        		}

	        		if(isset($data['aut_placa']))
	        			$aut_placa= strtoupper($data['aut_placa']);

	        		if(isset($data['nro_ticket'])){
	        			$nro_ticket= $data['nro_ticket'];
	        			if($this->getLogParqueaderoDao()->ticketUsado($nro_ticket)){
	        				$response=$this->getResponse();
				            $response->setStatusCode(403);
				            $response->setContent($content);
				            return $response;
	        			}else{
	        				$this->getParqueaderoDao()->liberarParqueaderosPorTicket($nro_ticket);
	        			}
					}


	        		if(isset($data['hora_ini']))
	        			$hora_ini= $data['hora_ini'];

	        		if(isset($data['minutos_ini']))
	        			$minutos_ini= $data['minutos_ini'];

	        		if(isset($data['log_par_horas_parqueo'])){
	        			$log_par_horas_parqueo = $data['log_par_horas_parqueo'];	      
	        		}	

	        		if(isset($data['log_par_discount']))
	        			$log_par_discount= $data['log_par_discount'];	    

	        		if($log_par_discount==1){
	        			$log_par_horas_parqueo=$log_par_horas_parqueo*2;
	        		}

					if(!$this->getAutomovilDao()->traer($aut_placa)){
						$automovil = new AutomovilEntity();
						$automovil->exchangeArray ( $data );
					  	$aut_placa = $this->getAutomovilDao()->guardar ( $automovil );
					}

					$fecha_ingreso = date('Y-m-d');
					$fecha_ingreso .= ' '. $hora_ini.':'.$minutos_ini.':00';

					$data['log_par_fecha_ingreso'] = $fecha_ingreso;
					$data['log_par_estado'] = 'O';
					$data['log_par_horas_parqueo'] = $log_par_horas_parqueo;
					$data['par_id'] = strtoupper($par_id);
					$data['tra_id'] = 0;

					$log_parqueadero = new LogParqueaderoEntity();
					$log_parqueadero->exchangeArray ( $data );
					$log_par_id = $this->getLogParqueaderoDao()->guardar ( $log_parqueadero );


					//	$responseArray=$cliente->getArrayCopy();
					//	$responseArray['tra_id'] = $tra_id;
					// $content=json_encode($responseArray);
	        	}
	        }else{
	        	$client = new SoapClient("http://sismertws.ibarra.gob.ec/wsgadi.php/notificaciones/getMultasByPlaca?wsdl", 
	        		array(	"soap_version" => SOAP_1_1, 
	        				'encoding'=>'utf-8', 
	        				'features' => SOAP_SINGLE_ELEMENT_ARRAYS)
	        		);
				$result1 = $client->getMultasByPlaca(array('numero_placa'=>'POL0110','usuario'=>'','password'=>''));
				print_r($result1);
				die();	        	
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

		            if(strlen($par_id)<5){
		                $alfa=substr($par_id,0,1);
		                $num=substr($par_id,1,strlen($par_id));
		                $num=str_pad($num,4,0,STR_PAD_LEFT);
		                $par_id=$alfa.$num;
		            }else{
		                if(!is_numeric(substr($par_id,-1))){
		                    $alfa=substr($par_id,0,1);
		                    $num=substr($par_id,1,strlen($par_id));
		                    $num=str_pad($num,5,0,STR_PAD_LEFT);
		                    $par_id=$alfa.$num;
		                }
		            }

					$aut_placa 		= strtoupper($data['aut_placa']);
					
					if(strlen($aut_placa)==6){
						if(is_numeric(substr($aut_placa,-1))){
							$alfa=substr($aut_placa,0,3);
							$num=substr($aut_placa,3,3);
							$aut_placa=$alfa.'0'.$num;
						}
					}


					$inf_latitud 	= floatval($data['inf_latitud']);
					$inf_longitud 	= floatval($data['inf_longitud']);
					$inf_fecha 		= $data['inf_fecha'];
					$tip_inf_id 	= $data['tip_inf_id'];
					$usu_id 		= $data['usu_id'];

					$lista_blanca_obj=$this->getListaBlancaDao()->enLista($aut_placa);
					if(!$lista_blanca_obj){

				    	$target_dir = "/var/www/html/Violations/files/";
						
						if(isset($_FILES["image"])){
							$name_file = time().'_'. basename($_FILES["image"]["name"]);
							$target_file = $target_dir .$name_file;
							move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
						}
						if(isset($_FILES["image2"])){
							$name_file2 = time().'_'. basename($_FILES["image2"]["name"]);
							$target_file2 = $target_dir .$name_file2;
							move_uploaded_file($_FILES["image2"]["tmp_name"], $target_file2);
						}
						if(isset($_FILES["image3"])){
							$name_file3 = time().'_'. basename($_FILES["image3"]["name"]);
							$target_file3 = $target_dir .$name_file3;
							move_uploaded_file($_FILES["image3"]["tmp_name"], $target_file3);
						}	

						$infraccion = new InfraccionEntity();

						$infraccionData=array();
						$infraccionData['inf_fecha']	=$inf_fecha;
						$infraccionData['inf_detalles']	="(Ningún)";
						$infraccionData['usu_id']		=$usu_id;
						$infraccionData['tip_inf_id']	=$tip_inf_id;
						$infraccionData['sec_id']		=7;	//Reemplazar
						$infraccionData['inf_latitud']	=$inf_latitud;
						$infraccionData['inf_longitud']	=$inf_longitud;
						$infraccionData['inf_estado']	='R';

						$infraccion->exchangeArray ( $infraccionData );
		                $inf_id=$this->getInfraccionDao()->guardar($infraccion);

			            $infraction_status="R";

						/* Busca infracciones en Sistema de Sismert, es decir las que no estén pagadas */
						$url = 'http://54.69.247.99/Violations/sismert/infracciones.php';
			            $params = array('placa' => $aut_placa );
			            
			            $url .= '?' . http_build_query($params);
			            $ch = curl_init();
			            curl_setopt($ch, CURLOPT_URL, $url);
			            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			            curl_setopt($ch, CURLOPT_HEADER, false);
			            $data = curl_exec($ch);
			            $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			            curl_close($ch);

			            $infracciones = json_decode($data);

			            if(sizeof($infracciones)>=3){
			            	$infraction_status="L"; //lock
			            }

						$multaParqueadero = new MultaParqueaderoEntity();
						$multaParqueaderoData=array();
						$multaParqueaderoData['par_id']			= $par_id;
						$multaParqueaderoData['aut_placa']		= $aut_placa;
						$multaParqueaderoData['inf_id']			= $inf_id;
						$multaParqueaderoData['mul_par_estado']	= $infraction_status; //Reemplazar
						$multaParqueaderoData['mul_par_valor']	= 0; //Reemplazar

						$multaParqueaderoData['mul_par_prueba_1']	= $name_file;
						$multaParqueaderoData['mul_par_prueba_2']	= $name_file2;
						$multaParqueaderoData['mul_par_prueba_3']	= $name_file3;

						$multaParqueadero->exchangeArray ( $multaParqueaderoData );
						$mul_par_id=$this->getMultaParqueaderoDao()->guardar($multaParqueadero);

						$multaResult=$multaParqueadero->getArrayCopy();
						$multaResult['total_multas']=sizeof($infracciones);

						$content=json_encode($multaResult);
					}else{
			            $response=$this->getResponse();
			            $response->setStatusCode(403);
			            $response->setContent($content);
			            return $response;
					}	
				}	
	        }else{
	        	//Funcionalidad sí es q es GET, es decir consulta de infracciones
	        	if(!is_null($this->params('id'))){
	        		$placa=$this->params('id');

					$client = new nusoap_client('http://sismertws.ibarra.gob.ec/wsgadi.php/notificaciones/getMultasByPlaca?wsdl', 'wsdl');
					$err = $client->getError();
					if ($err) {
						echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
					}

					$result = $client->call("getMultasByPlaca", array("numero_placa" => $placa, 
																				"usuario" => "ROMEROC",
																				"password" => "CRISTHIAN87"));



					print_r($result);

					die();
	        	}


	            //return $this->redirect()->toRoute('parametros',array('controller' => 'index','action' => 'index'));
	        }
            $response=$this->getResponse();
            $response->setStatusCode(200);
            $response->setContent($content);
            return $response;
	    }

	    public function infraccionAction()
	    {

	    	$content="";
	    	$status=404;
	    	if($this->getRequest()->isPOST()){

	    	}else{
	    		if(!is_null($this->params('id'))){
	        		$inf_id=$this->params('id');
	        		
	        		$infraccion = $this->getInfraccionDao()->traer($inf_id);
			        
			        if(is_object($infraccion)){
			            $multa  = $this->getMultaParqueaderoDao()->traerPorInfraccion($inf_id);
			            $parqueadero  = $this->getParqueaderoDao()->traer($multa->getPar_id());
			            $tipo   = $this->getTipoInfraccionDao()->traer($infraccion->getTip_inf_id());
			            $usuario   = $this->getUsuarioDao()->traer($infraccion->getUsu_id());

			            $data = array(	
			            	'inf_id'=>$inf_id,
			            	'inf_fecha'=>$infraccion->getInf_fecha(),
			            	'aut_placa'=>$multa->getAut_placa(),
			            	'parqueadero'=>$parqueadero->getPar_id(),
							'agente'=>$usuario->getUsu_nombre()." ".$usuario->getUsu_apellido(),
							'tip_inf_descripcion'=> $tipo->getTip_inf_descripcion(),
							'tip_inf_legal'=> $tipo->getTip_inf_legal(),
			            );

			            $content = json_encode($data);
			            $status=200;
	        		}
	    		}
	    	}

	    	$response=$this->getResponse();
            $response->setStatusCode($status);
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
	    public function getAutomovilDao(){
	    	if (! $this->automovilDao) {
	            $sm = $this->getServiceLocator ();
	            $this->automovilDao = $sm->get ( 'Application\Model\Dao\AutomovilDao' );
	        }
	        return $this->automovilDao;
	    }
	    public function getLogParqueaderoDao() {
	        if (! $this->logParqueaderoDao) {
	            $sm = $this->getServiceLocator ();
	            $this->logParqueaderoDao = $sm->get ( 'Application\Model\Dao\LogParqueaderoDao' );
	        }
	        return $this->logParqueaderoDao;
	    }
	   	public function getListaBlancaDao() {
	        if (! $this->listaBlancaDao) {
	            $sm = $this->getServiceLocator ();
	            $this->listaBlancaDao = $sm->get ( 'Application\Model\Dao\ListaBlancaDao' );
	        }
	        return $this->listaBlancaDao;
	    }

	}
