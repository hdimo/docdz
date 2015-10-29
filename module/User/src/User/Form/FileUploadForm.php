<?php
/**
 * User: khaled
 * Date: 6/2/15 at 11:16 AM
 */

namespace User\Form;


use Zend\Form\Form;
use Zend\Validator\File\MimeType;

class FileUploadForm extends Form{

    public function __construct($name = null){

        parent::__construct('fileUpload');

        $this->add([
            'name'=>'filename',
            'attributes'=> [
                'type'=>'text',
            ],
        ]);

        $this->add([
            'name'=>'file',
            'attributes'=> [
                'type'=>'file',
                'required'=>'true',
            ],
            'validators' => [
                [
                    'name' => 'Zend\Validator\File\Size',
                    'options' => [
                        'min' => '100KB',
                        'max' => '2MB',
                    ],
                ],
                [
                    'name' => 'Zend\Validator\File\IsImage',
                ],
            ],
        ]);

    }

}