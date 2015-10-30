<?php
/**
 * Created by PhpStorm.
 * User: khaled
 * Date: 10/30/15
 * Time: 5:13 PM
 */

namespace Patient\Controller;

use Patient\Form\NewPatientForm;
use Zend\View\Model\ViewModel;

class NewController extends PatientBaseController
{

    public function indexAction(){
        $form = new NewPatientForm();


        $var = [
            'form'=>$form
        ];
        $view = new ViewModel();
    }

    public function processAction(){

    }

}