<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController {

    public function indexAction() {

        $id = (int) $this->params()->fromRoute("id", null);
        $uri = (array) $this->params()->fromRoute();
        $obj1 = new ViewModel(array(
            'id' => $id,
            'uri' => $uri,
            'title' => 'Enterprise Applications Services Gateway',
            'content' => 'Welcome to Enterprise Applications Services<br> This is the home gateway, if you know the name of the application you are trying to reach enter it after a forward slash. <br> Thank you and happy Enterprising. <br> Go Rebels!!!',
            'option1' => 'Current Students',
            'option2' => 'Future Students'
                )
        );
        return $obj1;
    }

    public function geturlvaluesAction() {
        $id = (int) $this->params()->fromRoute("id", null);
        $title = "values in the url";
        return new ViewModel(array('title' => $title));
    }

}
