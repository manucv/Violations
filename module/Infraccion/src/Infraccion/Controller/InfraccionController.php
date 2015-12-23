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

class InfraccionController extends AbstractActionController
{

    protected $infraccionDao;
    protected $multaParqueaderoDao;
    protected $tipoInfraccionDao;
    protected $usuarioDao;
    protected $calleDao;

    public function indexAction()
    {

        $this->layout()->setVariable('menupadre', null)->setVariable('menuhijo', 'infracciones');

        return array(
            'infraccion' => $this->getInfraccionDao()->traerTodos(),
            'navegacion' => array('datos' =>  array ( 'Inicio' => array('parametros','index','video'), 'Listado de Infracciones' => array('infraccion','infraccion','index')) ),
        );

    }

    public function detalleAction()
    {
        $id = ( int ) $this->params ()->fromRoute ( 'id', 0 );

        $this->layout()->setVariable('menupadre', null)->setVariable('menuhijo', 'infracciones');

        $infraccion = $this->getInfraccionDao()->traer($id);
        $multa  = $this->getMultaParqueaderoDao()->traerPorInfraccion($id);
        $tipo   = $this->getTipoInfracionDao()->traer($infraccion->getTip_inf_id());
        $usuario   = $this->getUsuarioDao()->traer($infraccion->getUsu_id());

        $form = $this->getDetalleForm ();

        return array(
            'infraccion' => $infraccion,
            'multa' => $multa,
            'tipo' => $tipo,
            'usuario' => $usuario,
            'formulario' => $form ,
            'navegacion' => array('datos' =>  array ( 'Inicio' => array('parametros','index','video'), 'Listado de Infracciones' => array('infraccion','infraccion','index')) ),
        );
    }

    public function reporteAction()
    {
        $fecha_ini='';
        $fecha_fin='';

        $form = $this->getReporteForm ();

        if ($this->request->isPost ()) {
            $data = $this->request->getPost ();
            $fecha_ini = $data['fecha_ini'];
            $fecha_fin = $data['fecha_fin'];
            $form->setData ( $data );
        }    
        $registros = $this->getInfraccionDao()->traerPorTipo($fecha_ini, $fecha_fin);
        $registrosVigilante = $this->getInfraccionDao()->traerPorVigilante($fecha_ini, $fecha_fin);
        $registrosCalle = $this->getInfraccionDao()->traerPorCalle($fecha_ini, $fecha_fin);

        $this->layout()->setVariable('menupadre', 'reportes')->setVariable('menuhijo', 'infraccion');

        

        return array(
            'formulario' => $form ,
            'registros' => $registros,
            'registros_vigilante' => $registrosVigilante,
            'registros_calle' => $registrosCalle,
            'navegacion' => array('datos' =>  array ( 'Inicio' => array('parametros','index','video'), 'Reporte de Infracciones' => array('infraccion','infraccion','reporte')) ),
        );
    }

    public function getReporteForm() {
        $form = new Reporte ();
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

        $data = $this->request->getPost ();
        
        $infraccion = $this->getInfraccionDao()->traer($id);
        if(is_object($infraccion)){
            $infraccion->setInf_estado('A');
            $multa_parqueadero = $this->getMultaParqueaderoDao()->traerPorInfraccion($id);

            $calle_principal = $this->getCalleDao()->traer($multa_parqueadero->getPar_cal_principal());
            $calle_secundaria = $this->getCalleDao()->traer($multa_parqueadero->getPar_cal_secundaria());

            $fecha_hora = $infraccion->getInf_fecha();
            $fecha_hora = explode(' ', $fecha_hora);
            $fecha = $fecha_hora['0'];
            $hora = $fecha_hora['1'];

            $data=array(
                'numero' => $multa_parqueadero->getInf_id(),
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
                'supervisor' => $_SESSION['Zend_Auth']['storage']->usu_documento,
                'estado' => 'N',
                'observacion' => 'Aprobado desde el sistema',
                'inmovilizado' => $data['inmovilizado'],
                'imagen1' => $multa_parqueadero->getMul_par_prueba_1()!=''?'http://ibarra.sip.ec/Violations/files/'.$multa_parqueadero->getMul_par_prueba_1():'',
                'imagen2' => $multa_parqueadero->getMul_par_prueba_2()!=''?'http://ibarra.sip.ec/Violations/files/'.$multa_parqueadero->getMul_par_prueba_2():'',
                'imagen3' => $multa_parqueadero->getMul_par_prueba_3()!=''?'http://ibarra.sip.ec/Violations/files/'.$multa_parqueadero->getMul_par_prueba_3():'',
                'usuario' => 'ROMEROC',
                'password' =>  'CRISTHIAN87'  
            );
            
            $data[$infraccion->getTip_inf_codigo()]='t';

            /* ejecución del servicio del municipio */
            echo 'insertando infraccion';
            $service=$this->getInfraccionDao()->asentarInfraccionMunicipio($data);   
            echo 'infraccion insertada';
            
            $tipo   = $this->getTipoInfracionDao()->traer($infraccion->getTip_inf_id());
            $usuario   = $this->getUsuarioDao()->traer($infraccion->getUsu_id());

            if($service){
                $this->getInfraccionDao()->guardar($infraccion);  

                $this->layout()->setVariable('menupadre', null)->setVariable('menuhijo', 'infracciones');

                $view = new ViewModel ( array(
                    'infraccion' => $this->getInfraccionDao()->traerTodos(),
                    'mensaje' => 'Actualizacion exitosa',
                    'navegacion' => array('datos' =>  array ( 'Inicio' => array('parametros','index','video'), 'Listado de Infracciones' => array('infraccion','infraccion','index')) ),
                ) );    

                $view->setTemplate('infraccion/infraccion/index');

                return $view;

            }else{
                $this->layout()->setVariable('menupadre', null)->setVariable('menuhijo', 'infracciones');

                $view = new ViewModel ( array(
                    'infraccion' => $this->getInfraccionDao()->traerTodos(),
                    'mensaje' => 'Error al actualizar',
                    'navegacion' => array('datos' =>  array ( 'Inicio' => array('parametros','index','video'), 'Listado de Infracciones' => array('infraccion','infraccion','index')) ),
                ) );    

                $view->setTemplate('infraccion/infraccion/index');

                return $view;
            }
        }
    }

    public function rechazarInfraccionAction(){
        $id = $this->params ()->fromRoute ( 'id', 0 );
        $infraccion = $this->getInfraccionDao()->traer($id);
        if(is_object($infraccion)){
            $infraccion->setInf_estado('E');
            //A: Aporbada
            //R: Registrada
            //E: Rechazada

            if($this->getInfraccionDao()->guardar($infraccion)){
                $this->flashmessenger()->addSuccessMessage("Infracción rechazada exitosamente");
            }else{
                $this->flashmessenger()->addErrorMessage("Error al rechazar la infracción");
            }
        }else{
            $this->flashmessenger()->addErrorMessage("No se encontr&oacute; la infracción, verifique los datos");
        }    

        return $this->redirect ()->toRoute ( 'infraccion', array (
            'controller' => 'infraccion'
        ));
    }
}