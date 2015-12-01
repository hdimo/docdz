<?php
/**
 * User: khaled
 * Date: 12/1/15 at 9:39 AM
 */

namespace Patient\Controller;

use Zend\Http\PhpEnvironment\Response;
use Zend\View\Model\ViewModel;

class PatientDetailController extends PatientBaseController
{
    public function indexAction()
    {
        $patientId = (int)$this->params()->fromQuery('patientId');
        $patientService = $this->getServiceLocator()->get(\Patient\Service\PatientService::class);
        $patient = $patientService->getbyId($patientId);
        if($patient){
            $viewModel = new ViewModel();
            $viewModel->setVariables([
                'patient'=>$patient
            ]);
            return $viewModel;
        }else{
            $response = $this->getResponse()->setStatusCode(Response::STATUS_CODE_404);
            return $response;
        }
    }
}