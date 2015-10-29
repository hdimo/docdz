<?php
/**
 * User: khaled
 * Date: 7/27/15 at 10:18 AM
 */

namespace Board\View\Helper;


use Zend\Mvc\Router\RouteMatch;
use Zend\View\Helper\AbstractHelper;

class MatchedRoute extends AbstractHelper
{

    protected $routeMatch;

    public function __construct($routeMatch)
    {
        $this->routeMatch = $routeMatch;
    }

    public function __invoke()
    {
        if ($this->routeMatch) {
            $controller = $this->routeMatch->getParam('controller', 'index');
            return $controller;
        }
    }


}