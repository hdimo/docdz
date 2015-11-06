<?php
/**
 * Created by PhpStorm.
 * User: khaled
 * Date: 10/31/15
 * Time: 6:22 PM
 */

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Patient
 * @ORM\Entity
 */
class Queue
{ use TimestampTrait;

    /**
     * @ORM\ManyToOne(targetEntity="Application\Entity\Patient")
     */
    protected $patient;

    /**
     * @return mixed
     */
    public function getPatient()
    {
        return $this->patient;
    }

    /**
     * @param mixed $patient
     */
    public function setPatient($patient)
    {
        $this->patient = $patient;
    }
    
}