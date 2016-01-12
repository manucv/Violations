<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonModule for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Parqueaderos\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Parqueaderos\Form\Sector;

use Application\Model\Entity\LogParqueadero as LogParqueaderoEntity;
use Application\Model\Entity\Automovil as AutomovilEntity;

class ParqueaderosController extends AbstractActionController
{
    protected $paisDao;
    protected $sectorDao;
    protected $parquederoDao;
    protected $logParqueaderoDao;
    protected $parquederoSectorDao;
    protected $automovilDao;

    public function indexAction()
    {
        $form = $this->getFormBusqueda ();
        echo '<pre>';
        print_r($this->getParqueaderoSectorDao ()->traerTodosArreglo ());
        echo '</pre>';

        $form->get('pai_id' )->setValueOptions ( $this->getPaisDao ()->traerTodosArreglo () );
        //$sectores=$this->getSectorDao ()->traerTodosJSON();
        $this->layout()->setVariable('menupadre', null)->setVariable('menuhijo', 'parqueaderodis');
        return array(
            'formulario' => $form,
            'navegacion' => array('datos' =>  array ( 'Inicio' => array('parametros','index','video'), 'Buscar parqueaderos disponibles' => array('parqueaderos','parqueaderos','index')) ),
        );//, 'sectores'=>$sectores);
    }

    public function ocupadosAction(){
        if($this->getRequest()->isXmlHttpRequest()){
            $sec_id =  $this->getRequest()->getPost('sec_id');
            $ocupados = $this->getParqueaderoDao()->traerOcupadosPorSectorJSON($sec_id);
            
            $response=$this->getResponse();
            $response->setStatusCode(200);
            $response->setContent($ocupados);
            return $response;
        }else{
            return $this->redirect()->toRoute('parqueaderos',array('parqueaderos'=>'index'));
        }
    }

    public function multadosAction(){
        if($this->getRequest()->isXmlHttpRequest()){
            $sec_id =  $this->getRequest()->getPost('sec_id');
            $ocupados = $this->getParqueaderoDao()->traerMultadosPorSectorJSON($sec_id);
            
            $response=$this->getResponse();
            $response->setStatusCode(200);
            $response->setContent($ocupados);
            return $response;
        }else{
            return $this->redirect()->toRoute('parqueaderos',array('parqueaderos'=>'index'));
        }
    }    

    public function sectoresAction(){
        if($this->getRequest()->isXmlHttpRequest()){
            $pai_id =  $this->getRequest()->getPost('pai_id');
            $est_id =  $this->getRequest()->getPost('est_id');
            $ciu_id =  $this->getRequest()->getPost('ciu_id');
            $sectores=$this->getSectorDao ()->traerTodosJSON($pai_id, $est_id, $ciu_id);

            $response=$this->getResponse();
            $response->setStatusCode(200);
            $response->setContent($sectores);
            return $response;
        }else{



            return $this->redirect()->toRoute('parqueaderos',array('parqueaderos'=>'index'));
        }
    }    

    public function agregarAction(){
        //VERIFICA QUE SE HAYA REALIZADO UN POST DE INFORMACION
        if (! $this->request->isPost ()) {
            return $this->redirect ()->toRoute ( 'parqueaderos', array (
                    'controller' => 'parqueaderos',
                    'action' => 'index'
            ) );
        }
         
        //CAPTURA LA INFORMACION ENVIADA EN EL POST
        $data = $this->request->getPost ();

        $data->log_par_fecha_ingreso = date('Y-m-d H:i:s');
        $data->log_par_estado = 'O';
        $data->log_par_horas_parqueo = rand(1,2);

        $data->aut_placa = 'P';
        $a_z = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $int = rand(0,25);
        $data->aut_placa .= $a_z[$int];
        $int = rand(0,25);
        $data->aut_placa .= $a_z[$int];
        $data->aut_placa .= str_pad(rand(0,999), 3, "0", STR_PAD_LEFT);

        $automovil = new AutomovilEntity();
        $automovil->exchangeArray ( $data );
        $aut_placa = $this->getAutomovilDao()->guardar ( $automovil );


        $vaciosObj = $this->getParqueaderoDao()->traerVaciosPorSector($data->sec_id);
        $vacios = array(); 
        foreach($vaciosObj as $vacioObj){
            $vacios[] = $vacioObj->getPar_id();
        }

        $total_vacios = sizeof($vacios);
        $vacio = $vacios[rand(0,$total_vacios-1)];
        $data->par_id = $vacio;

        $log_parqueadero = new LogParqueaderoEntity();
        $log_parqueadero->exchangeArray ( $data );
        $log_par_id = $this->getLogParqueaderoDao()->guardar ( $log_parqueadero );

        return $this->redirect ()->toRoute ( 'parqueaderos', array (
                'controller' => 'sector',
                'action' => 'index',
                'id' => $data->sec_id
        )); 

    }

    /* GET DAO's */
    public function getPaisDao() {
        if (! $this->paisDao) {
            $sm = $this->getServiceLocator ();
            $this->paisDao = $sm->get ( 'Application\Model\Dao\PaisDao' );
        }
        return $this->paisDao;
    }
    public function getSectorDao() {
        if (! $this->sectorDao) {
            $sm = $this->getServiceLocator ();
            $this->sectorDao = $sm->get ( 'Application\Model\Dao\SectorDao' );
        }
        return $this->sectorDao;
    }
    public function getParqueaderoDao() {
        if (! $this->parquederoDao) {
            $sm = $this->getServiceLocator ();
            $this->parquederoDao = $sm->get ( 'Application\Model\Dao\ParqueaderoDao' );
        }
        return $this->parquederoDao;
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

    public function getParqueaderoSectorDao() {
        if (! $this->parquederoSectorDao) {
            $sm = $this->getServiceLocator ();
            $this->parquederoSectorDao = $sm->get ( 'Application\Model\Dao\ParqueaderoSectorDao' );
        }
        return $this->parquederoSectorDao;
    }

    public function getFormBusqueda() {
        $form = new Sector();
        return $form;
    }
}
