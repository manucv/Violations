<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonModule for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Infraccion\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Infraccion\Form\Reporte;
use Infraccion\Form\ReporteValidator;

use Infraccion\Form\Detalle;
use Infraccion\Form\DetalleValidator;

use Infraccion\Form\Consulta;
use Infraccion\Form\ConsultaValidator;


class InfraccionController extends AbstractActionController
{

    protected $infraccionDao;
    protected $multaParqueaderoDao;
    protected $tipoInfraccionDao;
    protected $usuarioDao;
    protected $parqueaderoDao;
    protected $calleDao;

    public function indexAction()
    {

        $this->layout()->setVariable('menupadre', null)->setVariable('menuhijo', 'infracciones');

        return array(
            'infraccion' => $this->getInfraccionDao()->traerTodos(),
            'messages'=> $this->flashmessenger()->getErrorMessages(),
            'navegacion' => array('datos' =>  array ( 'Inicio' => array('parametros','index','video'), 'Listado de Infracciones' => array('infraccion','infraccion','index')) ),
        );

    }

    public function historialAction()
    {

        $this->layout()->setVariable('menupadre', null)->setVariable('menuhijo', 'infracciones');

        return array(
            'infraccion' => $this->getInfraccionDao()->traerProcesados(),
            'messages'=> $this->flashmessenger()->getErrorMessages(),
            'navegacion' => array('datos' =>  array ( 'Inicio' => array('parametros','index','video'), 'Listado de Infracciones' => array('infraccion','infraccion','index')) ),
        );

    }

    public function detalleAction()
    {
        $id = ( int ) $this->params ()->fromRoute ( 'id', 0 );

        $this->layout()->setVariable('menupadre', null)->setVariable('menuhijo', 'infracciones');

        $infraccion = $this->getInfraccionDao()->traer($id);
        if(is_object($infraccion)){
            $multa  = $this->getMultaParqueaderoDao()->traerPorInfraccion($id);
            if($multa){
                $parqueadero  = $this->getParqueaderoDao()->traer($multa->getPar_id());
                $calle_principal = $this->getCalleDao()->traer($parqueadero->getPar_cal_principal());
                $calle_secundaria = $this->getCalleDao()->traer($parqueadero->getPar_cal_secundaria());
                $tipo   = $this->getTipoInfracionDao()->traer($infraccion->getTip_inf_id());

                $usuario   = $this->getUsuarioDao()->traer($infraccion->getUsu_id());

                $form = $this->getDetalleForm ();

                return array(
                    'messages'=> $this->flashmessenger()->getSuccessMessages(),
                    'infraccion' => $infraccion,
                    'multa' => $multa,
                    'tipo' => $tipo,
                    'usuario' => $usuario,
                    'calle_principal' => $calle_principal,
                    'calle_secundaria' => $calle_secundaria,
                    'formulario' => $form ,
                    'navegacion' => array('datos' =>  array ( 'Inicio' => array('parametros','index','video'), 'Listado de Infracciones' => array('infraccion','infraccion','index')) ),
                );
            } else {
                return $this->redirect ()->toRoute ( 'infraccion', array (
                    'controller' => 'infraccion'
                ));    
            }
        } else {
            $this->flashmessenger()->addErrorMessage("No existen la infracción");  
            return $this->redirect ()->toRoute ( 'infraccion', array (
                'controller' => 'infraccion'
            ));
        }    
    }

    public function reporteAction()
    {
        $fecha_ini  = $data['fecha_ini'] = date("Y-m-d");
        $fecha_fin  = $data['fecha_fin'] = date("Y-m-d");

        $form = $this->getReporteForm ();

        if ($this->request->isPost ()) {
            $data = $this->request->getPost ();
            $fecha_ini = $data['fecha_ini'];
            $fecha_fin = $data['fecha_fin'];
            
        }  
        $form->setData ( $data );
        
        $registros_totales = $this->getInfraccionDao()->traerTotales($fecha_ini, $fecha_fin);  
        $registros = $this->getInfraccionDao()->traerPorTipo($fecha_ini, $fecha_fin);
        $registrosVigilante = $this->getInfraccionDao()->traerPorVigilante($fecha_ini, $fecha_fin);
        $registrosCalle = $this->getInfraccionDao()->traerPorCalle($fecha_ini, $fecha_fin);

        $this->layout()->setVariable('menupadre', 'reportes')->setVariable('menuhijo', 'infraccion');

        return array(
            'formulario' => $form ,
            'registros_totales' => $registros_totales,
            'registros' => $registros,
            'registros_vigilante' => $registrosVigilante,
            'registros_calle' => $registrosCalle,
            'navegacion' => array('datos' =>  array ( 'Inicio' => array('parametros','index','video'), 'Reporte de Infracciones' => array('infraccion','infraccion','reporte')) ),
        );
    }

