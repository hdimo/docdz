<?php
return [
    'controllers' => [
        'invokables' => [
            'Contact\Controller\Index' => 'Contact\Controller\IndexController',
        ],
    ],
    
    
    'router' => [
        'routes' => [
            'contact' => [
                'type'    => 'Literal',
                'options' => [
                    'route'    => '/contact',
                    'defaults' => [
                        '__NAMESPACE__' => 'Contact\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                    ],
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'default' => [
                        'type'    => 'Segment',
                        'options' => [
                            'route'    => '/[:controller[/:action]]',
                            'constraints' => [
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ],
                            'defaults' => [
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            'Contact' => __DIR__ . '/../view',
        ],
    ],
];
