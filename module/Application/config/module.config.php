<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Application\Billing\BillingManagerFactory;
use Application\Billing\NotifierFactory;
use Application\Monitoring\MvcWatcherFactory;
use Application\Services\ArticleManagerFactory;
use Application\Services\ServiceFactory;
use Application\User\UserControllerFactory;
use Application\User\UserApiControllerFactory;
use Application\User\UserFormFactory;
use Application\User\UserManagerFactory;

return array(
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),
            // The following is a route to simplify getting started creating
            // new controllers and actions without needing to create a new
            // module. Simply drop new controllers in, and you can access them
            // using the path /application/:controller/:action
            'application' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/application',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),
            'billing' => [
                'type' => 'Literal',
                'options' => [
                    'route' => '/billing',
                    'defaults' => [
                        '__NAMESPACE__' => 'Application',
                        'controller' => 'Billing'
                    ]
                ],
                'child_routes' => [
                    'print' => [
                        'type' => 'segment',
                        'options' => [
                            'route' => '/:billId/print',
                            'defaults' => [
                                'action' => 'print'
                            ]
                        ]
                    ]
                ]
            ],
            'user' => [
                'type' => 'literal',
                'options' => [
                    'route' => '/create-user',
                    'defaults' => [
                        '__NAMESPACE__' => 'Application',
                        'controller' => 'User',
                        'action' => 'create'
                    ]
                ]
            ],
            'api' => [
                'type' => 'literal',
                'options' => [
                    'route' => '/api',
                    'defaults' => [
                        '__NAMESPACE__' => 'Application'
                    ]
                ],
                'child_routes' => [
                    'create-user' => [
                        'type' => 'literal',
                        'options' => [
                            'route' => '/create-user',
                            'defaults' => [
                                'controller' => 'UserApi',
                                'action' => 'create'
                            ]
                        ]
                    ]
                ]
            ]
        ),
    ),
    'service_manager' => array(
        'services' => [
            /** TO AVOID!!! */
//            'toto' => new \ArrayObject([])
        ],
        'invokables' => [
            'my-invokable' => 'ArrayObject'
        ],
        'factories' => array(
            /** TO AVOID!!! */
//            'my-built-service' => function (ServiceManager $sm) {
//                return new \ArrayObject([]);
//            },
            'billing-manager' => BillingManagerFactory::class,
            'billing-notifier' => NotifierFactory::class,
            'mvc-watcher' => MvcWatcherFactory::class,
            'my-built-service' => ServiceFactory::class,
            'article-manager' => ArticleManagerFactory::class,
            'translator' => 'Zend\Mvc\Service\TranslatorServiceFactory',
            'user-manager' => UserManagerFactory::class
        ),
        'abstract_factories' => array(
            \Zend\Cache\Service\StorageCacheAbstractServiceFactory::class,
            \Zend\Log\LoggerAbstractServiceFactory::class,
            \Zend\InputFilter\InputFilterAbstractServiceFactory::class
        ),
        'shared' => [
            'my-invokable' => false
        ],
        'aliases' => [
            'entity-manager' => 'doctrine.entitymanager.orm_default'
        ],
        'initializers' => [
            
        ]
    ),
    'log' => [
        'my-logger' => [
            'writers' => [
                [
                    'name' => 'stream',
                    'options' => [
                        'stream' => './data/logs/my-app.log',
                        'mode' => 'a'
                    ]
                ],
//                [
//                    'name' => 'mail',
//                    'priority' => Logger::CRIT,
//                    'options' => [
//                        'mail' => [
//                            'to' => 'frederic@continuous.lu'
//                        ]
//                    ]
//                ]
            ]
        ]
    ],
    'log_writers' => [
    ],
    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),
    'controllers' => array(
        'factories' => [
            'Application\Billing' => Controller\BillingControllerFactory::class,
            'Application\User' => UserControllerFactory::class,
            'Application\UserApi' => UserApiControllerFactory::class
        ],
        'invokables' => array(
            'Application\Controller\Index' => Controller\IndexController::class,
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => false,
        'display_exceptions'       => false,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
        'strategies' => [
            'ViewJsonStrategy'
        ]
    ),
    
    'form_elements' => [
        'factories' => [
            'user-form' => UserFormFactory::class
        ]
    ],
    
    'input_filter_specs' => [
        'user-filter' => [
            [
                'name' => 'firstname',
                'required' => true,
                'filters' => [
                    [
                        'name' => 'stringtrim'
                    ]
                ],
                'validators' => [
                    [
                        'name' => 'notempty'
                    ]
                ]
            ],
            [
                'name' => 'lastname',
                'required' => true,
                'filters' => [
                    [
                        'name' => 'stringtrim'
                    ]
                ],
                'validators' => [
                    [
                        'name' => 'notempty'
                    ]
                ]
            ]
        ]
    ],
    
    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array(
            ),
        ),
    ),
    'billing' => [
        'notifications' => true
    ],


    'doctrine' => [
        'driver' => [
            'app_driver' => [
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => [ dirname(__DIR__) . '/src' ]
            ],
            'orm_default' => [
                'drivers' => [
                    'Application' => 'app_driver',
                ]
            ]
        ],
        'configuration' => [
            'orm_default' => [
                'driver' => 'orm_default'
            ]
        ],
    ],
);
