<?php

namespace Courses;

use Laminas\Router\Http\Segment;
use Laminas\ServiceManager\Factory\InvokableFactory;

return [
    'controllers' => [
        'invokables' => [
            \src\Courses\Controller\CoursesController::class => InvokableFactory::class,
        ],
    ],

    // The following section is new and should be added to your file:
    'router' => [
        'routes' => [
            'courses' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/courses[/][:action[/][:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => \Courses\Controller\CoursesController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],

    'view_manager' => [
        'template_path_stack' => [
            'courses' => __DIR__ . '/../view',
        ],
    ],
];
