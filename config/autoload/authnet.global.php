<?php
$error_redirect = '';
$success_redirect = '';
$settings = array(
    'sandbox_api_login_id' => '9pT5guGY4e',
    
    'sandbox_transaction_key' => '294QFddE8m4n5X66',
    
    'live_api_login_id' => '',
    
    'live_transaction_key' => '',
    
    /**
     * Zend\Db\Adapter\Adapter DI Alias
     *
     * Please specify the DI alias for the configured Zend\Db\Adapter\Adapter
     * instance that ZfcUser should use.
     */
    'zend_db_adapter' => 'Zend\Db\Adapter\Adapter',
    /**
     * User Model Entity Class
     *
     * Name of Entity class to use. Useful for using your own entity class
     * instead of the default one provided. Default is ZfcUser\Entity\User.
     * The entity class should implement ZfcUser\Entity\UserInterface
     */
    'user_entity_class' => 'ZfcUser\Entity\User',
    /**
     * Enable registration
     *
     * Allows users to register through the website.
     *
     * Accepted values: boolean true or false
     */
    'enable_registration' => true,
    /**
     * Enable Username
     *
     * Enables username field on the registration form, and allows users to log
     * in using their username OR email address. Default is false.
     *
     * Accepted values: boolean true or false
     */
    'enable_username' => true,
    /**
     * Authentication Adapters
     *
     * Specify the adapters that will be used to try and authenticate the user
     *
     * Default value: array containing 'ZfcUser\Authentication\Adapter\Db' with priority 100
     * Accepted values: array containing services that implement 'ZfcUser\Authentication\Adapter\ChainableAdapter'
     */
    'auth_adapters' => array(100 => 'ZfcUser\Authentication\Adapter\Db'),
    /**
     * Enable Display Name
     *
     * Enables a display name field on the registration form, which is persisted
     * in the database. Default value is false.
     *
     * Accepted values: boolean true or false
     */
    'enable_display_name' => true,
    /**
     * Modes for authentication identity match
     *
     * Specify the allowable identity modes, in the order they should be
     * checked by the Authentication plugin.
     *
     * Default value: array containing 'email'
     * Accepted values: array containing one or more of: email, username, nsheid
     */
    'auth_identity_fields' => array('email', 'username', 'nsheid'),
    /**
     * Login form timeout
     *
     * Specify the timeout for the CSRF security field of the login form
     * in seconds. Default value is 300 seconds.
     *
     * Accepted values: positive int value
     */
    'login_form_timeout' => 300,
    /**
     * Registration form timeout
     *
     * Specify the timeout for the CSRF security field of the registration form
     * in seconds. Default value is 300 seconds.
     *
     * Accepted values: positive int value
     */
    'user_form_timeout' => 300,
    /**
     * Login After Registration
     *
     * Automatically logs the user in after they successfully register. Default
     * value is false.
     *
     * Accepted values: boolean true or false
     */
    'login_after_registration' => true,
    /**
     * Registration Form Captcha
     *
     * Determines if a captcha should be utilized on the user registration form.
     * Default value is false.
     */
    'use_registration_form_captcha' => true,
    /**
     * Form Captcha Options
     *
     * Currently used for the registration form, but re-usable anywhere. Use
     * this to configure which Zend\Captcha adapter to use, and the options to
     * pass to it. The default uses the Figlet captcha.
     */
    'form_captcha_options' => array(
        'class' => 'recaptcha',
        'options' => array(
            'wordLen' => 5,
            'expiration' => 300,
            'timeout' => 300,
        ),
    ),
    /**
     * Use Redirect Parameter If Present
     *
     * Upon successful authentication, check for a 'redirect' POST or GET parameter
     *
     * Accepted values: boolean true or false
     */
    'use_redirect_parameter_if_present' => true,
    /**
     * Sets the view template for the user login widget
     *
     * Default value: 'zfc-user/user/login.phtml'
     * Accepted values: string path to a view script
     */
    'user_login_widget_view_template' => 'authnet/authnet/request.phtml',
    /**
     * error Redirect Route
     *
     * Upon failed Transaction the user will be redirected to the entered route
     *
     * Default value: 'zfcuser'
     * Accepted values: A valid route name within your application
     *
     */
    'error_redirect_route' => $error_redirect,
    /**
     * Success Redirect Route
     *
     * Upon successful transaction the user will be redirected to the enterd route
     *
     * Default value: 'zfcuser/login'
     * Accepted values: A valid route name within your application
     */
    'success_redirect_route' => $success_redirect,


    /**
     * Default user state upon registration
     * 
     * What state user should have upon registration?
     * Allowed value type: integer
     */
    'default_user_state' => 1,
    
    /**
     * User table name
     */
    'table_name' => 'user',
        /**
         * End of ZfcUser configuration
         */
);

return array(
    'authnet' => $settings
);
?>