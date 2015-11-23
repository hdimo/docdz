<?php
/**
 * Created by PhpStorm.
 * User: khaled
 * Date: 11/6/15
 * Time: 4:28 PM
 */

namespace Patient\Controller;


use Zend\View\Model\ViewModel;

class ListController extends PatientBaseController
{

    public function indexAction(){
        $queueService = $this->getServiceLocator()->get(\Patient\Service\QueueService::class);
        $todayList = $queueService->getListOfToday();
        $view = new ViewModel([
            'listPatients'=>$todayList,
        ]);
        return $view;

    }

    public function addtolistAction(){
        $patientId = $this->params()->fromPost('patientId');
        if($patientId) {
            $queueService = $this->getServiceLocator()->get(\Patient\Service\QueueService::class);
            $queueService->push($patientId);
        }
        $this->redirect()->toRoute('patient/default', ['controller'=>'list']);
    }

    public function ajaxlistAction(){
        $q = $this->params()->fromQuery('q');
        $patientService =  $this->getServiceLocator()->get(\Patient\Service\PatientService::class);
        $listPatient = $patientService->getListByName($q);
        print(json_encode($listPatient));
        return $this->response;
    }


}