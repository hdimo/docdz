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
     * @ORM\ManyToOne(targetEntity="Application\Entity\Patient", inversedBy="consultation")
     */
    protected $patient;



    public function __construct(){
        $this->files = new ArrayCollection();
    }


}