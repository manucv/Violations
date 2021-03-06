<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonModule for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace Parametros\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Parametros\Form\Sector;
use Parametros\Form\SectorValidator;
use Application\Model\Entity\Sector as SectorEntity;

class SectorController extends AbstractActionController
{

    protected $sectorDao;

    protected $ciudadDao;

    protected $paisDao;

    protected $estadoDao;

    protected $parqueaderoDao;

    public function listadoAction()
    {
        $this->layout()->setVariable('menupadre', 'parametros')->setVariable('menuhijo', 'sectores');
        return array(
            'sector' => $this->getSectorDao()->traerTodos(),
            'navegacion' => array('datos' =>  array ( 'Inicio' => array('parametros','index','video'), 'Listado de Sectores' => array('parametros','sector','listado')) ),
        );
    }

    public function parqueaderosAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        $this->layout()->setVariable('menupadre', 'parametros')->setVariable('menuhijo', 'sectores');
        return array(
            'parqueaderos' => $this->getParqueaderoDao()->traerTodos(),
            'parqueaderos_sector' => $this->getParqueaderoDao()->traerTodosPorSector($id),
            'navegacion' => array('datos' =>  array ( 'Inicio' => array('parametros','index','video'), 'Listado de Sectores' => array('parametros','sector','listado')) ),
        );
    }

    public function ingresarAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        $form = $this->getForm();
        
        $this->layout()->setVariable('menupadre', 'parametros')->setVariable('menuhijo', 'sectores');
        
        // FORMULARIO DE INGRESO DE INFORMACION
        return new ViewModel(array(
            'formulario' => $form,
            'navegacion' => array('datos' =>  array ( 'Inicio' => array('parametros','index','video'), 'Listado de Sectores' => array('parametros','sector','listado'), 'Ingresar Sector' => array('parametros','sector','ingresar')) ),
            'titulo' => 'Nuevo'
        ));
    }

    public function editarAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        $form = $this->getForm();
        
        // FORMULARIO DE ACTUALIZACION DE INFORMACION
        $sector = $this->getSectorDao()->traer($id);
        $form->bind($sector);
        
        $form->get('ingresar')->setAttribute('value', 'Actualizar');
        $form->get('sec_id')->setAttribute('value', $sector->getSec_id());
        
        $form->get('pai_id')->setValue($sector->getPai_id());
        $form->get('pai_id_hidden')->setValue($sector->getPai_id());
        $form->get('est_id_hidden')->setValue($sector->getEst_id());
        $form->get('ciu_id_hidden')->setValue($sector->getCiu_id());
        
        $this->layout()->setVariable('menupadre', 'parametros')->setVariable('menuhijo', 'sectores');
        
        $view = new ViewModel(array(
            'formulario' => $form,
            'navegacion' => array('datos' =>  array ( 'Inicio' => array('parametros','index','video'), 'Listado de Sectores' => array('parametros','sector','listado'), 'Actualizar Sector' => array('parametros','sector','editar', $id)) ),
            'titulo' => 'Actualizar'
        ));
        
        $view->setTemplate('parametros/sector/ingresar');
        return $view;
    }

    public function eliminarAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        
        // SE ELIMINA LA INFORMACION EN LA BDD
        if ($this->getSectorDao()->eliminar($id)) {
            // SI SE EJECUTO EXITOSAMENTE SE REGRESA AL LISTADO DE CONTACTOS
            return $this->redirect()->toRoute('parametros', array(
                'controller' => 'sector',
                'action' => 'listado'
            ));
        } else {
            $view = new ViewModel();
            $view->setTemplate('parametros/sector/errorBorrado');
            return $view;
        }
    }

    public function validarAction()
    {
        
        // VERIFICA QUE SE HAYA REALIZADO UN POST DE INFORMACION
        if (! $this->request->isPost()) {
            return $this->redirect()->toRoute('parametros', array(
                'controller' => 'sector',
                'action' => 'listado'
            ));
        }
        
        // CAPTURA LA INFORMACION ENVIADA EN EL POST
        $data = $this->request->getPost();
        
        // VERIFICA EL IDIOMA INGRESADO PARA TRAER EL FORMULARIO SEGUN EL IDIOMA
        $form = $this->getForm();
        
        // SE VALIDA EL FORMULARIO
        $form->setInputFilter(new SectorValidator());
        
        // SE LLENAN LOS DATOS DEL FORMULARIO
        $form->setData($data);
        
        $form->get('pai_id_hidden')->setValue($data['pai_id']);
        $form->get('est_id_hidden')->setValue($data['est_id']);
        $form->get('ciu_id_hidden')->setValue($data['ciu_id']);
        
        // SE VALIDA EL FORMULARIO ES CORRECTO
        if (! $form->isValid()) {
            
            $this->layout()->setVariable('menupadre', 'parametros')->setVariable('menuhijo', 'sectores');
            // SI EL FORMULARIO NO ES CORRECTO
            $modelView = new ViewModel(array(
                'formulario' => $form,
                'navegacion' => array('datos' =>  array ( 'Inicio' => array('parametros','index','video'), 'Listado de Sectores' => array('parametros','sector','listado'), 'Ingresar Sector' => array('parametros','sector','ingresar')) ),
                'titulo' => 'Validar informaci&oacute;n de'
            ));
            
            $modelView->setTemplate('parametros/sector/ingresar');
            return $modelView;
        }
        
        // ->AQUI EL FORMULARIO ES CORRECTO, SE VALIDO CORRECTAMENTE
        
        // SE GENERA EL OBJETO DE CONTACTO
        $sector = new SectorEntity();
        // SE CARGA LA ENTIDAD CON LA INFORMACION DEL POST
        $sector->exchangeArray($data);
        
        // SE GRABA LA INFORMACION EN LA BDD
        $this->getSectorDao()->guardar($sector);
        
        // SI SE EJECUTO EXITOSAMENTE SE REGRESA AL LISTADO DE CONTACTOS
        return $this->redirect()->toRoute('parametros', array(
            'controller' => 'sector',
            'action' => 'listado'
        ));
    }

    public function getForm()
    {
        $form = new Sector();
        // $form->get ( 'ciu_id' )->setValueOptions ( $this->getCiudadDao ()->traerTodosArreglo() );
        $form->get('pai_id')->setValueOptions($this->getPaisDao()
            ->traerTodosArreglo());
        return $form;
    }

    public function getSectorDao()
    {
        if (! $this->sectorDao) {
            $sm = $this->getServiceLocator();
            $this->sectorDao = $sm->get('Application\Model\Dao\SectorDao');
        }
        return $this->sectorDao;
    }

    public function getParqueaderoDao()
    {
        if (! $this->parqueaderoDao) {
            $sm = $this->getServiceLocator();
            $this->parqueaderoDao = $sm->get('Application\Model\Dao\ParqueaderoDao');
        }
        return $this->parqueaderoDao;
    }

    public function getCiudadDao()
    {
        if (! $this->ciudadDao) {
            $sm = $this->getServiceLocator();
            $this->ciudadDao = $sm->get('Application\Model\Dao\CiudadDao');
        }
        return $this->ciudadDao;
    }

    public function getPaisDao()
    {
        if (! $this->paisDao) {
            $sm = $this->getServiceLocator();
            $this->paisDao = $sm->get('Application\Model\Dao\PaisDao');
        }
        return $this->paisDao;
    }

    public function getEstadoDao()
    {
        if (! $this->estadoDao) {
            $sm = $this->getServiceLocator();
            $this->estadoDao = $sm->get('Application\Model\Dao\EstadoDao');
        }
        return $this->estadoDao;
    }

    public function sucursalesAjaxAction()
    {
        if ($this->getRequest()->isXmlHttpRequest()) {
            $pais = $this->request->getPost('pais');
            $data = $this->getEstadoDao()->getEstadosPorPais($pais);
            
            $jsonData = json_encode($data);
            $response = $this->getResponse();
            $response->setStatusCode(200);
            $response->setContent($jsonData);
            
            return $response;
        } else {
            return $this->redirect()->toRoute('parametros', array(
                'sector' => 'ingresar'
            ));
        }
    }

    public function ciudadesAjaxAction()
    {
        if ($this->getRequest()->isXmlHttpRequest()) {
            $estado = $this->request->getPost('estado');
            $data = $this->getCiudadDao()->getCiudadesPorEstado($estado);
            
            $jsonData = json_encode($data);
            $response = $this->getResponse();
            $response->setStatusCode(200);
            $response->setContent($jsonData);
            
            return $response;
        } else {
            return $this->redirect()->toRoute('parametros', array(
                'sector' => 'ingresar'
            ));
        }
    }
}