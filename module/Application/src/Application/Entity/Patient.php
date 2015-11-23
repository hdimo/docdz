<?php
/**
 * User: khaled
 * Date: 6/4/15 at 9:01 AM
 */

namespace Application\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;


/**
 * Class Patient
 * @ORM\Entity
 */
class Patient {
    use TimestampTrait;

    const MALE = 1;
    const FEMALE = 0;

    private $_gendersName = [
        self::MALE => 'homme',
        self::FEMALE => 'femme',
    ];

    /**
     * @ORM\Column(type="string")
     */
    protected $lastname;

    /**
     * @ORM\Column(type="string")
     */
    protected $firstname;

    /**
     * @ORM\Column(type="integer")
     */
    protected $gender;

    /**
     * @ORM\Column(type="integer")
     */
    protected $birthYear;

    /**
     * @ORM\Column(type="string")
     */
    protected $phone;

    /**
     * @ORM\Column(type="string")
     */
    protected $address;

    /*RELATIONS*/
    /**
     * @ORM\OneToMany(targetEntity="Application\Entity\Consultation", mappedBy="patient")
     */
    protected $consultations;

    public function __construct(){
        $this->consultations = new ArrayCollection();
        $this->createdDate = new \DateTime();
    }

    /**
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param mixed $lastname
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    /**
     * @return mixed
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param mixed $firstname
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     * @return mixed
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param mixed $gender
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    public function getGenderByName(){
        return $this->_gendersName[$this->getGender()];
    }

    /**
     * @return mixed
     */
    public function getBirthYear()
    {
        return $this->birthYear;
    }

    /**
     * @param mixed $birthYear
     */
    public function setBirthYear($birthYear)
    {
        $this->birthYear = $birthYear;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return mixed
     */
    public function getConsultations()
    {
        return $this->consultations;
    }

    /**
     * @param mixed $consultations
     */
    public function setConsultations($consultations)
    {
        $this->consultations[] = $consultations;
    }
    
}