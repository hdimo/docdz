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

    /**
     * display list of patient (Queue)
     *
     * @return ViewModel
     */
    public function indexAction()
    {
        $queueService = $this->getServiceLocator()->get(\Patient\Service\QueueService::class);

        $todayList = $queueService->getListOfToday(['isWaiting' => 1]);
        $nbrWaitingPatient = count($todayList);
        $listPatientTreated = $queueService->getListOfToday(['isWaiting' => 0]);
        $nbrTreatedPatient = count($listPatientTreated);

        $view = new ViewModel([
            'listPatients' => $todayList,
            'listPatientTreated' => $listPatientTreated,
            'nbrWaiting' => $nbrWaitingPatient,
            'nbrTreated' => $nbrTreatedPatient,
        ]);
        //in case when is redirected from new user add
        $error = $this->params()->fromRoute('errorUserExist');
        $view->setVariable('errorUserExist', $error);
        return $view;
    }


    /**
     * add / remove patient to list
     */
    public function addtolistAction()
    {
        $patientId = $this->params()->fromPost('patientId');
        $rowId = $this->params()->fromQuery('rowId');
        $action = $this->params()->fromQuery('action');
        if ($patientId || $rowId) {
            $queueService = $this->getServiceLocator()->get(\Patient\Service\QueueService::class);
            if ($action == 'remove') {
                $queueService->remove($rowId);
            } else {
                $queueService->push($patientId);
            }
        }
        $this->redirect()->toRoute('patient/default', ['controller' => 'list']);
    }

    /**
     * @return list of patient name for autocomplete
     *
     * @return \Zend\Stdlib\ResponseInterface
     */
    public function ajaxlistAction()
    {
        $q = $this->params()->fromQuery('q');
        $patientService = $this->getServiceLocator()->get(\Patient\Service\PatientService::class);
        $listPatient = $patientService->getListByName($q);
        print(json_encode($listPatient));
        return $this->response;
    }


}