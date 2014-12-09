<?php
return array(
    "controllers"=>array(
        "invokables"=>array(
            "Restful\Controller\Index"=>"Restful\Controller\IndexController",
            "Restful\Controller\People"=>"Restful\Controller\PeopleController",
        )
    ),
    "router"=>array(
        "routes"=>array(
            'sample'=>array(
                'type'=>'segment',
                'options'=>array(
                    'route'=>'/restful[/:controller][/:action]',
                    'constraints'=>array(
                        'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Restful\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                    ),
                ),
            ),

        )
    ),
     'view_manager'=>array(
         'strategies'=>array(
             'ViewXmlStrategy',
         ),
         'template_path_stack' => array(
             'restful' => __DIR__ . '/../view',
         ),
     ),
    'service_manager'=>array(
        'factories'=>array(
            'ViewXmlStrategy'=>'Restful\Service\ViewXmlStrategyFactory',
            'ViewXmlRenderer'=>'Restful\Service\ViewXmlRendererFactory'
        )
    ),
    'view_helper'=>array(
        'invokables'=>array(
            'comments'=>'Restful\View\Helper\Comments'
        )
    )

);