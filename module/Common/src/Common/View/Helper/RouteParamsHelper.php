<?php
/**
 * User: khaled
 * Date: 7/27/15 at 11:46 AM
 */

namespace Common\View\Helper;

use Zend\View\Helper\AbstractHelper;

class RouteParamsHelper extends AbstractHelper
{

    protected $params = [];
    protected $matchedRoute;

    public function __construct($routeMatch){
        $this->matchedRoute = $routeMatch;
        $this->params = [
            "routeName"=> $this->matchedRoute->getMatchedRouteName(),
            "controller"=>$routeMatch->getParam('controller'),
            "action"=>$routeMatch->getParam('action'),
        ];
    }

    public function __invoke(){
        return $this->matchedRoute->getMatchedRouteName();
    }
}