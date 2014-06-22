<?php
namespace Usuarios;
use Zend\Db\ResultSet\ResultSet;

use Usuarios\Model\Dao\RolDao;
use Usuarios\Model\Entity\Rol;

use Usuarios\Model\Dao\AplicacionDao;
use Usuarios\Model\Entity\Aplicacion;

use Usuarios\Model\Dao\RolAplicacionDao;
use Usuarios\Model\Entity\RolAplicacion;

use Usuarios\Model\Dao\RolUsuarioDao;
use Usuarios\Model\Entity\RolUsuario;

use Usuarios\Model\Dao\VistaUsuarioDao;
use Usuarios\Model\Entity\VistaUsuario;

use Zend\Db\TableGateway\TableGateway;



class Module
{
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    
    public function getServiceConfig()
     {
         return array(
             'factories' => array(
                /*  'Usuarios\Model\Dao\RolDao' =>  function($sm) {
                     $tableGateway = $sm->get('RolTableGateway');
                     $table = new RolDao($tableGateway);
                     return $table;
                 },
                 'RolTableGateway' => function ($sm) {
                     $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                     $resultSetPrototype = new ResultSet();
                     $resultSetPrototype->setArrayObjectPrototype(new Rol());
                     return new TableGateway('rol', $dbAdapter, null, $resultSetPrototype);
                 },

                'Usuarios\Model\Dao\RolAplicacionDao' =>  function($sm) {
                     $tableGateway = $sm->get('RolAplicacionTableGateway');
                     $table = new RolAplicacionDao($tableGateway);
                     return $table;
                 },
                 'RolAplicacionTableGateway' => function ($sm) {
                     $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                     $resultSetPrototype = new ResultSet();
                     $resultSetPrototype->setArrayObjectPrototype(new RolAplicacion());
                     return new TableGateway('rol_aplicacion', $dbAdapter, null, $resultSetPrototype);
                 },

                'Usuarios\Model\Dao\RolUsuarioDao' => function($sm){
                    $tableGateway = $sm->get('RolUsuarioTableGateway');
                    return new RolUsuarioDao($tableGateway);
                },
                'RolUsuarioTableGateway' => function ($sm){
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new RolUsuario());
                    return new TableGateway('rol_usuario', $dbAdapter, null, $resultSetPrototype);
                }, */

                /* 'Usuarios\Model\Dao\VistaUsuarioDao' => function($sm){
                    $tableGateway = $sm->get('VistaUsuarioTableGateway');
                    return new VistaUsuarioDao($tableGateway);
                },
                'VistaUsuarioTableGateway' => function ($sm){
                    $config = $sm->get ( 'config' );
                    $db_auth = new \Zend\Db\Adapter\Adapter ( $config ['db_view'] );
                    //$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new VistaUsuario());
                    return new TableGateway('VISTA_USUARIO', $db_auth, null, $resultSetPrototype);
                }, */

                /* 'Usuarios\Model\Dao\AplicacionDao' => function($sm){
                    $tableGateway = $sm->get('AplicacionTableGateway');
                    return new AplicacionDao($tableGateway);
                },
                'AplicacionTableGateway' => function ($sm){
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Aplicacion());
                    return new TableGateway('aplicacion', $dbAdapter, null, $resultSetPrototype);
                },   */              
             ),
         );
     }
}
