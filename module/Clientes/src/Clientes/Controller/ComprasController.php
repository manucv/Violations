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

class ComprasController extends AbstractActionController
{
    
    private $transaccionDao;
    
    public function indexAction()
    {
        return array();
    }
    
    public function transaccionAction(){
        $this->layout()->setVariable('menupadre', null)->setVariable('menuhijo', 'comprasParqueo');
        return array(
            'transaccion' => $this->getTransaccionDao()->traerTodos(),
            'navegacion' => array('datos' =>  array ( 'Inicio' => array('parametros','index','video'), 'Compras de Parqueo' => array('clientes','compras','transaccion')) ),
        );
    }
    
    public function getTransaccionDao()
    {
        if (! $this->transaccionDao) {
            $sm = $this->getServiceLocator();
            $this->transaccionDao = $sm->get('Application\Model\Dao\TransaccionDao');
        }
        return $this->transaccionDao;
    }
}
