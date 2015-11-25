<?php
/**
 * User: khaled
 * Date: 11/24/15 at 8:55 AM
 */

namespace Patient\Service;


use Application\Entity\Consultation;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ConsultationService implements FactoryInterface
{

    protected $em;

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $this->em = $serviceLocator->get('Doctrine\ORM\EntityManager');
        return $this;
    }

    public function add(array $data)
    {
        $patientId = $data['patientId'];
        $patient  = $this->em->find('Application\Entity\Patient', $patientId);

        $consultation = new Consultation();
        $consultation->setTitle($data['title']);
        $consultation->setDescription($data['description']);
        $consultation->setPatient($patient);
        $this->em->persist($consultation);
        $this->em->flush();
        return $consultation->getId();

    }


}