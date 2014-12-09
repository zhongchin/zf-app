<?php
namespace DAO;

use Zend\ModuleManager\ModuleEvent;
use Zend\ModuleManager\ModuleManager;

class Module
{
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    public function init(ModuleManager $moduleManager){
         $eventManager=$moduleManager->getEventManager();
         $eventManager->attach(ModuleEvent::EVENT_LOAD_MODULES_POST,
             function(ModuleEvent $event){
                  echo "<pre>".$event->getModuleName()."</pre>";
             },-1000);
    }

}
