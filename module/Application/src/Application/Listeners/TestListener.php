<?php
/**
 * Created by PhpStorm.
 * User: khaled
 * Date: 04/03/15
 * Time: 19:11
 */

namespace Application\Listeners;


use Zend\EventManager\AbstractListenerAggregate;
use Zend\EventManager\EventManagerInterface;

use Zend\Mvc\MvcEvent;

class TestListener extends AbstractListenerAggregate{



    /**
     * Attach one or more listeners
     *
     * Implementors may add an optional $priority argument; the EventManager
     * implementation will pass this to the aggregate.
     *
     * @param EventManagerInterface $events
     *
     * @return void
     */
    public function attach(EventManagerInterface $events)
    {
        // TODO: Implement attach() method.

        $this->listeners[] = $events->attach(MvcEvent::EVENT_ROUTE, [$this, 'onRoute'], $priority = 1);
    }

    public function onRoute(){
        $test = 'event catched';
    }

    public function onTest(){
        return 'test';
    }
}