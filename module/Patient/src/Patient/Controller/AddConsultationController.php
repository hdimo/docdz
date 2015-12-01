<?php
/**
 * User: khaled
 * Date: 11/25/15 at 3:18 PM
 */

namespace Patient\Controller;


use Patient\Form\ConsultationForm;

class AddConsultationController extends PatientBaseController
{
    public function indexAction()
    {
        $data  = $this->params()->fromPost();
        $form = new ConsultationForm();
        $form->setData($data);
        if($form->isValid()){

            //TODO check if the patient is not exist on the today queue

            $consultationService = $this->getServiceLocator()->get(\Patient\Service\ConsultationService::class);
            $consultationService->add($data);
            $queueService = $this->getServiceLocator()->get(\Patient\Service\QueueService::class);
            $queueService->update($data['currentId'], ['isWaiting'=>0]);
            $this->redirect()->toRoute('patient/default', ['controller'=>'index']);
        }
        return false;
    }
}