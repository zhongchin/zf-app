<?php
namespace HgService;
//define("ZF2_PATH", __DIR__."/../vendor/ZF2/libaray");
chdir(dirname(__DIR__));

// Setup autoloading
require 'init_autoloader.php';
//include "../init_autoloader.php";

class Student{
     public $url="http://www.kittencup.com";
   
     public function __construct($url) {
         $this->url=$url;
    }
    
}
class WebFactory implements \Zend\ServiceManager\FactoryInterface{
    //服务定位
    //mvc里面不仅仅有servicemanager controller plugin manager helper plugin manager
    //view $this->getSeriveLocator()
    //controller plugin  你去getServiceMnager 得到的事controlller plugin manager
     public function createService(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator) {
         $st=new Student("world");
         return $st;
     }
     
    
}

$serviceManger= new \Zend\ServiceManager\ServiceManager();//若果一个类不能被实例化
 $serviceManger->setFactory("hg", function(){
       $url=new Student("hlloe");
       return $url;
 });
 $serviceManger->setFactory("kp", "\HgService\WebFactory");
 
 echo $serviceManger->get("hg")->url;
 echo "<br/>";
 echo $serviceManger->get("kp")->url;