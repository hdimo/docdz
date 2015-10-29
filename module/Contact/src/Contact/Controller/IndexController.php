<?php
namespace Contact\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Contact\Form\contactForm;


class IndexController extends AbstractActionController
{

    public function indexAction()
    {
        $form = new contactForm();
        return new ViewModel([
            "form"=>new contactForm()
        ]);
    }

    public function processAction()
    {
        return [];
    }
}
