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
        $this->layout()->setVariable('menupadre', null)->setVariable('menuhijo', 'infracciones');
        return array(
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

}
