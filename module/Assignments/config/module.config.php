<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Assignments\Controller\Assignments' => 'Assignments\Controller\AssignmentsController',
        ),
    ),
    // The following section is new and should be added to your file
    'router' => array(
        'routes' => array(
            'assignments' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/assignments[/][:action][/][:id][/]',
                    'constraints' => array(
//                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
//                        'id'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'Assignments\Controller\Assignments',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'Assignments' => __DIR__ . '/../view',
        ),
    ),
);
