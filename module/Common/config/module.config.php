<?php
return [
    'service_manager' => [
        'invokables' => [
            'Common\Listeners\Authorization' => 'Common\Listeners\Authorization',
        ]
    ],

    'controller_plugins' => [
        'invokables' => [
           // 'GetUser' => 'Common\Controller\Plugin\GetUser',
        ],
    ],

    'view_helpers'=> [
        'invokables'=> [
            'displayMessage'=>'\Common\View\Helper\DisplayMessage',
            'mylayout_helper' => '\Common\View\Helper\LayoutHelper',
        ],
    ],

];