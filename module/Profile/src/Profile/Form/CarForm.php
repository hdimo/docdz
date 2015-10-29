<?php
/**
 * User: khaled
 * Date: 6/7/15 at 2:47 PM
 */

namespace Profile\Form;


use Zend\Form\Form;

class CarForm extends Form{

    public function __construct(){

        parent::__construct('car');

        $this->add([
            'name'=>'brand',
            'attributes'=> [
                'type'=>'text',
            ]
        ]);

        $this->add([
            'name'=>'rate',
            'type'=>'Zend\Form\Element\Select',
            'options' => [
                'label' => 'Genre',
                'value_options' => [
                    1 => '1',
                    2 => '2',
                    3 => '3',
                    4 => '4',
                    5 => '5',
                ],
            ],
            'attributes'=> [
                'required'=>'required',
            ],
        ]);

        $this->add([
           'name'=>'file',
            'attributes'=> [
                'type'=>'file'
            ]
        ]);
    }

}