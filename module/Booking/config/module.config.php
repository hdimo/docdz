<?php

/**
 * Booking
 */

return [

    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
        //more options
        'template_map' => [
            'layout/booking' => __DIR__ . '/../view/layout/booking-menu.phtml'
        ],
    ],

    'controllers' => [
        'invokables' => [
            'Booking\Controller\Index' => 'Booking\Controller\IndexController',
        ],
    ],

    'service_manager' => [],

    'router' => [
// Uncomment below to add routes
//        'routes' => array(
//            'booking' => array(
//                'type' => 'Literal',
//                'options' => array(
//                    'route' => '/booking',
//                    'defaults' => array(
//                        '__NAMESPACE__' => 'Booking\Controller',
//                        'controller' => 'Booking',
//                        'action' => 'index',
//                    )
//                )
//            )
//        ),
//        'may_terminate' => true,
//        'child_routes' => array(
//            'default' => array(
//                'type' => 'Segment',
//                'options' => array(
//                    'route' => '/[:controller[/:action]]',
//                    'constraints' => array(
//                        'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
//                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
//                    )
//                )
//            )
//        )
    ]
];