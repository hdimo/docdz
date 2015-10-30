<?php
/**
 * Created by PhpStorm.
 * User: khaled
 * Date: 03/03/15
 * Time: 15:35
 */

namespace Common;


use Zend\Mvc\MvcEvent;

class Module {

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }


    public function getAutoloaderConfig()
    {
        return [
            'Zend\Loader\StandardAutoloader' => [
                'namespaces' => [
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__
                ],
            ],
        ];
    }

    /**
     * @param Zend\Mvc\MvcEvent $e
     */
    public function onBootstrap($e){

        /*
        $app = $e->getTarget();
        $serviceManager  = $app->getServiceManager();
        $eventManager = $app->getEventManager();
        $eventManager->attach(\Zend\Mvc\MvcEvent::EVENT_DISPATCH, [
            $serviceManager->get('Common\Listeners\Authorization'), 'authorize']
        );

        $serviceManager->get('viewhelpermanager')->setFactory('RouteParamsHelper', function($sm) use ($e) {
            $viewHelper = new \Common\View\Helper\RouteParamsHelper($e->getRouteMatch());
            return $viewHelper;
        });
        */

    }
}