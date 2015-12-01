<?php


class DetailController extends PatientBaseController
{

    public function indexAction(){

        $patientId = $this->params()->fromQuery('patientId');

        if(!$patientId){

          $patientService = $this->getServiceLocator('Patient\Service\PatientService');
          $patient = $patientService->getPatient($patientId);

          $viewModel = new ViewModel();


        }else{
          $this->getResponse()->setStatusCode(404);
          return;
        }

    }

}
