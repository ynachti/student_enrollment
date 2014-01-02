<?php

return array(
    'controllers' => array(
        'invokables' => array(
            'Authnet\Controller\Authnet' => 'Authnet\Controller\AuthnetController',
            'Authnet\Controller\Inquire' => 'Authnet\Controller\TranreqController',
            'Authnet\Controller\Tranreq' => 'Authnet\Controller\TranreqController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'transaction' => array(
                'type' => 'Literal',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/transaction',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Authnet\Controller',
                        'controller' => 'Authnet',
                        //'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'track' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/form/track',
                            'defaults' => array(
                                'controller' => 'transaction',
                                'action' => 'track',
                            ),
                        ),
                    ),
                    'receipt' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/authnet/receipt',
                            'defaults' => array(
                                'controller' => 'transaction',
                                'action' => 'receipt',
                            ),
                        ),
                    ),
                    'request' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/authnet/request',
                            'defaults' => array(
                                'controller' => 'transaction',
                                'action' => 'request',
                            ),
                        ),
                    ),
                    
                    // This route is a sane default when developing a module;
                    // as you solidify the routes for your module, however,
                    // you may want to remove it and replace it with more
                    // specific routes.
                    'default' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'Authnet' => __DIR__ . '/../view',
        ),
    ),
    'view_helpers' => array(
        'invokables' => array(
            'MyHelper' => 'student_enrollment\module\Authnet\MyHelper',
        ),
    ),
    'doctrine' => array(
        'driver' => array(
            'Authnet_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/Authnet/Model')
            ),
            'orm_default' => array(
                'drivers' => array(
                    'Authnet\Model' => 'Authnet_driver'
                ),
            ),
        ),
    )
);