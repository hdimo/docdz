<?php
/**
 * Created by PhpStorm.
 * User: khaled
 * Date: 10/30/15
 * Time: 1:58 PM
 */

namespace Patient\Controller;


use Zend\Mvc\Controller\AbstractActionController;

class PatientBaseController extends AbstractActionController
{




    protected function getEntityManager(){
        return $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
    }

}