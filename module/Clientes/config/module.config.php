<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Clientes\Controller\Index' => 'Clientes\Controller\IndexController',
            'Clientes\Controller\Asignar' => 'Clientes\Controller\AsignarController',
            'Clientes\Controller\Compras' => 'Clientes\Controller\ComprasController',
            'Clientes\Controller\Recargas' => 'Clientes\Controller\RecargasController',
            'Clientes\Controller\TransferenciasRealizadas' => 'Clientes\Controller\TransferenciasRealizadasController',
            'Clientes\Controller\TransferenciasRecibidas' => 'Clientes\Controller\TransferenciasRecibidasController',
            'Clientes\Controller\Perfil' => 'Clientes\Controller\PerfilController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'clientes' => array(
                'type'    => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route'    => '/clientes[/:controller][/:action][/:id]',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Clientes\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    // This route is a sane default when developing a module;
                    // as you solidify the routes for your module, however,
                    // you may want to remove it and replace it with more
                    // specific routes.
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action[/:id]]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            	'id'     => '[0-9]*',
                            ),
                            'defaults' => array (
								'__NAMESPACE__' => 'Clientes\Controller',
								'controller' => 'Index',
								'action' => 'index' 
							) 
                        ),
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'Clientes' => __DIR__ . '/../view',
        ),
    ),
);