    public function consultaAction()
    {
        $form = $this->getConsultaForm ();
        $infracciones = array();
        if ($this->request->isPost ()) {
            $data = $this->request->getPost ();
            $aut_placa = $data['aut_placa'];
            $form->setData ( $data );

            $service=$this->getInfraccionDao()->consultarInfraccionMunicipio($data);   
            $infracciones = json_decode($service);

        }  

        return array(
            'infracciones'  => $infracciones,
            'formulario'    => $form ,
            'navegacion'    => array('datos' =>  array ( 'Inicio' => array('parametros','index','video'), 'Consulta de Infracciones' => array('infraccion','infraccion','consulta')) ),
        );

    }

    public function getReporteForm() {
        $form = new Reporte ();
        return $form;
    }

    public function getConsultaForm() {
        $form = new Consulta ();
        return $form;
    }

    public function getDetalleForm() {
        $form = new Detalle ();
        return $form;
    }
    
    public function getInfraccionDao()
    {
        if (! $this->infraccionDao) {
            $sm = $this->getServiceLocator();
            $this->infraccionDao = $sm->get('Application\Model\Dao\InfraccionDao');
        }
        return $this->infraccionDao;
    }

    public function getMultaParqueaderoDao()
    {
        if (! $this->multaParqueaderoDao) {
            $sm = $this->getServiceLocator();
            $this->multaParqueaderoDao = $sm->get('Application\Model\Dao\MultaParqueaderoDao');
        }
        return $this->multaParqueaderoDao;
    }

    public function getTipoInfracionDao()
    {
        if (! $this->tipoInfraccionDao) {
            $sm = $this->getServiceLocator();
            $this->tipoInfraccionDao = $sm->get('Application\Model\Dao\TipoInfraccionDao');
        }
        return $this->tipoInfraccionDao;
    }

    public function getUsuarioDao()
    {
        if (! $this->usuarioDao) {
            $sm = $this->getServiceLocator();
            $this->usuarioDao = $sm->get('Application\Model\Dao\UsuarioDao');
        }
        return $this->usuarioDao;
    }
    public function getParqueaderoDao()
    {
        if (! $this->parqueaderoDao) {
            $sm = $this->getServiceLocator();
            $this->parqueaderoDao = $sm->get('Application\Model\Dao\ParqueaderoDao');
        }
        return $this->parqueaderoDao;
    }
    public function getCalleDao()
    {
        if (! $this->calleDao) {
            $sm = $this->getServiceLocator();
            $this->calleDao = $sm->get('Application\Model\Dao\CalleDao');
        }
        return $this->calleDao;
    }

