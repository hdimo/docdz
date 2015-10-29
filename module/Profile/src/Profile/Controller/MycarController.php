<?php
/**
 * User: khaled
 * Date: 6/4/15 at 9:36 AM
 */

namespace Profile\Controller;


use Application\Entity\Car;
use Doctrine\Common\Collections\ArrayCollection;
use Profile\Form\CarForm;

use Zend\Filter\File\Rename;
use Zend\View\Model\ViewModel;

class MycarController extends BaseController
{

    /**
     * @return ViewModel
     */
    public function indexAction()
    {
        $form = new CarForm();
        return $this->actionView->setVariable('form', $form);
    }

    /**
     * @return ViewModel
     */
    public function processAction()
    {
        $path = BASE_PATH . '/images';
        if ($this->request->isPost()) {
            $data = $this->params()->fromPost();
            $file = $this->params()->fromFiles();
            $filename = $file['file']['name'];

            $form = new CarForm();
            $adapter = new \Zend\File\Transfer\Adapter\Http();
            if ($this->validateFile($adapter, $filename)) {
                $renameFilter = new Rename([
                    'target' => $path . '/car.png',
                    'randomize' => true,
                ]);
                $adapter->setFilters([$renameFilter]);

                if ($adapter->receive($filename)) {
                    $fileFullPath = explode('/', $adapter->getFileName());
                    $newFileName = array_pop($fileFullPath);

                    $user = $this->identity();
                    $car = new Car();
                    $car->setDriver($user);
                    $car->setBrand($data['brand']);
                    $car->setRate($data['rate']);
                    $car->setImage($newFileName);

                    $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
                    $em->persist($car);
                    $em->flush();

                    $this->actionView->setVariable('success', true);
                }
            } else {
                $this->actionView->setVariables([
                    'error' => true,
                    'errorMsg' => $adapter->getMessages(),
                ]);
            }
            $this->actionView->setTemplate('profile/mycar/index');
            $this->actionView->setVariables(['form' => $form]);
            return $this->actionView;
        } else {
            $this->redirect()->toRoute('board/usr', ['controller' => 'mycar']);
        }
    }


}