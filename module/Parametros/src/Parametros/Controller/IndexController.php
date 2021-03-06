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

class IndexController extends AbstractActionController
{

    protected $parqueaderoDao;

    public function indexAction()
    {
        $this->layout()->setVariable('menupadre', null)->setVariable('menuhijo', 'dashboard');
        $parqueaderos = $this->getParqueaderoDao()->traerTodos();
        return array('navegacion' => array('datos' =>  array (  'Inicio' => array('parametros','index','video'), 
                                                                'Dashboard' => array('parametros','index','index')) 
                                                            ),
                     'parqueaderos' => $parqueaderos
                    );
    }
    
    public function videoAction()
    {
        $this->layout()->setVariable('menupadre', null)->setVariable('menuhijo', 'inicio');
        return array();
    }

    public function getParqueaderoDao() {
        if (! $this->parqueaderoDao) {
            $sm = $this->getServiceLocator ();
            $this->parqueaderoDao = $sm->get ( 'Application\Model\Dao\ParqueaderoDao' );
        }
        return $this->parqueaderoDao;
    }
}
