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
                    '1' => 'Male',
                    '0' => 'Female',
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

        $this->add([
            'name'=>'birthyear',
            'type'=>'Text',
            'options' => [
                'label' => 'BirthYear',
            ],
            'attributes'=> [
                'required'=>'required',
                'placeholder'=>"example : 1988"
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
            'wordLen' => 3,
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