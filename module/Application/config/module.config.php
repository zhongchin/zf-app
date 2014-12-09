<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

return array(
    'di'=>array(
     'allowed_controllers'=>array(
        'Application\Controller\GreetingController',
	 ),
	 'instance'=>array(
	   'preference'=>array(
	     'Zend\EventManager\EventManagerInterface'=>'EventManager',
	     'Zend\ServiceManager\ServiceLocatorInterface'=>'ServiceManager'
	   ),
	  ),
	),
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
                    'app-index' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '[/:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                                '__NAMESPACE__' => 'Application\Controller',
                                'controller' => 'Application\Controller\Index',
                                'action'        => 'index',
                            ),
                        ),
                    ),
                ),
            ),
            'hello'=>array(
               'type'=>'Literal',
               'options'=>array(
                 'route'=>'/hello',
                 'defaults'=>array(
                   'controller'=>'Application\Controller\GreetingController',
                   'action'=>'hello'
				 )
			   )
			),
        ),
    ),
    'service_manager' => array(
        'invokables'=>array(
            'ExampleService'=>'Application\Service\Example'
        ),
        'factories' => array(
            'translator' => 'Zend\I18n\Translator\TranslatorServiceFactory',
            'Zend\Session\Config\ConfigInterface'=>'Zend\Session\Service\SessionConfigFactory',
            'Zend\Session\Storage\StorageInterface'=>'Zend\Session\Service\SessionStorageFactory',
            'Zend\Session\ManagerInterface'=>'Zend\Session\Service\SessionManagerFactory'
        ),
        'abstract_factories'=>array(
            'Zend\Session\Service\ContainerAbstractServiceFactory'
        ),
    ),
    'session_config'=>array(
        'remember_me_seconds'=>3600,
        'name'=>'some_name',
    ),
    'session_storage'=>array(
        'type'=>'SessionArrayStorage',
        'options'=>array(),
    ),
    'session_containers'=>array(
        'ContainerOne',
        'ContainerTwo'
    ),
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
        'invokables' => array(
            'Application\Controller\Index' => 'Application\Controller\IndexController',
            'Application\Controller\Greeting'=>'Application\Controller\GreetingController'
        ),
        'factories'=>array(
            'Application\Controller\GreetingController'=>function($sm){
                      $greetingService=new \Application\Service\GreetingService(new \Application\Repository\StaticGreetingRepository());
                    return new \Application\Controller\GreetingController($greetingService);
              }
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
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
    ),
);
