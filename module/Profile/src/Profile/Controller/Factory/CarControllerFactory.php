<?php
/**
 * User: khaled
 * Date: 6/7/15 at 11:04 AM
 */

namespace Profile\Controller\Factory;


use Profile\Controller\MycarController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class CarControllerFactory implements FactoryInterface{

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $event = $serviceLocator->get('eventManager');
        $ctrl = new MycarController();
        $params = $ctrl->getParams()->fromRoute();
    }

}