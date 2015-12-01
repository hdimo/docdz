<?php
namespace Contact\Form;

use Zend\Form\Form;
class contactForm extends Form
{
    
    public function __construct($name = null){
        
        parent::__construct('contact');
        
        $this->add([
            'name'=>'name',
            'required'=>true,
            'attributes'=> [
                'type'=>'text',
                'required'=>'required',
            ],
        ]);
        
        $this->add([
            'name'=>'email',
            'required'=>true,
            'attributes'=> [
                'type'=>'email',
                'required'=>'required',
            ],
        ]);
        
        $this->add([
            'name'=>'message',
            'required'=>true,
            'attributes'=> [
                'type'=>'textarea',
                'required'=>'required',
            ],
        ]);
        
        $this->add([
            'name'=>'submit',            
            'attributes'=> [
                'value'=>'Envoyer',
            ],
        ]);
        
    }
    
    
}
