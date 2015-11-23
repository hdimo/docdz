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

    public function indexAction()
    {
        $queueService = $this->getServiceLocator()->get(\Patient\Service\QueueService::class);
        $current = $queueService->getNext();
        $patient = $current->getPatient();

        $lastname = $patient->getLastname();

        $consultationForm = new ConsultationForm();

        return new ViewModel([
            'patient'=>$patient,
            'consultationForm'=>$consultationForm,
        ]);
    }

}