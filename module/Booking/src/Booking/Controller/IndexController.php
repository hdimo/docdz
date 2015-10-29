<?php
/**
 * User: khaled
 * Date: 7/27/15 at 9:54 AM
 */

namespace Booking\Controller;


use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{

    public function indexAction(){

        return new ViewModel();

    }

}