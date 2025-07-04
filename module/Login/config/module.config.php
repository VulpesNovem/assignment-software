<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Login\Controller\LoginController' => 'Login\Controller\LoginController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'login' => array(
                'type'    => 'segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route'    => '/login[/][:action][/][:id][/]',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                       // 'Login' => 'Login\Controller\LoginController',
                        'controller'    => 'Login\Controller\LoginController',
                        'action'        => 'index',
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'Login' => __DIR__ . '/../view',
        ),
    ),
);
