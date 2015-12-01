<?php
/**
 * Created by PhpStorm.
 * User: khaled
 * Date: 03/03/15
 * Time: 15:30
 */

namespace Common\Listeners;

use Common\Service\RoleResourcePermissionFromArray;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\AbstractListenerAggregate;

use Zend\Mvc\MvcEvent;

use Zend\Permissions\Acl\Acl;
use Zend\Permissions\Acl\Role\GenericRole as Role;
use Zend\Permissions\Acl\Resource\GenericResource as Resource;

class Authorization extends AbstractListenerAggregate
{


    const DEFAULT_ROLE = 'g';
    const USER_ROLE = 'u';
    const ADMIN_ROLE = 'a';


    protected $eventManager;

    /**
     * @var Acl
     */
    protected $acl;

    /**
     * Attach one or more listeners
     * Implementors may add an optional $priority argument; the EventManager
     * implementation will pass this to the aggregate.
     *
     * @param EventManagerInterface $events
     * @return void
     */

    public function __construct()
    {
        $this->acl = new Acl();
    }


    public function attach(EventManagerInterface $events)
    {

        $this->listeners[] = $events->attach(
            MvcEvent::EVENT_RENDER,
            function ($e) {
                $this->authorize($e);
            }
        );
        return $this;
    }

    /**
     * check authorized role for specific resources
     * @param MvcEvent $e
     */
    public function authorize(MvcEvent $e)
    {

        $application = $e->getApplication();
        $serviceManger = $application->getServiceManager();

        $authenticationService = $serviceManger->get('Zend\Authentication\AuthenticationService');
        $loggedUser = $authenticationService->getIdentity();
        $role = (!$loggedUser) ? self::DEFAULT_ROLE : $loggedUser->getRole();

        //get current resource
        $routeMatch = $e->getRouteMatch();
        $routeName = $routeMatch->getMatchedRouteName();
        $controller = $routeMatch->getParam('controller', 'not-found');
        $action = $routeMatch->getParam('action');
        $this->acl = $this->setAcl();
        $isAllowed =  $this->acl->isAllowed($role, $controller, $action);

        if(!$isAllowed){
            $response  = $e->getResponse();
            $response->setStatusCode(404);
        }

        return $isAllowed;

    }

    /**
     * set Roles and Resource for ACL
     *
     * @return Acl
     */

    protected function setAcl()
    {

        $guestRole = new Role(self::DEFAULT_ROLE);
        $userRole = new Role(self::USER_ROLE);
        $adminRole = new Role(self::ADMIN_ROLE);

        $this->acl->addRole($guestRole);
        $this->acl->addRole($userRole, $guestRole);
        $this->acl->addRole($adminRole, $userRole);

        $roleResource = new RoleResourcePermissionFromArray();
        $roles = $roleResource->getListRoleResourcePermission();

        foreach ($roles as $role=>$resources) {
            //adding resources
            foreach ($resources as $resource) {
                if (!$this->acl->hasResource($resource['resource']))
                    $this->acl->addResource(new Resource($resource['resource']));

                if(count($resource['permission']) > 0)
                    $this->acl->allow($role, $resource['resource'], $resource['permission']);
            }
        }

        return $this->acl;
    }
}