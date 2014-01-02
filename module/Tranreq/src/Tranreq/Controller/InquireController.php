<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Tranreq\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Form\Annotation\AnnotationBuilder;
//use Zend\View\Model\ViewModel;
use Tranreq\Model\RequestForm;

/**
 * Description of InquireController
 *
 * @author yn
 */

const SCHEDULE = 'Your transcript will be processed as it stands at the time of this order. If you are waiting for an update to your record (ex: change of grade, degree-granted, etc), please delay your request until such update is made. Current students may view their transcript real-time by navigating to unofficial transcript in the MyUNLV Student Center.';

class InquireController extends AbstractActionController{
    
    protected $form;
    

    //put your code here
    public function requestAction() {
        $form = $this->getForm();
        return array(
            'heading' => 'Official Transcript Request Form',
            'title1' => '',
            'paragraph1' => SCHEDULE,
            'form' => $form,
            'messages' => $this->flashmessenger()->getMessages()
        );
    }

    public function trackAction() {
        $form = $this->getForm();
        return array(
            'title' => 'Transcript Request Tracking',
            'form' => $form,
            'messages' => $this->flashmessenger()->getMessages()
        );
    }

    public function getForm() {
        if (!$this->form) {
            $honors_application = new RequestForm();
            $builder = new AnnotationBuilder();
            $this->form = $builder->createForm($honors_application);
        }
        return $this->form;
    }

}

?>
