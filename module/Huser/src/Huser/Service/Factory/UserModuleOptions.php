<?php
namespace Huser\Service\Factory;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\FactoryInterface;
use Huser\Options\UserModuleOptions as HuserModuleOptions;

class UserModuleOptions implements FactoryInterface{

    public function createService(ServiceLocatorInterface  $serviceLocator){
        $config=$serviceLocator->get("config");
  
        $userConfig=  isset($config[HuserModuleOptions::CONFIG_KEY])?$config[HuserModuleOptions::CONFIG_KEY]:array();
        return new HuserModuleOptions($userConfig);
        
    }
    
}