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
    public function indexAction()
    {
        return array();
    }
    
    public function perfilAction(){
        
        $id = ( int ) $this->params ()->fromRoute ( 'id', 0 );
        
        $this->layout()->setVariable('activo', '12');
        return array(
            'cliente' => $this->getClienteDao()->traer($id),
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
}
