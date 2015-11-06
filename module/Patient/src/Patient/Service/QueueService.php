<?php
/**
 * Created by PhpStorm.
 * User: khaled
 * Date: 11/6/15
 * Time: 11:59 AM
 */

namespace Patient\Service;


use Application\Entity\Patient;
use Application\Entity\Queue;
use Doctrine\ORM\EntityManager;
use Zend\I18n\Validator\DateTime;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class QueueService implements FactoryInterface
{
    protected $serviceManager;

    /**
     * @var EntityManager
     */
    protected $em;

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceManager = $serviceLocator;
        $this->em = $serviceLocator->get('Doctrine\ORM\EntityManager');
        return $this;
    }

    public function push($patientId)
    {
        $patient = $this->em->find('Application\Entity\Patient', $patientId);
        $rowOfQueue = new Queue();
        $rowOfQueue->setPatient($patient);
        $rowOfQueue->setIsWaiting(true);
        $this->em->persist($rowOfQueue);
        $this->em->flush();
    }

    public function getAll(array $params){

    }

    public function getListOfToday(){
        $list = $this->em->getRepository('Application\Entity\Queue')->getListOfToday();
        return $list;
    }


}