<?php
/**
 * Created by PhpStorm.
 * User: khaled
 * Date: 14/03/15
 * Time: 17:20
 */

return [

    'doctrine' => [
        'authentication' => [
            'orm_default' => [
                'object_manager' => 'Doctrine\ORM\EntityManager',
                'identity_class' => 'Application\Entity\User',
                'identity_property' => 'email',
                'credential_property' => 'password',
                'credential_callable' => function(\Application\Entity\User $user, $passwordGiven) {
                    return $user->getPassword() === sha1($passwordGiven);
                },
            ],
        ],
    ],

    "router"=> [
        "routes"=> [
            "user"=> [
                "type"=>"Segment",
                "options"=> [
                    'route'=>'/user[/:controller[/:action]]',
                    "defaults"=> [
                        '__NAMESPACE__' => 'User\Controller',
                        'controller'=>'Login',
                        'action'=>'index'
                    ],
                ],
            ],

            "oauth"=> [
                "type"=>"Segment",
                "options"=> [
                    'route'=>'/oauth[/:type]',
                    "defaults"=> [
                        '__NAMESPACE__' => 'User\Controller',
                        'controller'=>'Oauth',
                        'action'=>'index'
                    ],
                ],
            ],


        ],

    ],

    "controllers"=> [
        "invokables"=> [
            'User\Controller\Login'=>'User\Controller\LoginController',
            'User\Controller\Register'=>'User\Controller\RegisterController',
            'User\Controller\Oauth'=>'User\Controller\OauthController',
        ],
    ],

    'service_manager'=> [
        'abstract_factories'=> [
            'User\Service\AbstractFactory\OauthAbstractFactory',
        ],
    ],

    "view_manager"=> [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ]

];