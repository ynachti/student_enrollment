<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/Tranreq for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Tranreq\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class TranreqController extends AbstractActionController {

    protected $form;

    public function indexAction() {
        return new ViewModel(array(
            'title' => 'Official Transcript Request',
            'links' => array('Submit a New Order' => 'inquire/request', 'Track an Existing Order' => 'inquire/track'),
            'contact' => 'Please direct questions to:
Office of the Registrar 
4505 S. Maryland Pkwy. 
Las Vegas, Nevada 89154-1029
Ph: (702) 895-3443 Fax: (702) 895-1470
Email: transcripts@unlv.edu
Looking for Enrollment Verification?',
        ));
    }

}