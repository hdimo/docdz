<?php
/**
 * Created by PhpStorm.
 * User: khaled
 * Date: 03/04/15
 * Time: 19:13
 */

namespace Application\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Zend\Mvc\Application;

/**
 * Class User
 * @ORM\Entity
 */
class User {
    use TimestampTrait;

    const GENDER_MALE = "m";
    const GENDER_FEMALE = "f";

    const ROLE_USER = 'u';

    const VALUE_TRUE = 1;
    const VALUE_FALSE = 0;


    /**
     * @ORM\Column(type="string")
     */
    protected $lastname;

    /**
     * @ORM\Column(type="string")
     */
    protected $firstname;

    /**
     * @ORM\Column(type="string")
     */
    protected $gender;

    /**
     * @ORM\Column(type="string", options={"default" = "u"})
     */
    protected $role;

    /**
     * @ORM\Column(type="string", options={"default"="no-image.jpg"}, nullable=true)
     */
    protected $image;

    /**
     * @ORM\Column(type="string")
     */
    protected $password;

    /**
     * @ORM\Column(type="integer")
     */
    protected $lastLogin;

    /*RELATIONS*/



    /*METHODS*/
    public function __construct(){

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
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param mixed $role
     */
    public function setRole($role=null)
    {
        if(!$role)
            $this->role = self::ROLE_USER;
        else
            $this->role = $role;
    }

    /**
     * @return mixed
     */
    public function getGender()
    {
        return $this->gender;
    }

    public function getGenderByName(){
        $gender = [
            'm'=>'male',
            'f'=>'female',
        ];
        return $gender[$this->gender];
    }

    /**
     * @param mixed $gender
     */
    public function setGender($gender)
    {
        if($gender = 'f'){
            $this->gender = self::GENDER_MALE;
        }else{
            $this->gender = self::GENDER_MALE;
        }
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
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = sha1($password);
    }



}