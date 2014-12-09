<?php
namespace HBase\Service\AbstractFactories;
use Zend\ServiceManager\AbstractFactoryInterface;

class Controller implements AbstractFactoryInterface{
    
    protected $controllerServiceNameKey="\Controller\\";
    
    public function canCreateServiceWithName(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator, $name, $requestedName) {
         echo strpos($this->controllerServiceNameKey,$requestedName)!==-1 && class_exists($requestedName."Controller");
       
    }
    public function createServiceWithName(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator, $name, $requestedName) {
        
    }
    
}

