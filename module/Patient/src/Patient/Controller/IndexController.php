<?php
/**
 * Created by PhpStorm.
 * User: khaled
 * Date: 10/30/15
 * Time: 4:12 PM
 */

namespace Patient\Controller;


use Patient\Form\ConsultationForm;
use Zend\View\Model\ViewModel;

class IndexController extends PatientBaseController
{

    /**
    * Display current patient
    */
    public function indexAction()
    {
        $queueService = $this->getServiceLocator()->get(\Patient\Service\QueueService::class);
        $current = $queueService->getNext();
        $consultationForm = new ConsultationForm();
        return new ViewModel([
            'current'=>$current,
            'form'=>$consultationForm,
        ]);
    }

    /**
     * add new consultation to specific patient
     */
    public function processAction(){
        $data  = $this->params()->fromPost();
        $form = new ConsultationForm();
        $form->setData($data);
        if($form->isValid()){
        }
    }

    /**
     * display list of patient
     */
    public function listAction(){
        $patientService = $this->getServiceLocator()->get(\Patient\Service\PatientService::class);
        $listPatient = $patientService->getListByName();
        return new ViewModel([
            'listPatient'=>$listPatient,
        ]);
    }
}