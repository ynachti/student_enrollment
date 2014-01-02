<?php

namespace Housing\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Form\Annotation\AnnotationBuilder;
use Zend\View\Model\ViewModel;
use Housing\Model\AppForm;

class HousingController extends AbstractActionController {

    protected $form;

    public function indexAction() {
        if(!$this->getServiceLocator()->get('AuthService')->hasIdentity())
            return $this->redirect ()->toRoute ('login');
        $form = $this->getForm();
        return array(
            'title' => 'Housing College',
            'form' => $form,
            'messages' => $this->flashmessenger()->getMessages()
        );
    }

    public function getForm() {
        if (!$this->form) {
            $Housing_application = new AppForm();
            $builder = new AnnotationBuilder();
            $this->form = $builder->createForm($Housing_application);
        }
        return $this->form;
    }
}
