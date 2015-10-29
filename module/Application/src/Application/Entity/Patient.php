<?php
/**
 * User: khaled
 * Date: 6/4/15 at 9:01 AM
 */

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * Class Patient
 * @ORM\Entity
 */
class Patient {
    use TimestampTrait;

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
    protected $age;

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
    protected $consultation;

}