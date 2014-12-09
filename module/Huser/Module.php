<?php
namespace Huser;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\DependencyIndicatorInterface;
use Zend\ModuleManager\Feature\BootstrapListenerInterface;

class Module implements ConfigProviderInterface,  AutoloaderProviderInterface,  DependencyIndicatorInterface, BootstrapListenerInterface
{
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getControllerConfig() {
         return array(
             "invokables"=>array(
                  "Huser\Controller\User"=>"Huser\Controller\UserController",
                  "Huser\Controller\UserCenter"=>"Huser\Controller\UserCenterController",
             ),
             'initializers'=>array(
                 "Huser\Service\Initializer\UserModuleOptions"
             ),

         );
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
    public function getModuleDependencies() {
        return array();
    }
    
    public function onBootstrap(\Zend\EventManager\EventInterface $e) {
        $application=$e->getApplication();
        $eventManager=$application->getEventManager();
//          $shareEventManager=$eventManager->getSharedManager();
//          $shareEventManager->attach("*","user.register.pre",function(){
//                echo "hhhhh";    
//                exit();
//          });
             $eventManager->attach(new \Huser\Listener\UserRegister);
//          $eventManager->attach(\Zend\Mvc\MvcEvent::EVENT_DISPATCH,function(\Zend\EventManager\EventInterface $e){
//                 $e->getTarget()->layout("huser-layout");
//          });
       $eventManager->getSharedManager()->attach(__NAMESPACE__,  \Zend\Mvc\MvcEvent::EVENT_DISPATCH,function($e){
           echo __NAMESPACE__;
           $e->getTarget()->layout("huser-layout");
       });      
          
    }
}
