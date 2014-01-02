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

class CurrentController extends AbstractActionController {
    
    public function indexAction() { 


            $obj = new ViewModel(array(
                'service' => get_class_methods($this->getServiceLocator()->get('AuthService')),
                'identity' => $this->getServiceLocator()->get('AuthService')->getIdentity(),
                'title' => 'Current Students Services',
                'text' => 'Welcome to the Current Students Services. You may select what you are looking to accomplish today',
                'uri' => $this->getRequest()->getRequestUri(),
                'apps' => array(
                    'Honors' => 'honors',
                    'Housing' => 'housing',
                    'Ferpa Training Signature' => 'ferpa_trn',
                    'Financial Aid & Scholarships' => 'finaid',
                    'Transcript Request' => 'tranreq',
                    'Oracle CRUD Example' => 'album'
                )
                    )
            );
            return $obj;   

    }



}