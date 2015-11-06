<?php
/**
 * Created by PhpStorm.
 * User: khaled
 * Date: 10/30/15
 * Time: 5:14 PM
 */

namespace Patient\Form;

use Zend\Captcha\Figlet;
use Zend\Form\Form;
use Zend\Captcha\ReCaptcha;

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

        $this->add([
            'name'=>'address',
            'required'=>true,
            'attributes'=> [
                'required'=>'required',
                'type'=>'textarea',
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

        /*pass captcha image options (google recaptcha)
        $captcha = new ReCaptcha([
            'private_key'=>'6LeaH_ISAAAAAHl7oQoATqDW-mgUuhcu5FoM1lYe',
            'public_key'=>'6LeaH_ISAAAAAAYaTNGVGJYjYxrpAHCNW7Q76avX'
        ]);
        */

        $captcha = new Figlet(array(
            'name' => 'foo',
            'wordLen' => 6,
            'timeout' => 300,
        ));

        $this->add([
            'type' => 'Zend\Form\Element\Captcha',
            'name' => 'captcha',
            'options' => [
                'label' => 'Please verify you are human',
                'captcha' => $captcha,
            ],
            'attributes'=>[
                'placeholder'=>'Entrer le code',
            ],
        ]);

        foreach($this->getElements() as $element)
            $element->setAttribute('class', 'form-control');

    }
}