    public function aprobarInfraccionAction(){

        $id = $this->params ()->fromRoute ( 'id', 0 );


        if (! $this->request->isPost ()) {
            return $this->redirect ()->toRoute ( 'parametros', array (
                    'controller' => 'infraccion'
            ) );
        }

        $is_error = true;

        $data = $this->request->getPost ();
        
        $infraccion = $this->getInfraccionDao()->traer($id);
        if(is_object($infraccion)){
            $infraccion->setInf_estado('A');

            $multa_parqueadero = $this->getMultaParqueaderoDao()->traerPorInfraccion($id);
            $parqueadero  = $this->getParqueaderoDao()->traer($multa_parqueadero->getPar_id());
            $calle_principal = $this->getCalleDao()->traer($parqueadero->getPar_cal_principal());
            $calle_secundaria = $this->getCalleDao()->traer($parqueadero->getPar_cal_secundaria());
            $usuario = $this->getUsuarioDao()->traer($infraccion->getUsu_id());

            $fecha_hora = $infraccion->getInf_fecha();
            $fecha_hora = explode(' ', $fecha_hora);
            $fecha = $fecha_hora['0'];
            $hora = $fecha_hora['1'];

            $data=array(
                'numero' => $id,
                'numero_tarjeta' => 0,
                'numero_placa' => $multa_parqueadero->getAut_placa(),
                'calle_prin' => $calle_principal->getCal_codigo(),
                'calle_trans' => $calle_secundaria->getCal_codigo(),
                'fecha' => $fecha,
                'hora' => $hora,
                'a' => 'f',
                'b' => 'f',
                'c' => 'f',
                'd' => 'f',
                'e' => 'f',
                'f' => 'f',
                'g' => 'f',
                'h' => 'f',
                'i' => 'f',
                'j' => 'f',
                'tiempo_permanencia' => $data['tiempo_permanencia'],
                'supervisor' => $usuario->getUsu_documento(), //Documento del usuario
                'estado' => 'N',
                'observacion' => 'Aprobado desde el sistema',
                'inmovilizado' => $data['inmovilizado'],
                'imagen1' => $multa_parqueadero->getMul_par_prueba_1()!=''?'http://ibarra.sip.ec/Violations/files/'.$multa_parqueadero->getMul_par_prueba_1():'',
                'imagen2' => $multa_parqueadero->getMul_par_prueba_2()!=''?'http://ibarra.sip.ec/Violations/files/'.$multa_parqueadero->getMul_par_prueba_2():'',
                'imagen3' => $multa_parqueadero->getMul_par_prueba_3()!=''?'http://ibarra.sip.ec/Violations/files/'.$multa_parqueadero->getMul_par_prueba_3():'',
                'usuario' => 'SISMERTWSE',
                'password' =>  'Eb2Yhye3'  
            );
            
            $data[$infraccion->getTip_inf_codigo()]='t';

            /* ejecución del servicio del municipio */
            $service=$this->getInfraccionDao()->asentarInfraccionMunicipio($data);   
            $tipo   = $this->getTipoInfracionDao()->traer($infraccion->getTip_inf_id());
            $usuario   = $this->getUsuarioDao()->traer($infraccion->getUsu_id());
            
            if($service){
                $this->getInfraccionDao()->guardar($infraccion);  
                $this->flashmessenger()->addSuccessMessage("Infracción aprobada exitosamente");
                $is_error = false;
            }else{
                $this->flashmessenger()->addErrorMessage("Error al aprobar la infracción");  
            }
        } else {
            $this->flashmessenger()->addErrorMessage("No se encontr&oacute; la infracción, verifique los datos");  
        }
        //die();
        if($is_error){
            return $this->redirect ()->toRoute ( 'infraccion', array (
                'controller' => 'infraccion'
            ));
        }else{

            $previous = $this->getInfraccionDao()->getPrevious($id);
            if($previous){
                return $this->redirect ()->toRoute ( 'infraccion', array (
                    'controller' => 'infraccion', 'action' => 'detalle' , 'id' =>  $previous
                ));
            }else{
                return $this->redirect ()->toRoute ( 'infraccion', array (
                    'controller' => 'infraccion'
                ));  
            }
        }    
    }

    public function rechazarInfraccionAction(){

        $id = $this->params ()->fromRoute ( 'id', 0 );

        $infraccion = $this->getInfraccionDao()->traer($id);
        $is_error = true;
        if(is_object($infraccion)){
            $infraccion->setInf_estado('E');
            //A: Aporbada
            //R: Registrada
            //E: Rechazada

            if($this->getInfraccionDao()->guardar($infraccion)){
                $this->flashmessenger()->addSuccessMessage("Infracción rechazada exitosamente");
                $is_error = false;
            }else{
                $this->flashmessenger()->addErrorMessage("Error al rechazar la infracción");
            }
        }else{
            $this->flashmessenger()->addErrorMessage("No se encontr&oacute; la infracción, verifique los datos");
        }   

        if($is_error){
            return $this->redirect ()->toRoute ( 'infraccion', array (
                'controller' => 'infraccion'
            ));
        }else{

            $previous = $this->getInfraccionDao()->getPrevious($id);
            if($previous){
                return $this->redirect ()->toRoute ( 'infraccion', array (
                    'controller' => 'infraccion', 'action' => 'detalle' , 'id' =>  $previous
                ));
            }else{
                $this->flashmessenger()->addErrorMessage("No existen más infracciones");
                return $this->redirect ()->toRoute ( 'infraccion', array (
                    'controller' => 'infraccion'
                ));  
            }
        }    
    }
}