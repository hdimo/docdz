<?php
/**
 * Created by PhpStorm.
 * User: khaled
 * Date: 06/04/15
 * Time: 19:55
 */

namespace Application\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Consultation {
    use TimestampTrait;

    /**
     * @ORM\Column(type="string")
     */
    protected $title;

    /**
     * @ORM\Column(type="string")
     */
    protected $description;


    /*RELATIONS*/
    /**
     * @ORM\OneToMany(targetEntity="Application\Entity\File", mappedBy="consultation")
     */
    protected $files;

    /**
     * @ORM\ManyToOne(targetEntity="Application\Entity\Patient", inversedBy="consultations")
     */
    protected $patient;

    public function __construct(){
        $this->files = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getFiles()
    {
        return $this->files;
    }

    /**
     * @param mixed $files
     */
    public function addFiles($files)
    {
        $this->files[] = $files;
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
}