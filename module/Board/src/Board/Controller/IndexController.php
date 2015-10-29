<?php
/**
 * Created by PhpStorm.
 * User: khaled
 * Date: 4/21/15
 * Time: 9:41 AM
 */

namespace Board\Controller;


use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController {

    public function indexAction(){
        return new ViewModel();
    }

}