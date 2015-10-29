<?php
/**
 * Created by PhpStorm.
 * Date: 27/02/15
 * Time: 15:31
 */

namespace Application\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

use Application\Controller\IndexController;

class IndexControllerFactory implements FactoryInterface{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $indexController = new IndexController();
        return $indexController;
    }

}