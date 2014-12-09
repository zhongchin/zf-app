<?php
namespace EventManager;

chdir(dirname(__DIR__));

// Setup autoloading
require 'init_autoloader.php';
use Zend\EventManager\EventManager;


     $eventManager=new EventManager;
     $eventManager->attach("click",function(\Zend\EventManager\Event $event){
         echo "click";
         var_dump($event->getTarget());
     });
     $p=new \stdClass();
     $p->name="hello";
//     $eventManager->attach("click",$p,array("name"=>"php"),function(){
//         echo "click";
//     });
     $eventManager->attach("click",function(){
         echo "click2s";
     });
   //  $eventManager->trigger("click");
     echo "<br/>";
     $eventManager->trigger("click",$p,array("name"=>"php"),function(){
        echo "click end<br/>"; 
     });
