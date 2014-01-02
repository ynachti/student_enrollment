<?php

namespace Authnet\Form;

use Zend\Form\Element;
use Zend\Form\Form;

class Bank extends Form {

    public function __construct() {
        
        parent::__construct();
        
        $this->add(array(
            'name' => 'x_card_num',
            'options' => array(
                'label' => 'Bank Name',
            ),
            'attributes' => array(
                'type' => 'text'
            ),
        ));
        
        $this->add(array(
            'name' => 'x_exp_date',
            'options' => array(
                'label' => 'Bank Account Number',
            ),
            'attributes' => array(
                'type' => 'text'
            ),
        ));
        
        $this->add(array(
            'name' => 'x_card_code',
            'options' => array(
                'label' => 'ABA Routing Number',
            ),
            'attributes' => array(
                'type' => 'text'
            ),
        ));

        $this->add(array(
            'name' => 'x_card_code',
            'options' => array(
                'label' => 'Name on Account',
            ),
            'attributes' => array(
                'type' => 'text'
            ),
        ));
        
        $this->add(array(
            'name' => 'x_card_code',
            'options' => array(
                'label' => 'Bank Account Type',
            ),
            'attributes' => array(
                'type' => 'text'
            ),
        ));  


        $submitElement = new Element\Button('submit');
        $submitElement
                ->setLabel('Submit')
                ->setAttributes(array(
                    'value' => 'Submit',
                    'type' => 'submit',
                    'class' => 'btn btn-success',
        ));

        $this->add($submitElement, array(
            'priority' => -100,
        ));

    }

}
