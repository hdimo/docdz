<?php
/**
 * Created by PhpStorm.
 * User: khaled
 * Date: 10/30/15
 * Time: 4:12 PM
 */

namespace Patient\Controller;


use Zend\View\Model\ViewModel;

class IndexController extends PatientBaseController
{

    public function indexAction()
    {
        return new ViewModel();
    }

}