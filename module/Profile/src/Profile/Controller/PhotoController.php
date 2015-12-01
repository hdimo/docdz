<?php
/**
 * User: khaled
 * Date: 6/1/15 at 10:24 AM
 */

namespace Profile\Controller;


use Profile\Controller\BaseController;
use User\Form\FileUploadForm;
use Zend\File\Transfer\Adapter\Http;
use Zend\Filter\File\Rename;
use Zend\Validator\File\IsImage;
use Zend\Validator\File\Size;

class PhotoController extends BaseController
{

    /**
     * display upload form
     *
     * @return \Zend\View\Model\ViewModel
     */
    public function indexAction()
    {
        $form = new FileUploadForm();
        return $this->actionView->setVariable('form', $form);
    }

    /**
     * process uploaded user image
     *
     * @return \Zend\View\Model\ViewModel
     */
    public function processAction()
    {
        $path = BASE_PATH . '/images/avatars';

        if ($this->request->isPost()) {
            $form = new FileUploadForm();
            $file = $this->params()->fromFiles();
            $filename = $file['file']['name'];
            $adapter = new Http();
            if ($this->validateFile($adapter, $filename)) {
                $renameFilter = new Rename([
                    'target' => $path . '/usr.png',
                    'randomize' => true,
                ]);
                $adapter->setFilters([$renameFilter]);

                if ($adapter->receive($filename)) {
                    $fileFullPath = explode('/', $adapter->getFileName());
                    $newFileName = array_pop($fileFullPath);

                    $user = $this->identity();
                    $user->setImage($newFileName);
                    $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
                    $em->persist($user);

                    $em->flush();

                    $this->actionView->setVariable('success', true);
                }
            } else {
                $this->actionView->setVariables([
                    'error' => true,
                    'errorMsg' => $adapter->getMessages(),
                ]);
            }
            $this->actionView->setTemplate('profile/photo/index');
            $this->actionView->setVariables(['form' => $form]);
            return $this->actionView;
        } else {
            $this->redirect()->toRoute('board/usr', ['controller' => 'photo']);
        }
    }



}