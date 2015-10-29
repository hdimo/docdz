<?php
/**
 * Created by PhpStorm.
 * User: khaled
 * Date: 10/24/15
 * Time: 7:44 PM
 */

namespace Application\Entity;


trait TimestampTrait
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;


    /**
     * @ORM\Column(type="integer")
     */
    protected $createdDate;

    /**
     * @return mixed
     */
    public function getCreatedDate()
    {
        return $this->createdDate;
    }

    /**
     * @param mixed $createdDate
     */
    public function setCreatedDate($createdDate)
    {
        $this->createdDate = $createdDate;
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }



}