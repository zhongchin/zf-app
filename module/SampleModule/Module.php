<?php
namespace SampleModule;

use Zend\Mvc\MvcEvent;

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
    public function getViewHelperConfig(){
         return array(
             'invokables'=>array(
                 'formVideo'=>'SampleModule\View\Helper\FormVideo'
             )
         );
    }
    public function onBootstrap(MvcEvent $event){
         $routes=array("index/cache-two","index/cache-one");
         $eventManager=$event->getApplication()->getEventManager();
         $serviceManager=$event->getApplication()->getServiceManager();
        $eventManager->attach(MvcEvent::EVENT_ROUTE,function($event) use ($serviceManager,$routes){
            $route=$event->getRouteMatch()->getMatchedRouteName();
            if(!in_array($route,$routes)){
                 return ;
            }
            $cache=$serviceManager->get("cache-service");
            $key="route-".$route;
            if($cache->hasItem($key)){
                $response=$event->getResponse();
                $response->setContent($cache->getItem($key));
                return $response;
            }
        },-1000);
          $eventManager->attach(MvcEvent::EVENT_RENDER,function($event) use ($serviceManager,$routes){
              $route=$event->getRouteMatch()->getMatchedRouteName();
              if(!in_array($route,$routes)){
                       return ;
              }
             $response=$event->getResponse();
              $cache=$serviceManager->get("cache-service");
              $key="route-".$route;
              $cache->setItem($key,$response->getContent());
          },-1000);
    }

}
