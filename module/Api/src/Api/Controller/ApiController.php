<?php

namespace Api\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Json\Json;

use Application\Model\Entity\LogParqueadero as LogParqueaderoEntity;
use Application\Model\Entity\Automovil as AutomovilEntity;

class ApiController extends AbstractActionController
{
    protected $clienteDao;
    protected $categoriaDao;
    protected $establecimientoDao;
    protected $logParqueaderoDao;
    protected $automovilDao;
    protected $paisDao;

    public function indexAction()
    {
        return new ViewModel();
    }

    public function loginAction()
    {
        if($this->getRequest()->isGET()){
            $email =  $this->getRequest()->getQuery('email');
            $passw =  $this->getRequest()->getQuery('passw');

            $cliente = $this->getClienteDao()->buscarPorEmail($email,$passw);
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

    public function paisesAction()
    {
        if($this->getRequest()->isGET()){

            $paises = $this->getPaisDao()->traerTodos();
            
            $paisesArray=array();
            foreach($paises as $pais){
                $paisesArray[]=$pais->getArrayCopy();
            }
            $content='';
            /*if(is_object($cliente)){
                $content=json_encode($cliente->getArrayCopy());
            }*/
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
            ) );
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


                $cliente = $this->getClienteDao()->debitar($cli_id,(1*$log_par_horas_parqueo));
                $content='';
                if(is_object($cliente)){

                    $data=array();
                    $data['aut_placa'] = $aut_placa;

                    $automovil = new AutomovilEntity();
                    $automovil->exchangeArray ( $data );
                    $aut_placa = $this->getAutomovilDao()->guardar ( $automovil );

                    $data['log_par_fecha_ingreso'] = date('Y-m-d H:i:s');
                    $data['log_par_estado'] = 'O';
                    $data['log_par_horas_parqueo'] = $log_par_horas_parqueo;
                    $data['par_id'] = $par_id;

                    $log_parqueadero = new LogParqueaderoEntity();
                    $log_parqueadero->exchangeArray ( $data );
                    $log_par_id = $this->getLogParqueaderoDao()->guardar ( $log_parqueadero );

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

    public function getPaisDao() {
        if (! $this->paisDao) {
            $sm = $this->getServiceLocator ();
            $this->paisDao = $sm->get ( 'Application\Model\Dao\PaisDao' );
        }
        return $this->paisDao;
    }


}

