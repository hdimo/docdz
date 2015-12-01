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
 * @ORM\Entity(repositoryClass="Application\Entity\Repository\QueueRepository")
 */
class Queue
{ use TimestampTrait;

    const DATE_FORMAT = "Y-m-d";

    const WAITING_TRUE = 1;
    const WAITING_FALSE = 0;

    /**
     * @ORM\Column(type="smallint", options={"default":1})
     */
    protected $isWaiting;

    /**
     * @ORM\Column(type="date")
     */
    protected $workedDay;

    /**
     * @ORM\ManyToOne(targetEntity="Application\Entity\Patient")
     */
    protected $patient;

    public function __construct(){
        $this->createdDate = new \DateTime();
        $this->workedDay = new \DateTime();;
    }

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

    /**
     * @return mixed
     */
    public function isWaiting()
    {
        return $this->isWaiting;
    }

    /**
     * @param $isWaiting
     * @return $this
     */
    public function setIsWaiting($isWaiting)
    {
        if($isWaiting){
            $this->isWaiting = self::WAITING_TRUE;
        }else{
            $this->isWaiting = self::WAITING_FALSE;
        }
        return $this;
    }

    /**
     * @return mixed
     */
    public function getWorkedDay()
    {
        return $this->workedDay;
    }

    /**
     * @param mixed $workedDay
     */
    public function setWorkedDay($workedDay)
    {
        $this->workedDay = $workedDay;
    }
    
}