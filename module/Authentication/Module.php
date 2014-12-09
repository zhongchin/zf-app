<?php
namespace Authentication;

use Zend\Debug\Debug;
use Zend\Mvc\ModuleRouteListener;
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
    public function onBootstrap(MvcEvent $e){
            $eventManager=$e->getApplication()->getEventManager();
            $moduleRouteListener=new ModuleRouteListener();
            $moduleRouteListener->attach($eventManager);
/*            $eventManager->attach(MvcEvent::EVENT_DISPATCH,function(MvcEvent $e){
                  if($e->getRouteMatch()->getMatchedRouteName()==="authentication"){
                       return ;
                  }
                  if($e->getApplication()->getServiceManager()->get("AuthenService")->isAuthentication()===false){
                        $response= $e->getResponse();
                        $response->getHeaders()->clearHeaders()->addHeaderLine("Location",'/authentication');
                        $response->setStatusCode(302)->sendHeaders();
                    exit;
                  }
            },1);*/
     /*       $eventManager->attach(MvcEvent::EVENT_ROUTE,function(MvcEvent $e){
                     $dbAdapter=$e->getApplication()->getServiceManager()->get("Zend\Db\Adapter\Adapter");
                     $result=$dbAdapter->query("SELECT name from sqlite_master  WHERE   type='table' and name='user'")->execute();
                 if($result->current()===false){
                    try{
                          $result=$dbAdapter->query("create table  'users'(
                            'id' int(10) NOT NULL,
                            'username' VARCHAR(20) NOT NULL,
                            'password' CHAR(32) NOT NULL,
                            PRIMARY KEY ('id')
                             )")->execute();
                        // Now insert some users
                        $dbAdapter->query("
                          INSERT INTO `users` VALUES
                          (1, 'admin', '". md5("adminpassword"). "')
                        ")->execute();
                        $dbAdapter->query("
                        INSERT INTO `users` VALUES
                        (2, 'test', '". md5("testpassword"). "')
                      ")->execute();
                     }catch (\Exception $e){
                           Debug::dump($e->getMessage());
                    }
                 }
            });*/

    }
}
