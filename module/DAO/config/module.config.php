<?php
return array(
      'dao'=>array(
          'hostname'=>'localhost',
          'username'=>'root',
          'password'=>'root',
          'database'=>'book',
          'mapper'=>array(
              'Cards'=>'cards'
          )
      ),
    'service_manager'=>array(
        'invokables'=>array(
            'DAO_Connector'=>'DAO\Db\Connection\Connector',
            'DAO_Mapper_Cards'=>'DAO\Db\Mapper\Cards'

        )
    ),
    'controllers'=>array(
        'invokables'=>array(
            'DAO\Controller\Cards'=> 'DAO\Controller\CardsController'
        )
    ),
    'router'=>array(
        'routes'=>array(
            'dao'=>array(
                'type'=>'segment',
                'options'=>array(
                    'route'=>'/dao[/:controller][/:action][/:id]',
                    'constraints'=>array(
                        'controller'=>'[a-zA-Z0-9][a-zA-Z0-9-_]*',
                        'action'=>'[a-zA-Z0-9][a-zA-Z0-9-_]*',
                        'id'=>'[0-9]*'
                    ),
                    'defaults'=>array(
                        '__NAMESPACE__'=>'DAO\Controller',

                    )
                )
            )
        )
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'dao' => __DIR__ . '/../view',
        ),

    ),

);