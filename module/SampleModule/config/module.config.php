<?php
return array(
    "controllers"=>array(
        "invokables"=>array(
            "SampleModule\Controller\Index"=>"SampleModule\Controller\IndexController",
        )
    ),
    "router"=>array(
        "routes"=>array(
              'sample'=>array(
                  'type'=>'segment',
                  'options'=>array(
                      'route'=>'/sample[/:controller][/:action]',
                      'constraints'=>array(
                          'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                          'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                      ),
                      'defaults' => array(
                          '__NAMESPACE__' => 'SampleModule\Controller',
                          'controller'    => 'Index',
                          'action'        => 'index',
                      ),
                  ),
              )
        )
    ),
    "view_manager"=>array(
        "template_path_stack"=>array(
            __DIR__."/../view",
        ),
    ),
    'service_manager'=>array(
        'cache-service'=>function(){
          return \Zend\Cache\StorageFactory::factory(array(
               'adapter'=>array(
                   'name'=>'filesystem',
                   'options'=>array(
                       'cache_dir'=>'data/cache/',
                       'ttl'=>100
                   )
               )
          ));
       },
    ),
   'translator'=>array(
       'locale'=>'en_US',
       'translation_file_patterns'=>array(
           array(
               'type'=>'ini',
               'base_dir'=>__DIR__.'/../language',
               'pattern'=>'%s.ini'
           )
       )
   )
);