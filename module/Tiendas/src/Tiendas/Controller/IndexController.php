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

use Tiendas\Form\Buscar;
use Tiendas\Form\BuscarValidator;

use Application\Model\Entity\PuntoRecarga as PuntoRecargaEntity;
use Application\Model\Entity\CompraSaldo as CompraSaldoEntity;

class IndexController extends AbstractActionController
{

    protected $puntoRecargaDao;
    protected $clienteDao;
    protected $compraSaldoDao;

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

            return $this->redirect ()->toRoute ( 'tiendas', array (
                    'controller' => 'index',
                    'action' => 'buscar',
                    'id' => $puntorecarga->getPun_rec_id()
            ) );
        }else{
            $modelView = new ViewModel ( array ( 'form' => $form, 'message'=>'Usuario o Contraseña Incorrecta'   ) );
            $modelView->setTemplate ( 'tiendas/index/index' );
            return $modelView;
        }

    }

    public function buscarAction()
    {   
        
        $id = $this->params ()->fromRoute ( 'id', 0 );
        $puntorecarga = $this->getPuntoRecargaDao()->traer($id);

        // $puntorecarga = $this->getPuntoRecargaDao()->traerPorRucClave($usuario,$clave );
        $form = new Buscar('buscar');
        $form->bind ( $puntorecarga );
        $form->get ( 'punto_recarga_pun_rec_id' )->setAttribute ( 'value', $puntorecarga->getPun_rec_id() );

        return new ViewModel ( array ( 'form' => $form, 'puntorecarga'=>$puntorecarga   ) );
        // $modelView->setTemplate ( 'tiendas/index/index' );
        // return $modelView;
        
    }

    public function recargarAction()
    {
        if (! $this->request->isPost ()) {
            $this->redirect ()->toRoute ( 'tiendas', array (
                    'controller' => 'index',
                    'action' => 'buscar'
            ) );
        }
        
        $form = new Buscar ( 'buscar' );
        $form->setInputFilter ( new BuscarValidator () );

        $data = $this->request->getPost ();
        $form->setData ( $data );

        $cliente=$this->getClienteDao()->buscarPorEmailOUsuario($data['usu_email']);
        if(is_object($cliente)){
            $data['cli_id']=$cliente->getCli_id();
            $comprasaldo = new CompraSaldoEntity();
            $comprasaldo->exchangeArray ( $data );
            $this->getCompraSaldoDao()->guardar($comprasaldo);


        }
        $puntorecarga = $this->getPuntoRecargaDao()->traer($data['punto_recarga_pun_rec_id']);
        return $this->redirect ()->toRoute ( 'tiendas', array (
                    'controller' => 'index',
                    'action' => 'buscar',
                    'id' => $puntorecarga->getPun_rec_id()
        ) );

    }

    public function getPuntoRecargaDao()
    {
        if (! $this->puntoRecargaDao) {
            $sm = $this->getServiceLocator();
            $this->puntoRecargaDao = $sm->get('Application\Model\Dao\PuntoRecargaDao');
        }
        return $this->puntoRecargaDao;
    }
    public function getClienteDao()
    {
        if (! $this->clienteDao) {
            $sm = $this->getServiceLocator();
            $this->clienteDao = $sm->get('Application\Model\Dao\ClienteDao');
        }
        return $this->clienteDao;
    }
    public function getCompraSaldoDao()
    {
        if (! $this->compraSaldoDao) {
            $sm = $this->getServiceLocator();
            $this->compraSaldoDao = $sm->get('Application\Model\Dao\CompraSaldoDao');
        }
        return $this->compraSaldoDao;
    }
}