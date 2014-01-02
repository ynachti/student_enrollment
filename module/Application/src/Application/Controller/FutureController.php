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
use Login\Controller\WsdlController as WsdlController;

class FutureController extends AbstractActionController {

    public function indexAction() {
        $obj = new ViewModel(array(
            'title' => 'Future Students Services',
            'text' => 'Welcome to the Future Students Services. You may select what you are looking to accomplish today',
                )
        );
        return $obj;
    }

    public function form2Action() {
        $wsdl = new WsdlController('test', 'tranreq');
        $ret = $wsdl->getWsdlResponse('2000450297', 'N');
        
        $obj = new ViewModel(array(
            'title' => 'Future Students Services',
            'text' => $ret->FIRST_NAME->_ ,
                )
        );
        return $obj;
    }
}
