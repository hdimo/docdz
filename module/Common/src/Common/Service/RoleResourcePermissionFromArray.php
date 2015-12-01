<?php
/**
 * User: khaled
 * Date: 7/16/15 at 11:34 AM
 */

namespace Common\Service;


use Common\Listeners\Authorization;

class RoleResourcePermissionFromArray implements RoleResourcePermissionInterface
{
    public function getListRoleResourcePermission()
    {
        return [
            Authorization::DEFAULT_ROLE => [
                ['resource' => 'Application\Controller\Index', 'permission' => ['index']],
                ['resource' => 'Contact\Controller\Index', 'permission' => ['index']],
                ['resource' => 'User\Controller\Login', 'permission' => ['index', 'process']],
                ['resource' => 'User\Controller\Register', 'permission' => ['index', 'process']],
                ['resource' => 'Traject\Controller\Traject', 'permission' => ['index']],
                ['resource' => 'Traject\Controller\List', 'permission' => ['index']],
                ['resource' => 'Traject\Controller\Detail', 'permission' => ['index']],
                ['resource' => 'Traject\Controller\Manage', 'permission' => ['new', 'step-two', 'success']],
            ],
            Authorization::USER_ROLE => [
                ['resource' => 'Board\Controller\Index', 'permission' => ['index']],

                ['resource' => 'Profile\Controller\Index', 'permission' => ['index', 'process']],
                ['resource' => 'Profile\Controller\Changepwd', 'permission' => ['index', 'process']],
                ['resource' => 'Profile\Controller\Mycar', 'permission' => ['index', 'process']],
                ['resource' => 'Profile\Controller\Photo', 'permission' => ['index', 'process']],
                ['resource' => 'Profile\Controller\Verification', 'permission' => ['index', 'process']],

                ['resource' => 'Booking\Controller\Index', 'permission' => ['index']],

                ['resource' => 'Traject\Controller\UserList', 'permission' => ['index']],
                ['resource' => 'Traject\Controller\Update', 'permission' => ['index', 'process']],


            ],

        ];
    }


}