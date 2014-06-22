<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Usuarios\Controller\Usuarios' => 'Usuarios\Controller\UsuariosController',
        	'Usuarios\Controller\Roles' => 'Usuarios\Controller\RolesController',
        	'Usuarios\Controller\Aplicaciones' => 'Usuarios\Controller\AplicacionesController',
        		
        ),
    ),
    'router' => array(
        'routes' => array(
            'usuarios' => array(
                'type'    => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route'    => '/usuarios[/:controller][/:action][/:id]',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Usuarios\Controller',
                        'controller'    => 'Usuarios',
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
								'__NAMESPACE__' => 'Usuarios\Controller',
								'controller' => 'Usuarios',
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
            'Usuarios' => __DIR__ . '/../view',
        ),
    ),
);