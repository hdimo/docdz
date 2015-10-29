<?php
/**
 * Created by PhpStorm.
 * User: khaled
 * Date: 6/29/15
 * Time: 6:04 PM
 */

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Comment and question related to specific traject
 *
 * Class File
 * @ORM\Entity
 */
class File {
    use TimestampTrait;

    /**
     * @ORM\Column(type="string")
     */
    protected $filename;


    /*RELATIONS*/
    /**
     * @ORM\ManyToOne(targetEntity="Application\Entity\Consultation", inversedBy="files")
     */
    protected $consultation;

    public function __construct(){
        $this->createdDate = new \DateTime();

    }
}