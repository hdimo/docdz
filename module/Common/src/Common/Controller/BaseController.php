<?php
/**
 * Created by PhpStorm.
 * User: khaled
 * Date: 4/22/15
 * Time: 10:06 AM
 */

namespace Common\Controller;


use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class BaseController extends AbstractActionController{

    /**
     * @var ViewModel
     */
    public $actionView;

    public function __construct(){
        $this->actionView = new ViewModel();
    }

}