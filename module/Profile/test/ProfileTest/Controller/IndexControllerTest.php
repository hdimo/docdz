<?php
/**
 * User: khaled
 * Date: 6/4/15 at 3:56 PM
 */

namespace ProfileTest\Controller;

use Zend\Session\Container;
use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;

class IndexControllerTest extends AbstractHttpControllerTestCase{

    protected $session;

    public function setUp(){
        $this->setApplicationConfig(
            include '/var/www/html/cars.lan/config/application.config.php'
        );
        $this->session = new Container('user');
        parent::setUp();
    }

    public function testIndexActionCanBeAccessed(){
        $this->dispatch('/traject');
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('Traject');
        $this->assertControllerName('Traject\Controller\Manage');
        $this->assertControllerClass('ManageController');
        $this->assertMatchedRouteName('traject');
    }

}