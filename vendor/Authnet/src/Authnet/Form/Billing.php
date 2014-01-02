<?php

namespace Authnet\Form;

use Zend\Form\Form;

class Billing extends Form {

    public function __construct() {

        parent::__construct();

        $this->add(array(
            'name' => 'x_first_name',
            'id' => 'x_first_name',
            'options' => array(
                'label' => 'First Name',
            ),
            'attributes' => array(
                'type' => 'text',
                'size' => '20'
            ),
        ));

        $this->add(array(
            'name' => 'x_last_name',
            'id' => 'x_last_name',
            'options' => array(
                'label' => 'Last Name',
            ),
            'attributes' => array(
                'type' => 'text',
                'size' => '20'
            ),
        ));

        $this->add(array(
            'name' => 'x_company',
            'id' => 'x_company',
            'options' => array(
                'label' => 'Company',
            ),
            'attributes' => array(
                'type' => 'text',
                'size' => '60'
            ),
        ));

        $this->add(array(
            'name' => 'x_address',
            'options' => array(
                'label' => 'Address',
            ),
            'attributes' => array(
                'type' => 'text',
                'size' => '60'
            ),
        ));

        $this->add(array(
            'name' => 'x_city',
            'options' => array(
                'label' => 'City',
            ),
            'attributes' => array(
                'type' => 'text',
                'size' => '12'
            ),
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'x_state',
            'options' => array(
                'label' => 'State',
                'empty_option' => array('value' => 'NV', 'label' => 'Nevada'),
                'value_options' => array('AL' => "Alabama", 'AK' => "Alaska", 'AZ' => "Arizona", 'AR' => "Arkansas", 'CA' => "California", 'CO' => "Colorado", 'CT' => "Connecticut", 'DE' => "Delaware", 'DC' => "District Of Columbia", 'FL' => "Florida", 'GA' => "Georgia", 'HI' => "Hawaii", 'ID' => "Idaho", 'IL' => "Illinois", 'IN' => "Indiana", 'IA' => "Iowa", 'KS' => "Kansas", 'KY' => "Kentucky", 'LA' => "Louisiana", 'ME' => "Maine", 'MD' => "Maryland", 'MA' => "Massachusetts", 'MI' => "Michigan", 'MN' => "Minnesota", 'MS' => "Mississippi", 'MO' => "Missouri", 'MT' => "Montana", 'NE' => "Nebraska", 'NV' => "Nevada", 'NH' => "New Hampshire", 'NJ' => "New Jersey", 'NM' => "New Mexico", 'NY' => "New York", 'NC' => "North Carolina", 'ND' => "North Dakota", 'OH' => "Ohio", 'OK' => "Oklahoma", 'OR' => "Oregon", 'PA' => "Pennsylvania", 'RI' => "Rhode Island", 'SC' => "South Carolina", 'SD' => "South Dakota", 'TN' => "Tennessee", 'TX' => "Texas", 'UT' => "Utah", 'VT' => "Vermont", 'VA' => "Virginia", 'WA' => "Washington", 'WV' => "West Virginia", 'WI' => "Wisconsin", 'WY' => "Wyoming"),
            ),
            'attributes' => array(
                'style' => 'width: auto'
            ),
        ));

        $this->add(array(
            'name' => 'x_zip',
            'options' => array(
                'label' => 'Zip Code',
            ),
            'attributes' => array(
                'type' => 'text',
                'size' => '9',
                

            ),
        ));

        $this->add(array(
            'name' => 'x_country',
            'options' => array(
                'label' => 'Country',
            ),
            'attributes' => array(
                'type' => 'text',
                'size' => '24',

            ),
        ));
        $this->add(array(
            'name' => 'x_email',
            'options' => array(
                'label' => 'E-mail',
            ),
            'attributes' => array(
                'type' => 'text',
                'size' => '60'
            ),
        ));
        $this->add(array(
            'name' => 'x_phone',
            'options' => array(
                'label' => 'Telephone',
            ),
            'attributes' => array(
                'type' => 'text',
                'size' => '12'
            ),
        ));
        $this->add(array(
            'name' => 'x_fax',
            'options' => array(
                'label' => 'Fax Number',
            ),
            'attributes' => array(
                'type' => 'text',
                'size' => '12'
            ),
        ));
    }

}
