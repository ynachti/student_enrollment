<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/Authnet for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Authnet;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module implements AutoloaderProviderInterface {

    public function getAutoloaderConfig() {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    // if we're in a namespace deeper than one level we need to fix the \ in the path
                    __NAMESPACE__ => __DIR__ . '/src/' . str_replace('\\', '/', __NAMESPACE__),
                ),
            ),
        );
    }

    public function getViewHelperConfig() {
        return array(
            'factories' => array(
                'AuthnetDpmForm' => function ($sm) {
                    $locator = $sm->getServiceLocator();
                    $viewHelper = new View\Helper\AuthnetDpmForm;
                    //$viewHelper->setAuthService($locator->get('authnet_auth_service'));
                    return $viewHelper;
                },
            )
        );
    }

    public function getServiceConfig() {
        return array(
            'invokables' => array(
                'Authnet\Form\Request' => 'Authnet\Form\Request',
            ),
            'factories' => array(
                'authnet_module_options' => function ($sm) {
                    $config = $sm->get('Config');
                    return new Options\ModuleOptions(isset($config['authnet']) ? $config['authnet'] : array());
                },
                'authnet_dpm_form' => function($sm) {
                    $options = $sm->get('authnet_module_options');
                    $form = new Form\Billing();
                    $form->setInputFilter(new Form\BillingFilter($options));
                    return $form;
                },
                'authnet_ship_form' => function($sm) {
                    $options = $sm->get('authnet_module_options');
                    $form = new Form\Shipping();
                    $form->setInputFilter(new Form\ShippingFilter($options));
                    return $form;
                },
                'authnet_cc_form' => function($sm) {
                    $options = $sm->get('authnet_module_options');
                    $form = new Form\Creditc();
                    $form->setInputFilter(new Form\CreditcFilter($options));
                    return $form;
                },
                'authnet_bank_form' => function($sm) {
                    $options = $sm->get('authnet_module_options');
                    $form = new Form\Bank();
                    $form->setInputFilter(new Form\BankFilter($options));
                    return $form;
                }
            ),
        );
    }

    public function getConfig() {
        return include __DIR__ . '/config/module.config.php';
    }

    public function onBootstrap(MvcEvent $e) {
        // You may not need to do this if you're doing it elsewhere in your
        // application
        $eventManager = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }

}
