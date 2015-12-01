<?php
/**
 * User: khaled
 * Date: 5/30/15 at 2:54 PM
 */

namespace Profile\Controller;

use Profile\Controller\BaseController;
use User\Form\RegisterForm;
use Zend\Validator\StringLength;
use Zend\View\Model\ViewModel;

class ChangepwdController extends BaseController
{

    /**
     * display form to update password
     *
     * @return ViewModel
     */
    public function indexAction()
    {
        $form = new RegisterForm();
        $this->actionView->setVariables([
            "form" => $form,
        ]);
        return $this->actionView;
    }


    /**
     * validate and update user's password
     *
     * @return \Zend\Http\Response|ViewModel
     */
    public function processAction()
    {
        $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');

        if($this->request->isPost()){
            $form = new RegisterForm();
            $params = $this->params()->fromPost();

            $user = $this->identity();
            if($this->checkpassword($params['currentPassword'], $user->getPassword())){
                $filterLength = new StringLength(['min'=>6, 'max'=>50]);
                if($filterLength->isValid($params['password']) && $params['password'] == $params['confirm_password']){
                    $user->setPassword($params['password']);
                    $em->persist($user);
                    $em->flush();
                    $this->actionView->setVariable('success', true);
                }else{
                    $this->actionView->setVariables([
                        'error'=> true,
                        'msg'=>$filterLength->getMessages()
                    ]);
                }
            }else{
                $this->actionView->setVariable('error', true);
            }
            $this->actionView->setTemplate('profile/changepwd/index');
            $this->actionView->setVariable('form', $form);
            return $this->actionView;

        }else{
            return $this->redirect()->toRoute('board/usr');
        }
    }

    /**
     * check if password are same
     *
     * @param $entredPassword
     * @param $currentPassword
     * @return bool
     */
    public function checkpassword($entredPassword, $currentPassword){
        return sha1($entredPassword) == $currentPassword;
    }

}