<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Api\Controller\Api' => 'Api\Controller\ApiController',
            'Api\Controller\Vigilante' => 'Api\Controller\VigilanteController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'api' => array(
                'type'    => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route'    => '/api[/:controller[/:action[/:id[/:option]]]]',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Api\Controller',
                        'controller'    => 'Api',
                        'action'        => 'index',
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'Api' => __DIR__ . '/../view',
        ),
    ),
);