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

class InfraccionController extends AbstractActionController
{

    protected $infraccionDao;
    protected $multaParqueaderoDao;
    protected $tipoInfraccionDao;
    protected $usuarioDao;

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

        return array(
            'infraccion' => $infraccion,
            'multa' => $multa,
            'tipo' => $tipo,
            'usuario' => $usuario,
            'navegacion' => array('datos' =>  array ( 'Inicio' => array('parametros','index','video'), 'Listado de Infracciones' => array('infraccion','infraccion','index')) ),
        );
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

}
