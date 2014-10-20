<?php

namespace Api\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Json\Json;

use Application\Model\Entity\LogParqueadero as LogParqueaderoEntity;
use Application\Model\Entity\Automovil as AutomovilEntity;
use Application\Model\Entity\Transaccion as TransaccionEntity;
use Application\Model\Entity\RelacionCliente as RelacionClienteEntity;
use Application\Model\Entity\TransferenciaSaldo as TransferenciaSaldoEntity;
use Application\Model\Entity\Cliente as ClienteEntity;

class ApiController extends AbstractActionController
{
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
                $content=json_encode(array());
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

                $est_id=1;

                $precioHora=0.8;
                $horas=$log_par_horas_parqueo;
                $total=$precioHora*$horas;

                $transaccionData['cli_id']=$cli_id;
                $transaccionData['est_id']=$est_id;
                $transaccionData['tra_valor']=$total;
                $transaccionData['tra_tipo']='DEBITO';
                $transaccionData['tra_hora'] = date('Y-m-d H:i:s');
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
                    $data['par_id'] = $par_id;
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

        if($this->getRequest()->isGET()){        
            $sec_id = $this->request->getQuery('sec_id');
            if($sec_id){
                $content='';
                $content = $this->getParqueaderoDao()->traerVaciosPorSectorJSON($sec_id);

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

            $cliente = new ClienteEntity();
            $data['cli_saldo']=0;
            $data['cli_estado']='ACTIVO';

            $cliente->exchangeArray ( $data );
            $content='';
            $response=$this->getResponse();
            if(!$this->getClienteDao()->verificar( $cliente )){
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

    public function recover_passwordAction()
    {
        echo 'here';
        /*if($this->getRequest()->isPOST()){

            $data = $this->request->getPost ();

            $cliente = new ClienteEntity();
            $data['cli_saldo']=0;
            $data['cli_estado']='ACTIVO';

            $cliente->exchangeArray ( $data );
            $content='';
            $response=$this->getResponse();
            if(!$this->getClienteDao()->verificar( $cliente )){
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
        }*/
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
}
