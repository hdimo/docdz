<?php
/**
 * Created by PhpStorm.
 * User: khaled
 * Date: 10/30/15
 * Time: 5:13 PM
 */

namespace Patient\Controller;


use Application\Entity\Patient;
use Patient\Form\NewPatientForm;
use Zend\View\Model\ViewModel;

class NewController extends PatientBaseController
{

    public function indexAction(){
        $form = new NewPatientForm();


        $var = [
            'form'=>$form
        ];
        $view = new ViewModel($var);
        return $view;
    }

    public function processAction(){

        $view = new ViewModel();
        $view->setTemplate('patient/new/index');

        $form  = new NewPatientForm();
        $data = $this->params()->fromPost();

        $form->setData($data);

        if($form->isValid()){


        }
    }

    public function successAction(){

    }

}