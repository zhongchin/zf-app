<?php
namespace HgEventManager;
chdir(dirname(__DIR__));

// Setup autoloading
require 'init_autoloader.php';

 $eventManager=new \Zend\EventManager\EventManager();
 $eventManager->attach("click",  function (\Zend\EventManager\Event $event){
      echo "click <br/>";
 });

 $sharedEventManager=new \Zend\EventManager\SharedEventManager();
 $sharedEventManager->attach(__NAMESPACE__, "click", function(){
     echo __NAMESPACE__."click";//共享事件管理器为了不与其他事件冲突
 });
 $eventManager->setSharedManager($sharedEventManager);
 $eventManager->setIdentifiers(__NAMESPACE__);
 $eventManager->trigger("click");
 
 $eventManager->getSharedManager();