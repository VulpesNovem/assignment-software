<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Connections\Controller\Connections' => 'Connections\Controller\ConnectionsController',
        ),
    ),
    // The following section is new and should be added to your file
    'router' => array(
        'routes' => array(
            'connections' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/connections[/][:action][/][:id][/]',
                    'constraints' => array(
//                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
//                        'id'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'Connections\Controller\Connections',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'Connections' => __DIR__ . '/../view',
        ),
    ),
);
