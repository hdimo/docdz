<?php
/**
 * Created by PhpStorm.
 * User: khaled
 * Date: 11/6/15
 * Time: 11:44 AM
 */

namespace Patient\Service;


use Application\Entity\Patient;
use Doctrine\ORM\EntityManager;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class PatientService implements FactoryInterface
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

    public function save(array $data)
    {
        $patient = new Patient();
        $patient->setLastname($data['lastname']);
        $patient->setFirstname($data['firstname']);
        $patient->setGender($data['gender']);
        $patient->setBirthYear($data['birthyear']);
        $patient->setAddress($data['address']);
        $patient->setPhone($data['phone']);
        $this->em->persist($patient);
        $this->em->flush();
        return $patient->getId();
    }

    public function getListByName($patientName)
    {
        $patientRepo = $this->em->getRepository('Application\Entity\Patient');
        return $patientRepo->getList($patientName);
    }

    public function getById($id){
        $patient = $this->em->find('Application\Entity\Patient', $id);
        return $patient;
    }
}