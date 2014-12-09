<?php
return array (
  'di' => 
  array (
    'allowed_controllers' => 
    array (
      0 => 'Application\\Controller\\GreetingController',
    ),
    'instance' => 
    array (
      'preference' => 
      array (
        'Zend\\EventManager\\EventManagerInterface' => 'EventManager',
        'Zend\\ServiceManager\\ServiceLocatorInterface' => 'ServiceManager',
      ),
      'alias' => 
      array (
        'user' => 'User\\Controller\\UserController',
        'WebinoImageThumb' => 'WebinoImageThumb\\WebinoImageThumb',
      ),
      'user' => 
      array (
        'parameters' => 
        array (
          'broker' => 'Zend\\Mvc\\Controller\\PluginBroker',
        ),
      ),
      'Users\\Event\\Authentication' => 
      array (
        'parameters' => 
        array (
          'userAuthenticationPlugin' => 'Users\\Controller\\Plugin\\UserAuthentication',
          'aclClass' => 'Users\\Acl\\Acl',
        ),
      ),
      'Users\\Acl\\Acl' => 
      array (
        'parameters' => 
        array (
          'config' => 
          array (
            'acl' => 
            array (
              'roles' => 
              array (
                'guest' => NULL,
                'member' => 'guest',
              ),
              'resources' => 
              array (
                'allow' => 
                array (
                  'user' => 
                  array (
                    'login' => 'guest',
                    'all' => 'member',
                  ),
                ),
              ),
            ),
          ),
        ),
      ),
      'Users\\Controller\\Plugin\\UserAuthentication' => 
      array (
        'parameters' => 
        array (
          'authAdapter' => 'Zend\\Authentication\\Adapter\\DbAdapter',
        ),
      ),
      'Zend\\Authentication\\Adapter\\DbTable' => 
      array (
        'parameters' => 
        array (
          'zendDb' => 'Zend\\Db\\Adapter\\Mysqli',
          'tableName' => 'users',
          'identityColumn' => 'email',
          'credentialColumn' => 'password',
          'credentialTreatment' => 'SHA1(CONCAT(?,"secretKey"))',
        ),
      ),
      'Zend\\Db\\Adapter\\Mysqli' => 
      array (
        'parameters' => 
        array (
          'config' => 
          array (
            'host' => 'localhost',
            'username' => 'root',
            'password' => 'root',
            'dbname' => 'dbname',
            'charset' => 'utf-8',
          ),
        ),
      ),
      'Zend\\Mvc\\Controller\\PluginLoader' => 
      array (
        'parameters' => 
        array (
          'map' => 
          array (
            'userAuthentication' => 'User\\Controller\\Plugin\\UserAuthentication',
          ),
        ),
      ),
      'Zend\\View\\PhpRenderer' => 
      array (
        'parameters' => 
        array (
          'options' => 
          array (
            'script_paths' => 
            array (
              'user' => 'E:\\zendframework\\zf-app\\module\\Users\\config/../views',
            ),
          ),
        ),
      ),
    ),
    'definition' => 
    array (
      'compiler' => 
      array (
        0 => 'E:\\zendframework\\zf-app\\module\\WebinoImageThumb\\config/../data/di/definition.php',
      ),
    ),
  ),
  'router' => 
  array (
    'routes' => 
    array (
      'home' => 
      array (
        'type' => 'Zend\\Mvc\\Router\\Http\\Literal',
        'options' => 
        array (
          'route' => '/',
          'defaults' => 
          array (
            'controller' => 'Application\\Controller\\Index',
            'action' => 'index',
          ),
        ),
      ),
      'application' => 
      array (
        'type' => 'Literal',
        'options' => 
        array (
          'route' => '/application',
          'defaults' => 
          array (
            '__NAMESPACE__' => 'Application\\Controller',
            'controller' => 'Index',
            'action' => 'index',
          ),
        ),
        'may_terminate' => true,
        'child_routes' => 
        array (
          'app-index' => 
          array (
            'type' => 'Segment',
            'options' => 
            array (
              'route' => '[/:controller[/:action]]',
              'constraints' => 
              array (
                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
              ),
              'defaults' => 
              array (
                '__NAMESPACE__' => 'Application\\Controller',
                'controller' => 'Application\\Controller\\Index',
                'action' => 'index',
              ),
            ),
          ),
        ),
      ),
      'hello' => 
      array (
        'type' => 'Literal',
        'options' => 
        array (
          'route' => '/hello',
          'defaults' => 
          array (
            'controller' => 'Application\\Controller\\GreetingController',
            'action' => 'hello',
          ),
        ),
      ),
      'users' => 
      array (
        'type' => 'segment',
        'options' => 
        array (
          'route' => '/users[/:controller][/:action]',
          'constraints' => 
          array (
            'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
            'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
          ),
          'defaults' => 
          array (
            '__NAMESPACE__' => 'Users\\Controller',
            'controller' => 'Index',
            'action' => 'index',
          ),
        ),
        'may_terminate' => true,
        'child_routes' => 
        array (
          'default' => 
          array (
            'type' => 'Segment',
            'options' => 
            array (
              'route' => '/[:controller[/:action]]',
              'constraints' => 
              array (
                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
              ),
              'defaults' => 
              array (
              ),
            ),
          ),
        ),
      ),
      'login' => 
      array (
        'type' => 'Segment',
        'options' => 
        array (
          'route' => '/users/login[/:action]',
          'constraints' => 
          array (
            'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
          ),
          'defaults' => 
          array (
            '__NAMESPACE__' => 'Users\\Controller',
            'controller' => 'Login',
            'action' => 'index',
          ),
        ),
      ),
      'user-manager' => 
      array (
        'type' => 'Segment',
        'options' => 
        array (
          'route' => '/users/user-manager[/:action[/:id]]',
          'constraints' => 
          array (
            'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
            'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
            'id' => '[0-9]',
          ),
          'defaults' => 
          array (
            '__NAMESPACE__' => 'Users\\Controller',
            'controller' => 'UserManager',
            'action' => 'index',
          ),
        ),
      ),
      'upload-manager' => 
      array (
        'type' => 'Segment',
        'options' => 
        array (
          'route' => '/users/upload-manager[/:action[/:id]]',
          'constraints' => 
          array (
            'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
            'id' => '[0-9]',
          ),
          'defaults' => 
          array (
            '__NAMESPACE__' => 'Users\\Controller',
            'controller' => 'UploadManager',
            'action' => 'index',
          ),
        ),
      ),
      'group-chat' => 
      array (
        'type' => 'Segment',
        'options' => 
        array (
          'route' => '/group-chat[/:action[/:id]]',
          'constraints' => 
          array (
            'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
            'id' => '[a-zA-Z0-9_-]*',
          ),
          'defaults' => 
          array (
            'controller' => 'Users\\Controller\\GroupChat',
            'action' => 'index',
          ),
        ),
      ),
      'media' => 
      array (
        'type' => 'Segment',
        'options' => 
        array (
          'route' => '/media[/:action[/:id[/:subaction]]]',
          'constraints' => 
          array (
            'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
            'id' => '[a-zA-Z0-9_-]*',
            'subaction' => '[a-zA-Z][a-zA-Z0-9_-]*',
          ),
          'defaults' => 
          array (
            'controller' => 'Users\\Controller\\MediaManager',
            'action' => 'index',
          ),
        ),
      ),
      'search' => 
      array (
        'type' => 'Segment',
        'options' => 
        array (
          'route' => '/search[/:action]',
          'constraints' => 
          array (
            'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
            'id' => '[a-zA-Z0-9_-]*',
          ),
          'defaults' => 
          array (
            'controller' => 'Users\\Controller\\Search',
            'action' => 'index',
          ),
        ),
      ),
      'store' => 
      array (
        'type' => 'Segment',
        'options' => 
        array (
          'route' => '/store[/:action]',
          'constraints' => 
          array (
            'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
            'id' => '[a-zA-Z0-9_-]*',
          ),
          'defaults' => 
          array (
            'controller' => 'Users\\Controller\\Store',
            'action' => 'index',
          ),
        ),
      ),
      'html5' => 
      array (
        'type' => 'Segment',
        'options' => 
        array (
          'route' => '/html[/:controller[/:action]]',
          'constraints' => 
          array (
            'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
            'id' => '[a-zA-Z0-9_-]*',
          ),
          'defaults' => 
          array (
            'controller' => 'HTML5\\Controller\\Index',
            'action' => 'index',
          ),
        ),
      ),
      'contact' => 
      array (
        'type' => 'segment',
        'options' => 
        array (
          'route' => '/contact[/:action]',
          'constraints' => 
          array (
            'action' => '[a-zA-Z0-9][a-zA-Z0-9_-]*',
          ),
          'defaults' => 
          array (
            'controller' => 'Contact\\Controller\\Index',
            'action' => 'index',
          ),
        ),
      ),
      'album-index' => 
      array (
        'type' => 'Segment',
        'options' => 
        array (
          'route' => '/album-index[/][:action][/][:id]',
          'constraints' => 
          array (
            'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
            'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
            'id' => '[0-9]*',
          ),
          'defaults' => 
          array (
            'controller' => 'Album\\Controller\\Index',
            'action' => 'index',
          ),
        ),
      ),
      'huser' => 
      array (
        'type' => 'Segment',
        'options' => 
        array (
          'route' => '/huser[/][:action].html',
          'constraints' => 
          array (
            'action' => '[a-zA-Z0-9][a-zA-Z0-9_-]*',
          ),
          'defaults' => 
          array (
            '__NAMESPACE__' => 'Huser\\Controller',
            'controller' => 'User',
            'action' => 'register',
          ),
        ),
      ),
      'huser-center' => 
      array (
        'type' => 'Segment',
        'options' => 
        array (
          'route' => '/user-center[/:action].html',
          'defaults' => 
          array (
            '__NAMESPACE__' => 'Huser\\Controller',
            'controller' => 'HuserController',
            'action' => 'index',
          ),
        ),
      ),
      'sample' => 
      array (
        'type' => 'segment',
        'options' => 
        array (
          'route' => '/restful[/:controller][/:action]',
          'constraints' => 
          array (
            'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
            'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
          ),
          'defaults' => 
          array (
            '__NAMESPACE__' => 'Restful\\Controller',
            'controller' => 'Index',
            'action' => 'index',
          ),
        ),
      ),
      'dao' => 
      array (
        'type' => 'segment',
        'options' => 
        array (
          'route' => '/dao[/:controller][/:action][/:id]',
          'constraints' => 
          array (
            'controller' => '[a-zA-Z0-9][a-zA-Z0-9-_]*',
            'action' => '[a-zA-Z0-9][a-zA-Z0-9-_]*',
            'id' => '[0-9]*',
          ),
          'defaults' => 
          array (
            '__NAMESPACE__' => 'DAO\\Controller',
          ),
        ),
      ),
      'authentication' => 
      array (
        'type' => 'Literal',
        'options' => 
        array (
          'route' => '/authentication',
          'defaults' => 
          array (
            '__NAMESPACE__' => 'Authentication\\Controller',
            'controller' => 'Index',
            'action' => 'login',
          ),
        ),
        'may_terminate' => true,
        'child_routes' => 
        array (
          'default' => 
          array (
            'type' => 'Segment',
            'options' => 
            array (
              'route' => '[/:action]',
              'constraints' => 
              array (
                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
              ),
              'defaults' => 
              array (
              ),
            ),
          ),
        ),
      ),
    ),
  ),
  'service_manager' => 
  array (
    'invokables' => 
    array (
      'ExampleService' => 'Application\\Service\\Example',
      'DAO_Connector' => 'DAO\\Db\\Connection\\Connector',
      'DAO_Mapper_Cards' => 'DAO\\Db\\Mapper\\Cards',
      'AuthenService' => 'Authentication\\Service\\Authentication',
    ),
    'factories' => 
    array (
      'translator' => 'Zend\\I18n\\Translator\\TranslatorServiceFactory',
      'Zend\\Session\\Config\\ConfigInterface' => 'Zend\\Session\\Service\\SessionConfigFactory',
      'Zend\\Session\\Storage\\StorageInterface' => 'Zend\\Session\\Service\\SessionStorageFactory',
      'Zend\\Session\\ManagerInterface' => 'Zend\\Session\\Service\\SessionManagerFactory',
      'UserModuleOptions' => 'Huser\\Service\\Factory\\UserModuleOptions',
      'ViewXmlStrategy' => 'Restful\\Service\\ViewXmlStrategyFactory',
      'ViewXmlRenderer' => 'Restful\\Service\\ViewXmlRendererFactory',
      'Zend\\Db\\Adapter\\Adapter' => 'Zend\\Db\\Adapter\\AdapterServiceFactory',
    ),
    'abstract_factories' => 
    array (
      0 => 'Zend\\Session\\Service\\ContainerAbstractServiceFactory',
    ),
  ),
  'session_config' => 
  array (
    'remember_me_seconds' => 3600,
    'name' => 'some_name',
  ),
  'session_storage' => 
  array (
    'type' => 'SessionArrayStorage',
    'options' => 
    array (
    ),
  ),
  'session_containers' => 
  array (
    0 => 'ContainerOne',
    1 => 'ContainerTwo',
  ),
  'translator' => 
  array (
    'locale' => 'en_US',
    'translation_file_patterns' => 
    array (
      0 => 
      array (
        'type' => 'gettext',
        'base_dir' => 'E:\\zendframework\\zf-app\\module\\Application\\config/../language',
        'pattern' => '%s.mo',
      ),
      1 => 
      array (
        'type' => 'ini',
        'base_dir' => 'E:\\zendframework\\zf-app\\module\\SampleModule\\config/../language',
        'pattern' => '%s.ini',
      ),
    ),
  ),
  'controllers' => 
  array (
    'invokables' => 
    array (
      'Application\\Controller\\Index' => 'Application\\Controller\\IndexController',
      'Application\\Controller\\Greeting' => 'Application\\Controller\\GreetingController',
      'Users\\Controller\\Index' => 'Users\\Controller\\IndexController',
      'Users\\Controller\\Login' => 'Users\\Controller\\LoginController',
      'Users\\Controller\\UserManager' => 'Users\\Controller\\UserManagerController',
      'Users\\Controller\\UploadManager' => 'Users\\Controller\\UploadManagerController',
      'Users\\Controller\\GroupChat' => 'Users\\Controller\\GroupChatController',
      'Users\\Controller\\MediaManager' => 'Users\\Controller\\MediaManagerController',
      'Users\\Controller\\Search' => 'Users\\Controller\\SearchController',
      'Users\\Controller\\Store' => 'Users\\Controller\\StoreController',
      'HTML5\\Controller\\Index' => 'HTML5\\Controller\\IndexController',
      'Contact\\Controller\\Index' => 'Contact\\Controller\\IndexController',
      'Album\\Controller\\Index' => 'Album\\Controller\\IndexController',
      'Album\\Controller\\Album' => 'Album\\Controller\\AlbumController',
      'Album\\Controller\\Test' => 'Album\\Controller\\TestController',
      'HBase\\Controller\\Index' => 'HBase\\Controller\\IndexController',
      'SampleModule\\Controller\\Index' => 'SampleModule\\Controller\\IndexController',
      'Restful\\Controller\\Index' => 'Restful\\Controller\\IndexController',
      'Restful\\Controller\\People' => 'Restful\\Controller\\PeopleController',
      'DAO\\Controller\\Cards' => 'DAO\\Controller\\CardsController',
      'Authentication\\Controller\\Index' => 'Authentication\\Controller\\IndexController',
    ),
    'factories' => 
    array (
      'Application\\Controller\\GreetingController' => 
      Closure::__set_state(array(
      )),
    ),
  ),
  'view_manager' => 
  array (
    'display_not_found_reason' => true,
    'display_exceptions' => true,
    'doctype' => 'HTML5',
    'not_found_template' => 'error/404',
    'exception_template' => 'error/index',
    'template_map' => 
    array (
      'layout/layout' => 'E:\\zendframework\\zf-app\\module\\Application\\config/../view/layout/layout.phtml',
      'application/index/index' => 'E:\\zendframework\\zf-app\\module\\Application\\config/../view/application/index/index.phtml',
      'error/404' => 'E:\\zendframework\\zf-app\\module\\Application\\config/../view/error/404.phtml',
      'error/index' => 'E:\\zendframework\\zf-app\\module\\Application\\config/../view/error/index.phtml',
      'layout/myaccount' => 'E:\\zendframework\\zf-app\\module\\Users\\config/../view/layout/myaccount-layout.phtml',
      'huser-layout' => 'E:\\zendframework\\zf-app\\module\\Huser\\config/../view/layout/huser-layout.phtml',
    ),
    'template_path_stack' => 
    array (
      0 => 'E:\\zendframework\\zf-app\\module\\Application\\config/../view',
      'users' => 'E:\\zendframework\\zf-app\\module\\Users\\config/../view',
      'html' => 'E:\\zendframework\\zf-app\\module\\HTML5\\config/../view',
      'contact' => 'E:\\zendframework\\zf-app\\module\\Contact\\config/../view',
      'album' => 'E:\\zendframework\\zf-app\\module\\Album\\config/../view',
      1 => 'E:\\zendframework\\zf-app\\module\\Huser\\config/../view',
      2 => 'E:\\zendframework\\zf-app\\module\\SampleModule\\config/../view',
      'restful' => 'E:\\zendframework\\zf-app\\module\\Restful\\config/../view',
      'dao' => 'E:\\zendframework\\zf-app\\module\\DAO\\config/../view',
      'zenddevelopertools' => 'E:\\zendframework\\zf-app\\module\\ZendDeveloperTools\\config/../view',
      3 => 'E:\\zendframework\\zf-app\\module\\Authentication\\config/../view',
    ),
    'strategies' => 
    array (
      0 => 'ViewXmlStrategy',
    ),
  ),
  'controller_plugins' => 
  array (
    'invokables' => 
    array (
      'authService' => 'Users\\Controller\\Plugin\\AuthPlugin',
    ),
  ),
  'module_config' => 
  array (
    'upload_location' => 'E:\\zendframework\\zf-app\\module\\Users\\config/../data/uploads',
    'image_upload_location' => 'E:\\zendframework\\zf-app\\module\\Users\\config/../data/images',
    'search_index' => 'E:\\zendframework\\zf-app\\module\\Users\\config/../data/search_index',
  ),
  'speck-paypal-api' => 
  array (
    'username' => '',
    'password' => '',
    'signature' => '',
    'endpoint' => 'https://api-3t.sandbox.paypal.com/nvp',
  ),
  'h_user' => 
  array (
    'disabled_register' => true,
    'disabled_login' => false,
  ),
  'view_helper' => 
  array (
    'invokables' => 
    array (
      'comments' => 'Restful\\View\\Helper\\Comments',
    ),
  ),
  'dao' => 
  array (
    'hostname' => 'localhost',
    'username' => 'root',
    'password' => 'root',
    'database' => 'book',
    'mapper' => 
    array (
      'Cards' => 'cards',
    ),
  ),
  'db' => 
  array (
    'driver' => 'Pdo',
    'database' => ':memory:',
    'dsn' => 'mysql:dbname=zf_app;host=localhost',
    'username' => 'root',
    'password' => 'root',
    'driver_options' => 
    array (
      1002 => 'SET NAMES \'UTF8\'',
    ),
  ),
  'zenddevelopertools' => 
  array (
    'profiler' => 
    array (
      'enabled' => true,
      'strict' => true,
      'flush_early' => false,
      'cache_dir' => 'data/cache',
      'matcher' => 
      array (
      ),
      'collectors' => 
      array (
      ),
    ),
    'events' => 
    array (
      'enabled' => true,
      'collectors' => 
      array (
      ),
      'identifiers' => 
      array (
      ),
    ),
    'toolbar' => 
    array (
      'enabled' => true,
      'auto_hide' => false,
      'position' => 'bottom',
      'version_check' => false,
      'entries' => 
      array (
      ),
    ),
  ),
);