<?php
namespace Contact;

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
                "error_msg"=>"Contact\View\Helper\ErrorMsg"
            )
        );
    }
    public function getServiceConfig(){
        return array(
            'factories'=>array(
                'Logger'=>function($sm){
                   $logger=new \Zend\Log\Logger;
                   $writer=new \Zend\Log\Writer\Stream('data.log');
                   $logger->addWriter($writer);
                   return $logger;
                },
                'Contact\Model\Contact'=>function($sm){
                     $dbAdapter=$sm->get("Zend\Db\Adapter\Adapter");
                     $contact=new \Contact\Model\Contact($dbAdapter);
                     $log=$sm->get("Logger");
                     $eventManager=$contact->getEventManager();
                     $eventManager->attach('event.insert',function($e) use ($log){
                          $event=$e->getName();
                          $log->info("{$event} event triggered");
                     });                    
                     $eventManager->attach('event.edit',function($e)use($log){
                          $event=$e->getName();
                          $log->info("{$event} event triggered");
                     });
                     $eventManager->attach('event.delete',function($e)use ($log){
                         $event=$e->getName();
                         $log->info("{$event} event triggered");
                     });
                     return $contact;
                }
            )
        );
    }
}
