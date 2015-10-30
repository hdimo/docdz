<?php
/**
 * Created by PhpStorm.
 * User: khaled
 * Date: 10/30/15
 * Time: 5:14 PM
 */

namespace Patient\Form;

use Zend\Form\Form;

class NewPatientForm extends Form
{
    public function __construct($name=null){
        parent::__construct('register');

        $this->add([
            'name'=>'gender',
            'type'=>'Zend\Form\Element\Select',
            'options' => [
                'label' => 'Genre',
                'value_options' => [
                    'm' => 'Male',
                    'f' => 'Female',
                ],
            ],
            'attributes'=> [
                'required'=>'required',
            ],
        ]);

        $this->add([
            'name'=>'lastname',
            'attributes'=> [
                'required'=>'required',
                'type'=>'text',
            ],
        ]);

        $this->add([
            'name'=>'firstname',
            'attributes'=> [
                'required'=>'required',
                'type'=>'text',
            ],
        ]);

        $this->add([
            'name'=>'phone',
            'required'=>true,
            'attributes'=> [
                'required'=>'required',
                'type'=>'text',
            ],
        ]);

        $minBirthYear = (int)date('Y') - 60;
        $maxBirthYear = (int)date('Y') - 18;
        $year = range($minBirthYear, $maxBirthYear);
        $this->add([
            'name'=>'birthyear',
            'type'=>'Zend\Form\Element\Select',
            'options' => [
                'label' => 'BirthYear',
                'value_options' => $year,
            ],
            'attributes'=> [
                'required'=>'required',
            ],
        ]);
    }
}