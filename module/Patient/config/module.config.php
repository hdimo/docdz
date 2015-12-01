<?php

/**
 * Generated by ZF2ModuleCreator
 */

return [

    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],

    'controllers' => [
        "invokables"=> [
            'Patient\Controller\Index'=>Patient\Controller\IndexController::class,
            'Patient\Controller\New'=>Patient\Controller\NewController::class,
            'Patient\Controller\List'=>Patient\Controller\ListController::class,
            'Patient\Controller\AddConsultation'=>Patient\Controller\AddConsultationController::class,
            'Patient\Controller\PatientDetail'=>Patient\Controller\PatientDetailController::class,
        ],
    ],

    'service_manager' => [
        'factories'=>[
            Patient\Service\PatientService::class=>Patient\Service\PatientService::class,
            Patient\Service\QueueService::class=>Patient\Service\QueueService::class,
            Patient\Service\ConsultationService::class=>Patient\Service\ConsultationService::class,
        ]
    ],

    'router' => [
        'routes' => [
            'patient' => [
                'type' => 'Literal',
                'options' => [
                    'route' => '/patient',
                    'defaults' => [
                        '__NAMESPACE__' => 'Patient\Controller',
                        'controller' => 'Index',
                        'action' => 'index',
                    ]
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'default' => [
                        'type' => 'Segment',
                        'options' => [
                            'route' => '/[:controller[/:action]]',
                            'constraints' => [
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ]
                        ]
                    ]
                ]
            ]
        ],

    ]
];