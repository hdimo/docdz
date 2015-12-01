<?php
/**
 * Created by PhpStorm.
 * User: khaled
 * Date: 14/03/15
 * Time: 17:12
 */

namespace User\Form;

use Zend\Form\Form;

class LoginForm extends Form{

    public function __construct($name = null){

        parent::__construct('login');
        
        $this->add([
            'name'=>'email',
            'required'=>true,
            'attributes'=> [
                'required'=>'required',
            ],
        ]);

        $this->add([
            'name'=>'password',
            'required'=>true,
            'attributes'=> [
                'required'=>'required',
                'type'=>'password',
            ],
        ]);

    }

}