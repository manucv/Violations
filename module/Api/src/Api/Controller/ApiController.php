<?php

namespace Api\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Zend\Mail;
use Zend\Mime\Message as MimeMessage;
use Zend\Mime\Part as MimePart;
use Zend\Mail\Transport\Smtp as SmtpTransport;
use Zend\Mail\Transport\SmtpOptions;

use Zend\Json\Json;

use Aws\Ses\SesClient;

use Application\Model\Entity\LogParqueadero as LogParqueaderoEntity;
use Application\Model\Entity\Automovil as AutomovilEntity;
use Application\Model\Entity\Transaccion as TransaccionEntity;
use Application\Model\Entity\RelacionCliente as RelacionClienteEntity;
use Application\Model\Entity\TransferenciaSaldo as TransferenciaSaldoEntity;
use Application\Model\Entity\Cliente as ClienteEntity;
use Application\Model\Entity\Usuario as UsuarioEntity;
use Application\Model\Entity\Publicidad as PublicidadEntity;
use Application\Model\Entity\PuntoRecarga as PuntoRecargaEntity;
use Application\Model\Entity\CompraSaldo as CompraSaldoEntity;

class ApiController extends AbstractActionController
{
    
    protected $usuarioDao;
    protected $clienteDao;
    protected $categoriaDao;
    protected $establecimientoDao;
    protected $logParqueaderoDao;
    protected $automovilDao;
    protected $paisDao;
    protected $estadoDao;
    protected $ciudadDao;
    protected $sectorDao;
    protected $parqueaderoDao;
    protected $transaccionDao;
    protected $relacionClienteDao;
    protected $transferenciaSaldoDao;
    protected $publicidadDao;
    protected $compraSaldoDao;

