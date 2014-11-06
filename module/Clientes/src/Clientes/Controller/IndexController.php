<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonModule for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace Clientes\Controller;

use Zend\Mvc\Controller\AbstractActionController;


class IndexController extends AbstractActionController
{

    private $clienteDao;

    public function indexAction()
    {
        return array();
    }

    public function listadoAction()
    {
        $this->layout()->setVariable('menupadre', null)->setVariable('menuhijo', 'clientes');
        return array(
            'cliente' => $this->getClienteDao()->traerTodos(),
            'navegacion' => array('datos' =>  array ( 'Inicio' => array('parametros','index','video'), 'Listado de Clientes' => array('clientes','index','listado')) ),
        );
    }

    public function getClienteDao()
    {
        if (! $this->clienteDao) {
            $sm = $this->getServiceLocator();
            $this->clienteDao = $sm->get('Application\Model\Dao\ClienteDao');
        }
        return $this->clienteDao;
    }
}