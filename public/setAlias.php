<?php
namespace HgService;
//define("ZF2_PATH", __DIR__."/../vendor/ZF2/libaray");
chdir(dirname(__DIR__));

// Setup autoloading
require 'init_autoloader.php';
//include "../init_autoloader.php";

class Student{
     public $url="http://www.kittencup.com";

    
}
class HgAbstractFactory implements \Zend\ServiceManager\AbstractFactoryInterface{
    
    public function canCreateServiceWithName(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator, $name, $requestedName) {
       
        return $name==="abcdef";
    }
    public function createServiceWithName(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator, $name, $requestedName) {
        //echo $name,$requestedName;
        $obj=new \stdClass();
        $obj->name=$requestedName;
        return $obj;
    }
}

  $serviceManager=new \Zend\ServiceManager\ServiceManager();
  $serviceManager->addAbstractFactory("\HgService\HgAbstractFactory");
//  $serviceManager->get("abcdef");
echo   $serviceManager->get("abcdef")->name;