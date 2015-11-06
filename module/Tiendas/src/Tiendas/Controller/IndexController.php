<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonModule for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace Tiendas\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Tiendas\Form\Login;
use Tiendas\Form\LoginValidator;

use Application\Model\Entity\PuntoRecarga as PuntoRecargaEntity;

class IndexController extends AbstractActionController
{

    protected $puntoRecargaDao;

    public function indexAction()
    {
        $form = new Login ( 'login' );

        $viewParams = array ('form' => $form ); 
        

        
        return $viewParams;
    }

    public function autenticarAction()
    {
        if (! $this->request->isPost ()) {
            $this->redirect ()->toRoute ( 'tiendas', array (
                    'controller' => 'index'
            ) );
        }
        
        $form = new Login ( 'login' );
        $form->setInputFilter ( new LoginValidator () );
        
        $data = $this->request->getPost ();
        $form->setData ( $data );
        
        if (! $form->isValid ()) {
            $modelView = new ViewModel ( array ( 'form' => $form    ) );
            $modelView->setTemplate ( 'tiendas/index/index' );
            return $modelView;
        }
        
        $values = $form->getData ();
        
        $usuario = $values ['pun_rec_ruc'];
        $clave = $values ['pun_rec_clave'];

        $puntorecarga = $this->getPuntoRecargaDao()->traerPorRucClave($usuario,$clave );
        if(is_object($puntorecarga)){
            
            die('si');
        }else{
            $modelView = new ViewModel ( array ( 'form' => $form, 'message'=>'Usuario o Contraseña Incorrecta'   ) );
            $modelView->setTemplate ( 'tiendas/index/index' );
            return $modelView;
        }

    }

    public function buscarAction()
    {
        
    }

    public function recargarAction()
    {
        
    }

    public function getPuntoRecargaDao()
    {
        if (! $this->puntoRecargaDao) {
            $sm = $this->getServiceLocator();
            $this->puntoRecargaDao = $sm->get('Application\Model\Dao\PuntoRecargaDao');
        }
        return $this->puntoRecargaDao;
    }
}