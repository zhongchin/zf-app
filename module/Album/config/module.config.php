<?php
return array(
    "controllers"=>array(
       "invokables"=>array(
           "Album\Controller\Index"=>"Album\Controller\IndexController",
           "Album\Controller\Album"=>"Album\Controller\AlbumController",
           "Album\Controller\Test"=>"Album\Controller\TestController"
       )   
    ),
    "router"=>array(
        //路由栈的结构
     
        //路由存储容器
      "routes"=>array(
          "album-index"=>array(
              "type"=>"Segment",
              "options"=>array(
                 "route"=>"/album-index[/][:action][/][:id]",
                  "constraints"=>array(
                      "controller"=>"[a-zA-Z][a-zA-Z0-9_-]*",
                      'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                      'id'=>'[0-9]*'
                  ),
                  'defaults'=>array(
                      "controller"=>"Album\Controller\Index",
                      'action'=>"index",
                  )
              )
          ),
//          "album"=>array(
//              "type"=>"Wildcard",
//              "options"=>array(
//                "key_value_delimiter"=>"~",
//                "param_delimiter"=>"/",
//                'defaults'=>array(
//                      "controller"=>"Album\Controller\Album",
//                      'action'=>"index",
//                  )
//              )
//          )

      ),
        //
   
    ),
    "view_manager"=>array(
        "template_path_stack"=>array(
            "album"=>__DIR__."/../view"
        )
    )
);