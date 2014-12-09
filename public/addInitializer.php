<?php
namespace HgService;
chdir(dirname(__DIR__));

require 'init_autoloader.php';
//include "../init_autoloader.php";

class Student{
     public $url="http://www.kittencup.com";
}
 class HgInitialize implements \Zend\ServiceManager\InitializerInterface{
     public function initialize($instance, \Zend\ServiceManager\ServiceLocatorInterface $serviceLocator) {
         if($instance instanceof Student){
              $instance->url="http://www.zned.com";
              echo "fdas";
              return true;
         }  else {
             var_dump($instance);
         }
     }
 }

$serviceManger= new \Zend\ServiceManager\ServiceManager();

//$serviceManger->setService("hg",new Student());
$serviceManger->setInvokableClass("hg", "\HgService\Student");

$serviceManger->addInitializer("\HgService\HgInitialize");
echo $serviceManger->get("hg")->url;