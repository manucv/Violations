<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonModule for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Usuarios\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class AplicacionesController extends AbstractActionController
{
	protected $aplicacionDao;
	
    public function listadoAction()
    {
        $this->layout()->setVariable('menupadre', 'administracion')->setVariable('menuhijo', 'aplicaciones');
        return array(
            'aplicaciones' => $this->getAplicacionDao()->traerTodos(),
            'navegacion' => array('datos' =>  array ( 'Inicio' => array('parametros','index','video'), 'Listado de Aplicaciones' => array('usuarios','aplicaciones','listado')) ),
        );
    }
    
    
    public function getAplicacionDao() {
    	if (! $this->aplicacionDao) {
    		$sm = $this->getServiceLocator ();
    		$this->aplicacionDao = $sm->get ( 'Application\Model\Dao\AplicacionDao' );
    	}
    	return $this->aplicacionDao;
    }

}