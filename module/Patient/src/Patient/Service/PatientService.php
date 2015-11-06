<?php
/**
 * Created by PhpStorm.
 * User: khaled
 * Date: 11/6/15
 * Time: 11:44 AM
 */

namespace Patient\Service;


use Application\Entity\Patient;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class PatientService implements FactoryInterface
{

    protected $serviceManager;
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


    }


}