<?php
/**
 * User: khaled
 * Date: 12/1/15 at 10:02 AM
 */

namespace Patient\Controller;


use Zend\View\Model\ViewModel;

class ConsultationDetailController extends PatientBaseController
{

    public function indexAction()
    {
        $consultationId = (int)$this->params()->fromQuery('consultationId');
        $consultationService = $this->getServiceLocator()->get(\Patient\Service\ConsultationService::class);
        $consultation = $consultationService->getbyId($consultationId);
        if($consultation){
            $viewModel = new ViewModel();
            $viewModel->setVariables([
                'consultation'=>$consultation
            ]);
            return $viewModel;
        }else{
            $response = $this->getResponse()->setStatusCode(Response::STATUS_CODE_404);
            return $response;
        }
    }
}