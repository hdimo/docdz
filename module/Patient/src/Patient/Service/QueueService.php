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

        //check if patient exist in today queue
        if(count($this->getList(['patient'=>$patientId])) > 0){
            return false;
        }
        $rowOfQueue = new Queue();
        $rowOfQueue->setPatient($patient);
        $rowOfQueue->setIsWaiting(true);
        $this->em->persist($rowOfQueue);
        $this->em->flush();
        return $rowOfQueue->getId();
    }

    public function getList(array $params = null)
    {
        $list = $this->em->getRepository('Application\Entity\Queue')->getList($params);
        return $list;
    }

    public function getListOfToday()
    {
        $list = $this->em->getRepository('Application\Entity\Queue')->getListOfToday();
        return $list;
    }

    public function getNext()
    {
        $current = $this->em->getRepository('Application\Entity\Queue')->getListOfToday();
        if($current)
            return $current[0];
        return $current;
    }

    public function update($queueId, $data)
    {
        $current = $this->em->find('Application\Entity\Queue', $queueId);
        if ($current) {
            foreach ($data as $property => $newValue) {
                $setter = 'set'.ucfirst($property);
                $current->$setter($newValue);
            }
            $this->em->persist($current);
            $this->em->flush();
            return $current->getId();
        }
        return false;
    }

    public function isExist(){

       // $this->em->getRepository('Application\Entity\Queue')->

    }


}