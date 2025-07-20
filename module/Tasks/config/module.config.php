<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Tasks\Controller\Tasks' => 'Tasks\Controller\TasksController',
        ),
    ),
    // The following section is new and should be added to your file
    'router' => array(
        'routes' => array(
            'tasks' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/tasks[/][:action][/][:id][/]',
                    'constraints' => array(
//                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
//                        'id'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'Tasks\Controller\Tasks',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'Tasks' => __DIR__ . '/../view',
        ),
    ),
);
