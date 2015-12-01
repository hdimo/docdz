<?php
namespace Application\Controller;

use Traject\Form\NewTraject;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Permissions\Acl\Acl;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{

    /**
     * @return ViewModel
     */
    public function indexAction()
    {
        $this->layout()->setVariable('isHomePage', true);
        return new ViewModel();
    }
    
    public function listAction(){

        return false;
    }    

}
