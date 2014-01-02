<?php

return array(
    'controllers' => array(
        'invokables' => array(
            'Tranreq\Controller\Tranreq' => 'Tranreq\Controller\TranreqController',
            'Tranreq\Controller\Inquire' => 'Tranreq\Controller\InquireController',
        ),
    ),
    'router' => array(
        'routes' => array(
//            'tranreq' => array(
//                'type'    => 'Literal',
//                'options' => array(
//                    // Change this to something specific to your module
//                    'route'    => '/transcript-request',
//                    'defaults' => array(
//                        // Change this value to reflect the namespace in which
//                        // the controllers for your module are found
//                        '__NAMESPACE__' => 'Tranreq\Controller',
//                        'controller'    => 'Inquire',
//                        'action'        => 'index',
//                    ),
//                ),
//                'child_routes' => array(
//                    'request' => array(
//                        'type' => 'Literal',
//                        'options' => array(
//                            'route' => '',
//                            'defaults' => array(
//                                'controller' => 'tranreq',
//                                'action' => 'request',
//                            ),
//                        ),
//                    ),
//                    )
//                ),
            'inquire' => array(
                'type' => 'Literal',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/transcript-request',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Tranreq\Controller',
                        'controller' => 'Tranreq',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'track' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/inquire/track',
                            'defaults' => array(
                                'controller' => 'inquire',
                                'action' => 'track',
                            ),
                        ),
                    ),
                    'request' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/inquire/request',
                            'defaults' => array(
                                'controller' => 'inquire',
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
            'process' => array(
                'type' => 'Literal',
                'options' => array(
                    // Change this to something specific to your module
                    'route' => '/transcript-request',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Tranreq\Controller',
                        'controller' => 'Tranreq',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'track' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/process/track',
                            'defaults' => array(
                                'controller' => 'process',
                                'action' => 'track',
                            ),
                        ),
                    ),
                    'request' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/process/request',
                            'defaults' => array(
                                'controller' => 'process',
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
            'Tranreq' => __DIR__ . '/../view',
        ),
    ),
    'view_helpers' => array(
        'invokables' => array(
            'MyHelper' => 'student_enrollment\module\Tranreq\MyHelper',
        ),
    ),
    'doctrine' => array(
        'driver' => array(
            'Tranreq_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/Tranreq/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    'Tranreq\Entity' => 'Tranreq_driver'
                ),
            ),
        ),
    )
);
