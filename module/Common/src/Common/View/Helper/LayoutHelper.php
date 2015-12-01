<?php
/**
 * User: khaled
 * Date: 6/3/15 at 9:19 AM
 */

namespace Common\View\Helper;

use Zend\Mvc\Router\RouteMatch;
use Zend\View\Model\ViewModel;

class LayoutHelper extends \Zend\View\Helper\AbstractHelper
{

    protected $routeMatched;
    protected $params;

    public function __construct(RouteMatch $route)
    {
        $this->routeMatched = $route;
        $this->extractParams();
    }

    /**
     * add template to action view
     *
     * @param string $layoutName
     * @return ViewModel
     */
    public function __invoke($layoutName)
    {
        $view = new ViewModel();
        switch ($layoutName) {
            case 'profile':
                $view->setTemplate('layout/profile');
                break;
            case 'booking':
                $view->setTemplate('layout/booking');
        }
        $view->setVariable('controllerName', $this->getControllerName());
        return $view;
    }

    /**
     * get controller name
     *
     * @return string
     */
    public function getControllerName()
    {
        $v = explode('\\', $this->controller);
        return array_pop($v);
    }

    public function getMatchedRouteName(){
        return $this->params['routeName'];
    }

    /**
     * get properties if exist in params
     *
     * @param $key
     * @return null
     */
    public function __get($key)
    {
        if (isset($this->params[$key]))
            return $this->params[$key];
        return null;
    }

    /**
     * extract params from matchedRoute into array
     *
     * @return array
     */
    protected function extractParams()
    {
        return $this->params = [
            'controller' => $this->routeMatched->getParam('controller', 'index'),
            'action' => $this->routeMatched->getParam('action', 'index'),
            'routeName' => $this->routeMatched->getMatchedRouteName(),
        ];
    }

}