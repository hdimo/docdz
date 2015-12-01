<?php
/**
 * Created by PhpStorm.
 * User: khaled
 * Date: 4/22/15
 * Time: 10:28 AM
 */

namespace Common\Controller\Plugin;


use Zend\Mvc\Controller\Plugin\AbstractPlugin;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class GetUser extends AbstractPlugin
{
    public function __construct()
    {
        $serviceLocator = $this->getController()->getServiceLocator();
        $auth = $serviceLocator->get('Zend\Authentication\AuthenticationService');
        return $auth->getStorage()->read();
    }

}