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
use Zend\View\Model\ViewModel;
use Parqueaderos\Form\Sector;
use Parqueaderos\Form\SectorValidator;
use Application\Model\Entity\Sector as SectorEntity;
use Application\Model\Entity\Infraccion as InfraccionEntity;
use Application\Model\Entity\MultaParqueadero as MultaParqueaderoEntity;

class SectorController extends AbstractActionController
{

    protected $sectorDao;
    protected $parqueaderoDao;
    protected $multaParqueaderoDao;
    protected $infraccionDao;

    public function indexAction(){

        $id = ( int ) $this->params()->fromRoute ( 'id', 0 );
        $form = $this->getForm ();
        $sector = $this->getSectorDao()->traer ( $id );
        $parqueaderos = $this->getParqueaderoDao()->traerTodosPorSector($id);

        $this->layout()->setVariable('menupadre', null)->setVariable('menuhijo', 'parqueaderodis');
        return new ViewModel ( array (
            'parqueaderos'  =>  $parqueaderos,
            'sector'        =>  $sector,
            'navegacion' => array('datos' =>  array ( 'Inicio' => array('parametros','index','video'), 'Buscar parqueaderos disponibles' => array('parqueaderos','parqueaderos','index'), 'Disponibilidad de parqueadero' => array('parqueaderos','sector','index', $id)) ),
        ) );
    }

    public function reportarAction(){
        //VERIFICA QUE SE HAYA REALIZADO UN POST DE INFORMACION
        if (! $this->request->isPost ()) {
            return $this->redirect ()->toRoute ( 'parqueaderos', array (
                    'controller' => 'parqueaderos',
                    'action' => 'index'
            ) );
        }
         
        //CAPTURA LA INFORMACION ENVIADA EN EL POST
        $data = $this->request->getPost ();
        $data->usu_id = $_SESSION['Zend_Auth']['storage']->usu_id;
        $data->tip_inf_id = '1'; //ahorita esta quemado, debería tomar este valor de una variable global

        $infraccion = new InfraccionEntity();
        $infraccion->exchangeArray ( $data );
        $inf_id=$this->getInfraccionDao()->guardar ( $infraccion );

        $data->inf_id=$inf_id;
        $data->mul_par_estado='I'; //In-pago
        $data->mul_par_valor='30.10'; //valor de la multa ahorita esta quemado

        $multa_parqueadero = new MultaParqueaderoEntity();
        $multa_parqueadero->exchangeArray ( $data );
        $mul_par_id=$this->getMultaParqueaderoDao()->guardar ( $multa_parqueadero );

        return $this->redirect ()->toRoute ( 'parqueaderos', array (
                'controller' => 'sector',
                'action' => 'index',
                'id' => $data->sec_id
        )); 

    }

    public function solucionarAction(){
        //VERIFICA QUE SE HAYA REALIZADO UN POST DE INFORMACION
        if (! $this->request->isPost ()) {
            return $this->redirect ()->toRoute ( 'parqueaderos', array (
                    'controller' => 'parqueaderos',
                    'action' => 'index'
            ) );
        }
         
        //CAPTURA LA INFORMACION ENVIADA EN EL POST
        $data = $this->request->getPost ();

        //$multa_parqueadero = new MultaParqueaderoEntity();
        $multa_parqueadero=$this->getMultaParqueaderoDao()->traer($data->mul_par_id);
        $multa_parqueadero->setMul_par_estado('S');
        $mul_par_id=$this->getMultaParqueaderoDao()->guardar ( $multa_parqueadero );
        
        return $this->redirect ()->toRoute ( 'parqueaderos', array (
                'controller' => 'sector',
                'action' => 'index',
                'id' => $data->sec_id
        )); 

    }    


    public function getForm() {
        $form = new Sector ();
        return $form;
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

    public function getInfraccionDao() {
        if (! $this->infraccionDao) {
            $sm = $this->getServiceLocator ();
            $this->infraccionDao = $sm->get ( 'Application\Model\Dao\InfraccionDao' );
        }
        return $this->infraccionDao;
    }    
    public function getMultaParqueaderoDao() {
        if (! $this->multaParqueaderoDao) {
            $sm = $this->getServiceLocator ();
            $this->multaParqueaderoDao = $sm->get ( 'Application\Model\Dao\MultaParqueaderoDao' );
        }
        return $this->multaParqueaderoDao;
    }    


	
}