<?php
namespace User\Form;



use Zend\Form\Form;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterInterface;

use Zend\Captcha\ReCaptcha;

class RegisterForm extends Form
{
    protected $filter;

    public function __construct($name = null){
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
            'name'=>'email',
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
            'name'=>'password',
            'attributes'=> [
                'required'=>'required',
                'type'=>'password',
            ],
        ]);
        
        $this->add([
            'name'=>'confirm_password',
            'attributes'=> [
                'required'=>'required',
                'type'=>'password',
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


        //pass captcha image options
        $captcha = new ReCaptcha([
            'private_key'=>'6LeaH_ISAAAAAHl7oQoATqDW-mgUuhcu5FoM1lYe',
            'public_key'=>'6LeaH_ISAAAAAAYaTNGVGJYjYxrpAHCNW7Q76avX'
        ]);
        $this->add([
            'type' => 'Zend\Form\Element\Captcha',
            'name' => 'captcha',
            'options' => [
                'label' => 'Please verify you are human',
                'captcha' => $captcha,
            ],
        ]);




    }

    public function setInputFilter(InputFilterInterface $filter){
        throw new \Exception("not allowed");
    }

    public function getInputFilter(){

        if($this->filter == null){
            $this->filter = new InputFilter();

            $this->filter->add([
                "name"=>"firstname",
                "required"=>true,
                'validators'=> [
                    [
                        'name'=>'Alpha',
                        'options'=> [
                            "allowWhiteSpace"=>true
                        ],
                    ],
                    [
                        'name'    => 'StringLength',
                        'options' => [
                            'encoding' => 'UTF-8',
                            'min'      => 3,
                            'max'      => 50,
                        ],
                    ],

                ]
            ]);

            $this->filter->add([
                "name"=>"lastname",
                "required"=>true,
                'validators'=> [
                    [
                        'name'=>'Alpha',
                        'options'=> [
                            "allowWhiteSpace"=>true
                        ],
                    ],
                    [
                        'name'    => 'StringLength',
                        'options' => [
                            'encoding' => 'UTF-8',
                            'min'      => 3,
                            'max'      => 50,
                        ],
                    ],
                ]
            ]);

            $this->filter->add([
                "name"=>"email",
                "required"=>true,
                "validators"=> [
                    [
                        "name"=>'EmailAddress'
                    ]
                ],
            ]);

            $this->filter->add([
                'name'=>"phone",
                "required"=>true,
                'validators'=> [
                    [
                        'name'=>'regex',
                        'options'=> [
                            "pattern"=>'/^[0-9]{8,15}$/',
                            "message"=>"numero invalide"
                        ]

                    ]
                ],
            ]);

            $this->filter->add([
                'name'=>'password',
                'validators'=> [
                    [
                        'name'    => 'StringLength',
                        'options' => [
                            'min'      => 6,
                            'max'      => 50,
                        ],
                    ],
                ],
            ]);
        }

        return $this->filter;

    }
}
