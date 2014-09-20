<?php

/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */
return array(
		
//    Connection driver to the local mysql database
    'db_mysql_local' => array(

        'driver' => 'Pdo',
        'dsn' => 'mysql:dbname=ess_users;host=127.0.0.1;port=3307',
        'driver_options' => array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
        )
    ),
//    Service manager global settings
    'service_manager' => array(
        'factories' => array(
            'Zend\Db\Adapter\Adapter' => function($sm) {
                $config = $sm->get('config');
                $dbAdapter = new \Zend\Db\Adapter\Adapter($config['db_mysql_local']);

                return $dbAdapter;
            },
        )
    ),
);


//Application specific connections
//
//TRANREQ:
//'tranreq_dev' => array(
//'username' => 'tranreq',
// 'password' => 'HBTR%iMo9'
//),
// 'tranreq_test' => array(
//'username' => 'test1',
// 'password' => 'w8e6u_e'
//),
// 'tranreq_prod' => array(
//'username' => 'tranreq',
// 'password' => 'Ujape8EX'
//)