    protected $puntoRecargaDao;

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
                $content=json_encode((object) null);
            }   

            $response=$this->getResponse();
            $response->setStatusCode(200);
            $response->setContent($content);
            return $response;
        }else{
			return $this->redirect ()->toRoute ( 'parametros', array (
					'controller' => 'index',
					'action' => 'index'
			) );
        }
    }

    public function categoriasAction()
    {
        if($this->getRequest()->isGET()){
            if(is_null($this->params('id'))){
                $categorias = $this->getCategoriaDao()->traerTodos();
                $content='';
                $categoriasArray=array();
                foreach($categorias as $categoria){
                    $categoriasArray[]=$categoria->getArrayCopy();
                }
                $content=json_encode($categoriasArray);
                
                $response=$this->getResponse();
                $response->setStatusCode(200);
                $response->setContent($content);
                return $response;                
            }else{
                $cat_id=$this->params('id');
                $establecimientos = $this->getEstablecimientoDao()->traerPorCategoria($cat_id);
                $content='';
                $establecimientosArray=array();
                foreach($establecimientos as $establecimiento){
                    $establecimientosArray[]=$establecimiento->getArrayCopy();
                }
                $content=json_encode($establecimientosArray);   
                
                $response=$this->getResponse();
                $response->setStatusCode(200);
                $response->setContent($content);
                return $response;                                
            }

        }else{
            return $this->redirect ()->toRoute ( 'parametros', array (
                    'controller' => 'index',
                    'action' => 'index'
            ) );
        }
    }    



    public function establecimientosAction()
    {
        if($this->getRequest()->isGET()){
            if(is_null($this->params('id'))){
                $response=$this->getResponse();
                $response->setStatusCode(200);
                $response->setContent('');
                return $response;                
            }else{
                $est_id=$this->params('id');
                $establecimiento = $this->getEstablecimientoDao()->traer($est_id);
                $content='';
                
                $content=json_encode($establecimiento->getArrayCopy());
                
                $response=$this->getResponse();
                $response->setStatusCode(200);
                $response->setContent($content);
                return $response;                                
            }

        }else{
            return $this->redirect ()->toRoute ( 'parametros', array (
                    'controller' => 'index',
                    'action' => 'index'
            ));
        }
    }    

    public function comprarAction()
    {
        if($this->getRequest()->isGET()){
            if(!is_null($this->params('id'))){
                $cli_id=$this->params('id');
                $par_id =  $this->getRequest()->getQuery('par_id');
                $aut_placa =  $this->getRequest()->getQuery('aut_placa');
                $log_par_horas_parqueo =  $this->getRequest()->getQuery('log_par_horas_parqueo');

                $eta_id=1;

                $info_par=$this->getParqueaderoDao()->traerJerarquia($par_id);
                $sec_valor_hora=$info_par['sec_valor_hora'];
                
                $horas=$log_par_horas_parqueo;
                $total=$sec_valor_hora*$horas;

                $transaccionData['cli_id']=$cli_id;
                $transaccionData['eta_id']=$eta_id;
                $transaccionData['tra_valor']=$total;
                $transaccionData['tra_fecha'] = date('Y-m-d H:i:s');
                $transaccionData['tra_saldo'] = 0;

                $transaccion = new TransaccionEntity();
                $transaccion->exchangeArray ( $transaccionData );
                $tra_id=$this->getTransaccionDao()->guardar($transaccion);

                $cliente = $this->getClienteDao()->debitar($cli_id,$total);
                $content='';

                if(is_object($cliente)){

                    $data=array();
                    $data['aut_placa'] = $aut_placa;

                    if(!$this->getAutomovilDao()->traer($aut_placa)){
                        $automovil = new AutomovilEntity();
                        $automovil->exchangeArray ( $data );
                        $aut_placa = $this->getAutomovilDao()->guardar ( $automovil );
                    }

                    $data['log_par_fecha_ingreso'] = date('Y-m-d H:i:s');
                    $data['log_par_estado'] = 'O';
                    $data['log_par_horas_parqueo'] = $log_par_horas_parqueo;
                    $data['par_id'] = strtoupper($par_id);
                    $data['tra_id'] = $tra_id;

                    $log_parqueadero = new LogParqueaderoEntity();
                    $log_parqueadero->exchangeArray ( $data );
                    $log_par_id = $this->getLogParqueaderoDao()->guardar ( $log_parqueadero );

                    $responseArray=$cliente->getArrayCopy();
                    $responseArray['tra_id'] = $tra_id;

                    $content=json_encode($responseArray);

                }

                $response=$this->getResponse();
                $response->setStatusCode(200);
                $response->setContent($content);
                return $response;
            }else{

                $par_id =  $this->getRequest()->getQuery('par_id');
                $aut_placa =  $this->getRequest()->getQuery('aut_placa');
                $log_par_horas_parqueo =  $this->getRequest()->getQuery('log_par_horas_parqueo');

                $est_id=1;

                $info_par=$this->getParqueaderoDao()->traerJerarquia($par_id);
                $sec_valor_hora=$info_par['sec_valor_hora'];
                
                $horas=$log_par_horas_parqueo;
                $total=$sec_valor_hora*$horas;

                $data=array();
                $data['aut_placa'] = $aut_placa;

                if(!$this->getAutomovilDao()->traer($aut_placa)){
                    $automovil = new AutomovilEntity();
                    $automovil->exchangeArray ( $data );
                    $aut_placa = $this->getAutomovilDao()->guardar ( $automovil );
                }

                $data['log_par_fecha_ingreso'] = date('Y-m-d H:i:s');
                $data['log_par_estado'] = 'O';
                $data['log_par_horas_parqueo'] = $log_par_horas_parqueo;
                $data['par_id'] = strtoupper($par_id);
                $data['tra_id'] = 0;

                $log_parqueadero = new LogParqueaderoEntity();
                $log_parqueadero->exchangeArray ( $data );
                $log_par_id = $this->getLogParqueaderoDao()->guardar( $log_parqueadero );

                $content=json_encode(true);

                $response=$this->getResponse();
                $response->setStatusCode(200);
                $response->setContent($content);
                return $response;

            }
        }else{
            return $this->redirect ()->toRoute ( 'parametros', array (
                    'controller' => 'index',
                    'action' => 'index'
            ) );
        }
    }    

    public function paisesAction()
    {
        if($this->getRequest()->isGET()){

            $paises = $this->getPaisDao()->traerTodos();
            $content='';
            $paisesArray=array();
            foreach($paises as $pais){
                $paisesArray[]=$pais->getArrayCopy();
            }
            
            $content=json_encode($paisesArray);
            
            $response=$this->getResponse();
            $response->setStatusCode(200);
            $response->setContent($content);
            return $response;
        }else{
            return $this->redirect ()->toRoute ( 'parametros', array (
                    'controller' => 'index',
                    'action' => 'index'
            ) );
        }
    }    

    public function estadosAction(){

        if($this->getRequest()->isGET()){        
            $pai_id = $this->request->getQuery('pai_id');
            if($pai_id){
                $estados = $this->getEstadoDao()->traerTodos($pai_id);

                $content='';
                $estadosArray=array();
                foreach($estados as $estado){
                    $estadosArray[]=$estado->getArrayCopy();
                }
                
                $content=json_encode($estadosArray);

                $response = $this->getResponse();
                $response->setStatusCode(200);
                $response->setContent($content);
                    
                return $response;    
            }else{
                return $this->redirect()->toRoute('parametros', array('sector' => 'ingresar'));
            }
        }else{
            return $this->redirect()->toRoute('parametros', array('sector' => 'ingresar'));
        }
    }
    
    public function ciudadesAction(){

        if($this->getRequest()->isGET()){        
            $est_id = $this->request->getQuery('est_id');
            if($est_id){
                $ciudades = $this->getCiudadDao()->traerTodos($est_id);

                $content='';
                $ciudadesArray=array();
                foreach($ciudades as $ciudad){
                    $ciudadesArray[]=$ciudad->getArrayCopy();
                }
                
                $content=json_encode($ciudadesArray);

                $response = $this->getResponse();
                $response->setStatusCode(200);
                $response->setContent($content);
                    
                return $response;    
            }else{
                return $this->redirect()->toRoute('parametros', array('sector' => 'ingresar'));
            }
        }else{
            return $this->redirect()->toRoute('parametros', array('sector' => 'ingresar'));
        }
    }

    public function sectoresAction(){
        if($this->getRequest()->isGET()){        
            $ciu_id = $this->request->getQuery('ciu_id');
            if($ciu_id){
                $sectores = $this->getSectorDao()->traerTodos($ciu_id);
                
                $content='';
                $sectoresArray=array();
                foreach($sectores as $sector){
                    $sectoresArray[]=$sector->getArrayCopy();
                }
                
                $content=json_encode($sectoresArray);

                $response = $this->getResponse();
                $response->setStatusCode(200);
                $response->setContent($content);
                    
                return $response;    
            }else{
                $content = $this->getSectorDao()->traerTodosJSON();

                $response = $this->getResponse();
                $response->setStatusCode(200);
                $response->setContent($content);
                    
                return $response;  
            }
        }else{
            return $this->redirect()->toRoute('parametros', array('sector' => 'ingresar'));
        }    
    }

    public function parqueaderosAction(){

        if(is_null($this->params('id'))){
            if($this->getRequest()->isGET()){

                $content='';
                $content = $this->getParqueaderoDao()->traerVaciosJSON();

                $response = $this->getResponse();
                $response->setStatusCode(200);
                $response->setContent($content);
                    
                return $response;

            }else{
                return $this->redirect()->toRoute('parametros', array('sector' => 'ingresar'));
            }
        }else{
            $par_id=$this->params('id');

            $parqueaderos = $this->getParqueaderoDao()->traerJerarquia($par_id);

            if($parqueaderos){
                $content=json_encode($parqueaderos);            
                $response = $this->getResponse();
                $response->setStatusCode(200);
                $response->setContent($content);
                return $response;
            }else{
                $response = $this->getResponse();
                $response->setStatusCode(404);
                $response->setContent("");
                return $response;
            }
        }    
    }    

    public function historialAction()
    {
        if($this->getRequest()->isGET()){
            if(!is_null($this->params('id'))){
                $cli_id=$this->params('id');

                $transacciones = $this->getTransaccionDao()->traerPorClienteJSON($cli_id);
                
                $response=$this->getResponse();
                $response->setStatusCode(200);
                $response->setContent($transacciones);
                return $response;
            }

        }else{
            return $this->redirect ()->toRoute ( 'parametros', array (
                    'controller' => 'index',
                    'action' => 'index'
            ) );
        }
    }    

    public function relacionAction()
    {
        if($this->getRequest()->isGET()){
            if(!is_null($this->params('id'))){
                $cli_id=$this->params('id');
                $email = $this->request->getQuery('cli_email');

                $referido = $this->getClienteDao()->buscarPorEmailOUsuario($email);
                $content='';

                if(is_object($referido)){
                    
                    if($cli_id != $referido->getCli_id()){
                        $relacion=array();
                        $relacion['cli_id']=$cli_id;
                        $relacion['cli_id_relacionado']=$referido->getCli_id();
                        $relacion['rel_cli_tipo']='REFERIDO';
                        $relacion['rel_cli_hora']=date('Y-m-d H:i:s');

                        $relacionCliente = new RelacionClienteEntity();
                        $relacionCliente->exchangeArray ( $relacion );
                        $re_cli_id=$this->getRelacionClienteDao()->guardar($relacionCliente);

                        /* Retorna referidos en caso de que la inserción sea exitosa */

                        $referidos = $this->getRelacionClienteDao()->traerTodosPorCliente($cli_id);

                        $content='';
                        $referidosArray=array();
                        foreach($referidos as $referido){
                            $referidosArray[]=$referido->getArrayCopy();
                        }
                        $content=json_encode($referidosArray);
                        
                        $response=$this->getResponse();
                        $response->setStatusCode(200);
                        $response->setContent($content);
                        
                        return $response;   
                        /* Fin Referidos */
                    } else {
                        $content=''; //El usuario ya existe
                    }
                }else{
                    $content=json_encode(array());
                }
                $response=$this->getResponse();
                $response->setStatusCode(200);
                $response->setContent($content);
                return $response;
            }
        }else{
            return $this->redirect () ->toRoute ( 'parametros', array (
                    'controller' => 'index',
                    'action' => 'index'
            ));
        }
    } 

    public function relacionadosAction(){
        if($this->getRequest()->isGET()){
            if(!is_null($this->params('id'))){
                $cli_id=$this->params('id');
                $cli_id_to = $this->request->getQuery('cli_email');

                $referidos = $this->getRelacionClienteDao()->traerTodosPorCliente($cli_id);

                $content='';
                $referidosArray=array();
                foreach($referidos as $referido){
                    $referidosArray[]=$referido->getArrayCopy();
                }
                $content=json_encode($referidosArray);
                
                $response=$this->getResponse();
                $response->setStatusCode(200);
                $response->setContent($content);
                
                return $response;   
            }
        }else{
            return $this->redirect () ->toRoute ( 'parametros', array (
                    'controller' => 'index',
                    'action' => 'index'
            ));
        }
    }


    public function transferirAction()
    {
        if($this->getRequest()->isGET()){
            if(!is_null($this->params('id'))){
                $cli_id_de=$this->params('id');
                $cli_id_para = $this->getRequest()->getQuery('cli_id_para');
                $tra_sal_valor = $this->getRequest()->getQuery('tra_sal_valor');

                $transferenciaData['cli_id_de'] = $cli_id_de;
                $transferenciaData['cli_id_para'] = $cli_id_para;
                $transferenciaData['tra_sal_valor'] = $tra_sal_valor;
                $transferenciaData['tra_sal_hora'] = date('Y-m-d H:i:s');

                $transferencia = new TransferenciaSaldoEntity();
                $transferencia->exchangeArray ( $transferenciaData );
                $tra_id=$this->getTransferenciaSaldoDao()->guardar($transferencia);

                $cliente = $this->getClienteDao()->acreditar($cli_id_para,$tra_sal_valor);
                $cliente = $this->getClienteDao()->debitar($cli_id_de,$tra_sal_valor);
                $content='';

                if(is_object($cliente)){

                    $content=json_encode($cliente->getArrayCopy());

                }

                $response=$this->getResponse();
                $response->setStatusCode(200);
                $response->setContent($content);
                return $response;
            }else{
                return $this->redirect ()->toRoute ( 'parametros', array (
                    'controller' => 'index',
                    'action' => 'index'
                ));
            }
        }else{
            return $this->redirect ()->toRoute ( 'parametros', array (
                    'controller' => 'index',
                    'action' => 'index'
            ) );
        }
    }    

    public function estadoAction()
    {
        if($this->getRequest()->isGET()){
            if(!is_null($this->params('id'))){
                $content='';
                $tra_id=$this->params('id');

                $log_parqueadero=$this->getLogParqueaderoDao()->traerPorTransaccion($tra_id);
                
                $content=json_encode($log_parqueadero->getArrayCopy());

                $response=$this->getResponse();
                $response->setStatusCode(200);
                $response->setContent($content);
                return $response;
            }else{
                return $this->redirect ()->toRoute ( 'parametros', array (
                    'controller' => 'index',
                    'action' => 'index'
                ));
            }
        }else{
            return $this->redirect ()->toRoute ( 'parametros', array (
                    'controller' => 'index',
                    'action' => 'index'
            ) );
        }
    }    

    public function transferenciasAction()
    {
        if($this->getRequest()->isGET()){
            if(!is_null($this->params('id'))){
                $tipo = $this->request->getQuery('tipo');

                $cli_id=$this->params('id');

                $transferencias = $this->getTransferenciaSaldoDao()->traerPorClienteJSON($cli_id,$tipo);
                
                $response=$this->getResponse();
                $response->setStatusCode(200);
                $response->setContent($transferencias);
                return $response;
            }

        }else{
            return $this->redirect ()->toRoute ( 'parametros', array (
                    'controller' => 'index',
                    'action' => 'index'
            ) );
        }
    }    

    public function clientesAction()
    {
        if($this->getRequest()->isPOST()){
            $data = $this->request->getPost ();
            $content='';
            $response=$this->getResponse();
            if(!$this->getClienteDao()->verificar( $data )){ //envío los datos del usuario
                $usuario = new UsuarioEntity();
                
                $data['usu_estado']='A'; 
                $data['usu_fecha_registro']='0000-00-00 00:00:00'; 
                $usuario->exchangeArray ( $data );  

                $usu_id=$this->getUsuarioDao() ->guardar ( $usuario );

                $data_cliente = array();
                $cliente = new ClienteEntity();

                $data_cliente['usu_id']=$usu_id;
                $data_cliente['cli_saldo']=0;
                $data_cliente['cli_estado']='ACTIVO';
                $data_cliente['cli_movil']=$data['cli_movil'];

                $cliente->exchangeArray ( $data_cliente );
                $cli_id=$this->getClienteDao() ->guardar ( $cliente );
                $clienteObj = $this->getClienteDao()->traer ( $cli_id );
                $content=json_encode($clienteObj->getArrayCopy());
                $response->setStatusCode(200);
            }else {
                $response->setStatusCode(409);
            }    
            $response->setContent($content);

            return $response;

        }else{
            return $this->redirect ()->toRoute ( 'parametros', array (
                    'controller' => 'index',
                    'action' => 'index'
            ) );
        }
    } 

    public function recoverAction()
    {
        if($this->getRequest()->isPOST()){
            $data = $this->request->getPost();
            $email=$data['email'];
            $cliente = $this->getClienteDao()->buscarPorEmailOUsuario($email);
            $usu_id=$cliente->getUsu_id();
            $usuario=$this->getUsuarioDao()->traer($usu_id);

            $codigo_generado=$this->passwordGenerator(32);

            $usuario->setUsu_codigo_recuperacion($codigo_generado);
            
            $usu_id=$this->getUsuarioDao()->guardar ( $usuario );

            $uri = $this->getRequest()->getUri();
            $scheme = $uri->getScheme();
            $host = $uri->getHost();
            $base = sprintf('%s://%s', $scheme, $host);
            $basePath = $base .$this->getRequest()->getBasePath();
            
            $client = SesClient::factory(array(
                'profile' => 'default',
                'region'  => 'us-east-1',
                'credentials' => array(
                   'key'    => 'AKIAJINCCIX35LEXM2BA',
                   'secret' => '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',
                )    
            ));

            $result = $client->sendEmail(array(
                // Source is required
                'Source' => 'informacion@sip.ec',
                // Destination is required
                'Destination' => array(
                    'ToAddresses' => array('lmponceb@gmail.com')
                ),
                // Message is required
                'Message' => array(
                    // Subject is required
                    'Subject' => array(
                        // Data is required
                        'Data' => 'Recupera tu contrasena',
                    ),
                    // Body is required
                    'Body' => array(
                        'Text' => array(
                            // Data is required
                            'Data' => 'Accede al siguiente link para iniciar el proceso de recuperación de contraseña',
                        ),
                        'Html' => array(
                            // Data is required
                            'Data' => "<a href='http://ibarra.sip.ec/Violations/public/api/api/recover/$codigo_generado'>Recuperar Contraseña</a>",
                        ),
                    ),
                )
            ));

            //echo $this->passwordGenerator();
            die();
        } 
    }      

    private function passwordGenerator($length=10){
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        return substr(str_shuffle($chars),0,$length);
    }


    public function publicidadAction()
    {
        if($this->getRequest()->isGET()){

            $anuncio = $this->getPublicidadDao()->traerRnd();

            $content='';

            $content=json_encode($anuncio);
            
            $response=$this->getResponse();
            $response->setStatusCode(200);
            $response->setContent($content);
            return $response;
        }else{
            return $this->redirect ()->toRoute ( 'parametros', array (
                    'controller' => 'index',
                    'action' => 'index'
            ) );
        }
    }  

    public function activosAction()
    {
        if($this->getRequest()->isGET()){
            if(!is_null($this->params('id'))){
                $cli_id=$this->params('id');

                $transacciones = $this->getTransaccionDao()->traerActivosPorClienteJSON($cli_id);
                
                $response=$this->getResponse();
                $response->setStatusCode(200);
                $response->setContent($transacciones);
                return $response;
            }

        }else{
            return $this->redirect ()->toRoute ( 'parametros', array (
                    'controller' => 'index',
                    'action' => 'index'
            ) );
        }
    }        
    
    //Verificación de contraseña
    public function verificarAction(){

        if($this->getRequest()->isPOST()){
            $data = $this->request->getPost ();

            $id =  $data['id'];         //id_usuario
            $passw =  $data['passw'];   //password

            /*          
            $usuario = $this->getUsuarioDao()->traerPorUsuarioClave($email,$passw);
            $content='';
            if(is_object($usuario)){
                // Validamos que el usuario que trata de logearse tiene por rol el #4 = Vigilante 
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
            */

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


    public function recargasAction(){
        if($this->getRequest()->isGET()){  
            if(!is_null($this->params('id'))){

                $cli_id=$this->params('id');

                $transacciones = $this->getCompraSaldoDao()->traerRecargasPorUsuarioJSON($cli_id);
                $response=$this->getResponse();
                $response->setStatusCode(200);
                $response->setContent($transacciones);
                return $response;
            } else {

                $puntos_recarga = $this->getPuntoRecargaDao()->traerTodos();
                
                $content='';
                $puntosArray=array();
                foreach($puntos_recarga as $punto_recarga){
                    $puntosArray[]=$punto_recarga->getArrayCopy();
                }
                
                $content=json_encode($puntosArray);

                $response = $this->getResponse();
                $response->setStatusCode(200);
                $response->setContent($content);
                    
                return $response; 
            }
        }else{
            return $this->redirect()->toRoute('parametros', array('sector' => 'ingresar'));
        }    
    }    

    public function getUsuarioDao() {
        if (! $this->usuarioDao) {
            $sm = $this->getServiceLocator ();
            $this->usuarioDao = $sm->get ( 'Application\Model\Dao\UsuarioDao' );
        }
        return $this->usuarioDao;
    }    

    public function getClienteDao() {
        if (! $this->clienteDao) {
            $sm = $this->getServiceLocator ();
            $this->clienteDao = $sm->get ( 'Application\Model\Dao\ClienteDao' );
        }
        return $this->clienteDao;
    }    

    public function getCategoriaDao() {
        if (! $this->categoriaDao) {
            $sm = $this->getServiceLocator ();
            $this->categoriaDao = $sm->get ( 'Application\Model\Dao\CategoriaDao' );
        }
        return $this->categoriaDao;
    }    

    public function getEstablecimientoDao() {
        if (! $this->establecimientoDao) {
            $sm = $this->getServiceLocator ();
            $this->establecimientoDao = $sm->get ( 'Application\Model\Dao\EstablecimientoDao' );
        }
        return $this->establecimientoDao;
    }        

    public function getLogParqueaderoDao() {
        if (! $this->logParqueaderoDao) {
            $sm = $this->getServiceLocator ();
            $this->logParqueaderoDao = $sm->get ( 'Application\Model\Dao\LogParqueaderoDao' );
        }
        return $this->logParqueaderoDao;
    }

    public function getAutomovilDao() {
        if (! $this->automovilDao) {
            $sm = $this->getServiceLocator ();
            $this->automovilDao = $sm->get ( 'Application\Model\Dao\AutomovilDao' );
        }
        return $this->automovilDao;
    }

    public function getCiudadDao() {
        if (! $this->ciudadDao) {
            $sm = $this->getServiceLocator ();
            $this->ciudadDao = $sm->get ( 'Application\Model\Dao\CiudadDao' );
        }
        return $this->ciudadDao;
    }
    
    public function getPaisDao() {
        if (! $this->paisDao) {
            $sm = $this->getServiceLocator ();
            $this->paisDao = $sm->get ( 'Application\Model\Dao\PaisDao' );
        }
        return $this->paisDao;
    }
    
    public function getEstadoDao() {
        if (! $this->estadoDao) {
            $sm = $this->getServiceLocator ();
            $this->estadoDao = $sm->get ( 'Application\Model\Dao\EstadoDao' );
        }
        return $this->estadoDao;
    }

    public function getSectorDao() {
        if (! $this->sectorDao) {
            $sm = $this->getServiceLocator ();
            $this->sectorDao = $sm->get ( 'Application\Model\Dao\SectorDao' );
        }
        return $this->sectorDao;
    }

    public function getParqueaderoDao() {
        if (! $this->parqueaderoDao) {
            $sm = $this->getServiceLocator ();
            $this->parqueaderoDao = $sm->get ( 'Application\Model\Dao\ParqueaderoDao' );
        }
        return $this->parqueaderoDao;
    }

    public function getTransaccionDao() {
        if (! $this->transaccionDao) {
            $sm = $this->getServiceLocator ();
            $this->transaccionDao = $sm->get ( 'Application\Model\Dao\TransaccionDao' );
        }
        return $this->transaccionDao;
    }

    public function getRelacionClienteDao() {
        if (! $this->relacionClienteDao) {
            $sm = $this->getServiceLocator ();
            $this->relacionClienteDao = $sm->get ( 'Application\Model\Dao\RelacionClienteDao' );
        }
        return $this->relacionClienteDao;
    }    
    
    public function getTransferenciaSaldoDao() {
        if (! $this->transferenciaSaldoDao) {
            $sm = $this->getServiceLocator ();
            $this->transferenciaSaldoDao = $sm->get ( 'Application\Model\Dao\TransferenciaSaldoDao' );
        }
        return $this->transferenciaSaldoDao;
    }
                    
    public function getPublicidadDao() {
        if (! $this->publicidadDao) {
            $sm = $this->getServiceLocator ();
            $this->publicidadDao = $sm->get ( 'Application\Model\Dao\PublicidadDao' );
        }
        return $this->publicidadDao;
    }        

    public function getPuntoRecargaDao() {
        if (! $this->puntoRecargaDao) {
            $sm = $this->getServiceLocator ();
            $this->puntoRecargaDao = $sm->get ( 'Application\Model\Dao\PuntoRecargaDao' );
        }
        return $this->puntoRecargaDao;
    }
    
    public function getCompraSaldoDao() {
        if (! $this->compraSaldoDao) {
            $sm = $this->getServiceLocator ();
            $this->compraSaldoDao = $sm->get ( 'Application\Model\Dao\CompraSaldoDao' );
        }
        return $this->compraSaldoDao;
    }

}

