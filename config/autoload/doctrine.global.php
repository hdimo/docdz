<?php
/**
 * Created by PhpStorm.
 * User: khaled
 * Date: 4/15/15
 * Time: 9:58 AM
 */

$credential = [
    "username"=>"root",
    "password"=>"root",
    "dbname"=>"docdz"
];

return [
    'doctrine' => [
        'connection' => [
            // default connection name
            'orm_default' => [
                'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
                'params' => [
                    'host'     => 'localhost',
                    'port'     => '3306',
                    'user'     => $credential['username'],
                    'password' => $credential['password'],
                    'dbname'   => $credential['dbname'],
                    'charset'  => "utf8"
                ],
            ],
        ],
    ],
];
