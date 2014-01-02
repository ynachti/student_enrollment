<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonHonors for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Honors;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\Authentication\AuthenticationService;
use Zend\Mvc\MvcEvent;
use Zend\Authentication\Adapter\DbTable as DbTableAuthAdapter;

class Module implements AutoloaderProviderInterface {

    public function getServiceConfig() {
        return array(
            'factories' => array(
                'wsdl' => function($sm) {
                    return $wsdl = new \Zend\Soap\Wsdl('myWsdl', $myWsdlService);
                },
                'Honors\Model\MyAuthStorage' => function($sm) {
                    return new \Honors\Model\MyAuthStorage('user_session');
                },
                'AuthService' => function($sm) {
                    $config = $sm->get('config');
                    $dbAdapter = new \Zend\Db\Adapter\Adapter($config['db_mysql_local']);
                    $dbTableAuthAdapter = new DbTableAuthAdapter($dbAdapter, 'users', 'user_name', 'pass_word', 'MD5(?)');

                    $authService = new AuthenticationService();
                    $authService->setAdapter($dbTableAuthAdapter);
                    $authService->setStorage($sm->get('Honors\Model\MyAuthStorage'));

                    return $authService;
                },
            ),
        );
    }

    public function getConfig() {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig() {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
        );
    }

    public function onBootstrap(MvcEvent $e) {
        $application = $e->getApplication();
        $sm = $application->getServiceManager();
        if (!$sm->get('AuthService')->hasIdentity()) {
            $users = $sm->get('Honors\Model\MyAuthStorage')->read();
            echo $users['username'];
        }
    }
    
    
    

}
