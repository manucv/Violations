<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
//use Zend\View\Model\ViewModel;
use Zend\Console\Request as ConsoleRequest;
use Application\Funciones\Ping as Ping;
use Application\Model\Entity\Componente;

class ConsoleController extends AbstractActionController {
	
	private $componenteDao;
	
	public function indexAction() {
		/* return $this->redirect ()->toRoute ( 'application', array (
				'controller' => 'index',
				'action' => 'resetpassword' 
		) ); */
	    
	    $request = $this->getRequest();
	    
	    // Make sure that we are running in a console and the user has not tricked our
	    // application into running this action from a public web server.
	    if (!$request instanceof ConsoleRequest){
	        throw new \RuntimeException('You can only use this action from a console!');
	    }
	    
	    // Get user email from console and check if the user used --verbose or -v flag
	    $userEmail   = $request->getParam('userEmail');
	    $verbose     = $request->getParam('verbose') || $request->getParam('v');
	    $userPassword = $request->getParam('userPassword');
	    
	    // Estructura de la carpeta deseada
	    $estructura = '/var/www/Violations/data/log/';
	    
	    // Para crear una estructura anidada se debe especificar
	    // el parámetro $recursive en mkdir().
	    
	    if(!file_exists($estructura)){
	     			if(!mkdir($estructura, 0777, true)) {
	     			    return "Fallo al crear las carpetas...'. \n";
	     			}
	    }
	    
	    if(strtolower($userEmail) == 'emanuelcarrasco@gmail.com' && $userPassword == 'root'){
	        if (!$verbose) {
	            return "Done! $userEmail has received an email with his new password.\n";
	    }else{
	    
	        date_default_timezone_set('America/Guayaquil');
	        $filename = 'log.txt';
	    
	        $contenido = "******************************************************** \n";
	        $contenido .= "-- INICIO PING -- Fecha: " . date('d-m-Y H:i:s') . " \n";
	        $contenido .= "******************************************************** \n";
	    
	        if(!file_exists($estructura . $filename)){
	            $file = $estructura . $filename;
	            $handle = fopen($file,"x+");
	            $somecontent = "-- First line of this file --";
	            fwrite($handle,$somecontent);
	            fclose($handle);
	        }
	    
	        // Primero vamos a asegurarnos de que el archivo existe y es escribible.
	        if (is_writable($estructura . '/'. $filename)) {
	    
	            // En nuestro ejemplo estamos abriendo el archivo en modo de adición.
	            // El puntero al archivo está al final del archivo
	            // donde irá $contenido cuando usemos fwrite() sobre él.
	            if (!$gestor = fopen($estructura . '/'.$filename, 'a')) {
	                return "No se puede abrir el archivo -- $filename -- .\n";
	        }
	    
	        // Escribir $contenido a nuestro archivo abierto.
	        if (fwrite($gestor, $contenido) === FALSE) {
	            return "No se puede escribir en el archivo -- $filename -- .\n";
	        }
	    
	        /*******************************************************************************
	         * ACTUALIZACION DE LOS REGISTROS DE LA BASE DE DATOS
	         * PING HACIA LAS IPS LOCALES QUE SE ENCUENTRAN REGISTRADAS EN LOS COMPONENTES
	         *******************************************************************************/
	         	
	        $componentes = $this->getComponenteDao()->traerTodos();
	        	
	        $host = '';
	        $ping = new Ping($host);
	        	
	        foreach ($componentes as $componente){
	        	
	        $data = array();
	    
	        $ipLocal = $componente->getCom_ip_local();
	        $idComponente = $componente->getCom_id();
	        	
	        $ping->setHost( $ipLocal );
	        $respuesta = $ping->ping('exec');
	        	
	        if(!$respuesta){
	        $data['com_ultimo_valor'] = 'false';
	        $data['com_estado'] = 'I';
	            $respuesta = 'false';
	            $estado = 'Inactivo';
	        }else{
	            $data['com_ultimo_valor'] = $respuesta;
	                $data['com_estado'] = 'A';
	                $estado = 'Activo';
	            }
	            	
						$data['com_id'] = $idComponente;
	    						    $data['com_ultima_respuesta'] = date('Y-m-d H:i:s');
	    						    	
	    						        $objetoComponente = new Componente();
	    						        $objetoComponente->exchangeArray($data);
	    						        	
	    						        $this->getComponenteDao()->guardar($objetoComponente);
	    
	    						        //GRABA EN EL ARCHIVO DE TEXTO LA INFORMACION DE PING DE CADA COMPONENTE DE LOS SITIOS
	    						        $contenidoBase = " ID: $idComponente -- IP: $ipLocal -- RESPUESTA: $respuesta -- Estado: $estado  \n";
	    						        fwrite($gestor, $contenidoBase);
	    						        	
					}
			
					$contenidoCierre = "******************************************************** \n";
	    					    $contenidoCierre .= "-- FIN PING -- Fecha: " . date('d-m-Y H:i:s') . " \n";
					$contenidoCierre .= "******************************************************** \n\n";
	    						        	
	    						        fwrite($gestor,$contenidoCierre);
			
					fclose($gestor);
	    						        	
	    						        return "Done! Valid login! Valid execution! \n";
	    						        	
	        } else {
	        return "El archivo -- $filename -- no tiene permisos de escritura .\n";
	    				}
	    			}
	    		}else{
	    			return "\n\n Login Failure. You can not execute the command line. \n";
	    		}
	}
	
	/* public function resetpasswordAction()
	{
		
		
	} */
	
	public function getComponenteDao() {
		if (! $this->componenteDao) {
			$sm = $this->getServiceLocator ();
			$this->componenteDao = $sm->get ( 'Application\Model\Dao\ComponenteDao' );
		}
		return $this->componenteDao;
	}
			
	//COMO EJECTUTAR DESDE LA LINEA DE COMANDO
	//*/1 * * * * /usr/bin/php /var/www/Violations/public/index.php user resetpassword -v emanuelcarrasco@gmail.com root
}