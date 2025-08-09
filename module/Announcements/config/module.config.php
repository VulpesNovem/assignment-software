<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Announcements\Controller\Announcements' => 'Announcements\Controller\AnnouncementsController',
        ),
    ),
    // The following section is new and should be added to your file
    'router' => array(
        'routes' => array(
            'announcements' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/announcements[/][:action][/][:id][/]',
                    'constraints' => array(
//                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
//                        'id'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'Announcements\Controller\Announcements',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'Announcements' => __DIR__ . '/../view',
        ),
    ),
);
