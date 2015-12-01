<?php
/**
 * Created by PhpStorm.
 * User: khaled
 * Date: 06/04/15
 * Time: 22:44
 */

namespace User\Service;


use Zend\Authentication\AuthenticationService;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;


class Authenticate implements FactoryInterface{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        // TODO: Implement createService() method.
        $authenticationService = new AuthenticationService();
    }

}