<?php
/**
 * Created by PhpStorm.
 * User: khaled
 * Date: 4/22/15
 * Time: 10:06 AM
 */

namespace Profile\Controller;


use Zend\Mvc\Controller\AbstractActionController;
use Zend\Validator\File\IsImage;
use Zend\Validator\File\Size;
use Zend\View\Model\ViewModel;

class BaseController extends AbstractActionController{

    /**
     * @var ViewModel
     */
    public $actionView;

    public function __construct(){
        $this->actionView = new ViewModel();
    }

    /**
     * check if file is valid
     *
     * @param $adapter
     * @param $filename
     * @return boolean
     */
    public function validateFile($adapter, $filename)
    {
        $adapter->setValidators(
            [
                new Size(['max' => '2MB', 'messages' => [Size::TOO_BIG => 'le fichier est tres grand']]),
                $isImage = new IsImage([
                    'message' => 'le fichier n\'est pas une image',
                ])
            ],
            $filename
        );
        return $adapter->isValid();
    }

}