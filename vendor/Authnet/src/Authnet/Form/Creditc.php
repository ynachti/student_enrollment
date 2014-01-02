<?php

namespace Authnet\Form;

use Zend\Form\Element;
use Zend\Form\Form;

class Creditc extends Form {

    public function __construct() {
        
        parent::__construct();       
        
        $this->add(array(
            'name' => 'x_card_num',
            'options' => array(
                'label' => 'Credit Card Number',
            ),
            'attributes' => array(
                'type' => 'text',
                'size' => '15',
                'maxlength' => '16',
                
            ),
        ));
        
        $this->add(array(
            'name' => 'x_exp_date',
            'options' => array(
                'label' => 'Expiration Date',
            ),
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-group',
                'size' => '6',
                'maxlength' => '5',
                'style' => 'margin-right: 300px'
            ),
        ));
        
        $this->add(array(
            'name' => 'x_card_code',
            'options' => array(
                'label' => 'Card Code',
            ),
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-group',
                'size' => '4',
                'maxlength' => '3'
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
