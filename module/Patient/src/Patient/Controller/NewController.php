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
    public function indexAction()
    {
        $form = new NewPatientForm();
        $var = [
            'form' => $form,
        ];
        $view = new ViewModel($var);
        return $view;
    }

    public function processAction()
    {
        $view = new ViewModel();
        $view->setTemplate('patient/new/index');

        $data = $this->params()->fromPost();
        $form = new NewPatientForm();
        $form->setData($data);
        if ($form->isValid()) {
            $lastInsertedPatientId = $this->serviceLocator->get(\Patient\Service\PatientService::class)
                ->save($data);

            $inserted = $this->getServiceLocator()->get(\Patient\Service\QueueService::class)
                ->push($lastInsertedPatientId);

            $options = [];
            if(!$inserted){
                $options = ['errorUserExist'=>true];
            }
            $this->redirect()->toRoute('patient/default', ['controller' => 'new', 'action' => 'success'], $options);
        }

        $view->setVariables([
            'form' => $form,
        ]);
        return $view;
    }

    public function successAction()
    {
       return new ViewModel();
    }

}