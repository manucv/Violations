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

class PerfilController extends AbstractActionController
{
    
    private $clienteDao;
    private $relacionClienteDao;
    private $compraSaldoDao;
    private $transaccionDao;
    
    public function indexAction()
    {
        return array();
    }
    
    public function perfilAction(){
        
        $cli_id = ( int ) $this->params ()->fromRoute ( 'id', 0 );
        
        $this->layout()->setVariable('menupadre', null)->setVariable('menuhijo', 'clientes');
        return array(
            'usuarios' => $this->getRelacionClienteDao()->traerTodosPorCliente($cli_id),
            'recargas' => $this->getCompraSaldoDao()->traerRecargasPorUsuario($cli_id),
            'compras' => $this->getTransaccionDao()->traerTodosPorCliente($cli_id),
            'cliente' => $this->getClienteDao()->traer($cli_id),
            'navegacion' => array('datos' =>  array ( 'Inicio' => array('parametros','index','video'), 'Listado de Clientes' => array('clientes','index','listado'), 'Perfil' => array('clientes','perfil','perfil')) ),
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
    
    public function getRelacionClienteDao()
    {
        if (! $this->relacionClienteDao) {
            $sm = $this->getServiceLocator();
            $this->relacionClienteDao = $sm->get('Application\Model\Dao\RelacionClienteDao');
        }
        return $this->relacionClienteDao;
    }
    
    public function getCompraSaldoDao()
    {
        if (! $this->compraSaldoDao) {
            $sm = $this->getServiceLocator();
            $this->compraSaldoDao = $sm->get('Application\Model\Dao\CompraSaldoDao');
        }
        return $this->compraSaldoDao;
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
