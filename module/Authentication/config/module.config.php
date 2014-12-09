<?php
return array(
    // Make our controller invokable
    'controllers' => array(
        'invokables' => array(
            'Authentication\Controller\Index' => 'Authentication\Controller\IndexController'
        ),
    ),
  'router'=>array(
     'routes'=>array(
         'authentication'=>array(
             'type'=>'Literal',
             'options'=>array(
                 'route'=>'/authentication',
                 'defaults'=>array(
                     '__NAMESPACE__'=>'Authentication\Controller',
                     'controller'=>'Index',
                     'action'=>'login'
                 )
             ),
             'may_terminate'=>true,
             'child_routes'=>array(
                 'default'=>array(
                     'type'=>'Segment',
                     'options'=>array(
                        'route'=>'[/:action]',
                         'constraints'=>array(
                             'action'=>'[a-zA-Z][a-zA-Z0-9_-]*',
                         ),
                         'defaults'=>array(),
                     )
                 )
             )
         )
     )
   ),
  'db'=>array(
      'driver' => 'Pdo_Sqlite',
      'database' => ':memory:',
  ),
  "service_manager"=>array(
     'invokables'=>array(
         'AuthenService'=>"Authentication\Service\Authentication"
     )
   ),
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
);