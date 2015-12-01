<?php


return [


    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
        //more options
        'template_map' => [
            'layout/board'=> __DIR__ .'/../view/layout/board.phtml'
        ],
    ],

    'controllers' => [
        'invokables' => [
            'Board\Controller\Index' => 'Board\Controller\IndexController',
        ],
    ],

    'service_manager' => [],

    'router' => [
        'routes' => [
            'board' => [
                'type' => 'Literal',
                'options' => [
                    'route' => '/board',
                    'defaults' => [
                        '__NAMESPACE__' => 'Board\Controller',
                        'controller' => 'Index',
                        'action' => 'index',
                    ],
                ],
                //child route
                //profile route
                'may_terminate' => true,
                'child_routes' => [
                    'usr' => [
                        'type' => 'Segment',
                        'options' => [
                            'route' => '/usr[/:controller[/:action]]',
                            'constraints' => [
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ],
                            'defaults' => [
                                '__NAMESPACE__' => 'Profile\Controller',
                                'controller' => 'Index',
                                'action' => 'index',
                            ],
                        ]
                    ],

                    'booking' => [
                        'type' => 'Segment',
                        'options' => [
                            'route' => '/booking[/:controller[/:action]]',
                            'constraints' => [
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ],
                            'defaults' => [
                                '__NAMESPACE__' => 'Booking\Controller',
                                'controller' => 'Index',
                                'action' => 'index',
                            ],
                        ]
                    ],

                    'traject' => [
                        'type' => 'Segment',
                        'options' => [
                            'route' => '/traject[/:controller[/:action]]',
                            'constraints' => [
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ],
                            'defaults' => [
                                '__NAMESPACE__' => 'Traject\Controller',
                                'controller' => 'UserList',
                                'action' => 'index',
                            ],
                        ]
                    ],
                ],
            ],
        ],

    ]
];