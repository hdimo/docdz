<?php
/**
 * User: khaled
 * Date: 5/25/15 at 8:43 AM
 */

namespace Profile\Controller;

use Profile\Controller\BaseController;
use Doctrine\ORM\EntityManager;
use User\Form\RegisterForm;
use Zend\Stdlib\ArrayObject;
use Zend\View\Model\ViewModel;

use DoctrineModule\Stdlib\Hydrator\DoctrineObject;


class IndexController extends BaseController {



    /**
     * display form to let user update some of profile data
     *
     * @return ViewModel
     */
    public function indexAction()
    {
        $form = new RegisterForm();

        $profileLayout = new ViewModel();
        $profileLayout->setTemplate('layout/profile');

        $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $user  = $this->identity();
        $hydrate = new DoctrineObject($em, '\Application\Entity\User');
        $userData = $hydrate->extract($user);

        $form->bind(new ArrayObject($userData));
        $this->actionView->setVariables([
            'form'=>$form,
        ]);
        return $this->actionView;
    }


    /**
     * process the submitted form and update profile in Db
     *
     * @return \Zend\Http\Response|ViewModel | Rediction
     */
    public function processAction()
    {
        if($this->request->isPost()){
            $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
            $this->actionView->setTemplate('profile/index/index');

            $form = new RegisterForm();
            $params = $this->params()->fromPost();
            $form->setData($params);

            if($form->isValid()){
                $user = $this->identity();
                $user->setFirstname($params['firstname']);
                $user->setlastname($params['lastname']);
                $user->setEmail($params['email']);
                $user->setPhone($params['phone']);

                $em->persist($user);
                $em->flush();

                $this->actionView->setVariable('error', 0);
            }else{
                $this->actionView->setVariable('error', 1);
            }
            return $this->actionView->setVariable('form', $form);
        }else{
            return $this->redirect()->toRoute('board/usr', ['controller'=>'index', 'action'=>'index']);
        }
    }
}