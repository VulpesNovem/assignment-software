<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Courses\Controller\Courses' => 'Courses\Controller\CoursesController',
        ),
    ),
    // The following section is new and should be added to your file
    'router' => array(
        'routes' => array(
            'courses' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/courses[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Courses\Controller\Courses',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'Courses' => __DIR__ . '/../view',
        ),
    ),
);
