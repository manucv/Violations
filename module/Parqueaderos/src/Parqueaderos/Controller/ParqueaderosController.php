<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonModule for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Parqueaderos\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Parqueaderos\Form\Sector;
//use Application\Model\Entity\Pais as PaisEntity;
//use Application\Model\Entity\Sector as SectorEntity;

class ParqueaderosController extends AbstractActionController
{
    protected $paisDao;
    protected $sectorDao;
    public function indexAction()
    {
        $form = $this->getFormBusqueda ();
        $form->get('pai_id' )->setValueOptions ( $this->getPaisDao ()->traerTodosArreglo () );
        $sectores=$this->getSectorDao ()->traerTodosJSON();
        return array('formulario' => $form, 'sectores'=>$sectores);
    }

    /* GET DAO's */
    public function getPaisDao() {
        if (! $this->paisDao) {
            $sm = $this->getServiceLocator ();
            $this->paisDao = $sm->get ( 'Application\Model\Dao\PaisDao' );
        }
        return $this->paisDao;
    }
    public function getSectorDao() {
        if (! $this->sectorDao) {
            $sm = $this->getServiceLocator ();
            $this->sectorDao = $sm->get ( 'Application\Model\Dao\SectorDao' );
        }
        return $this->sectorDao;
    }

    public function getFormBusqueda() {
        $form = new Sector();
        return $form;
    }
}
