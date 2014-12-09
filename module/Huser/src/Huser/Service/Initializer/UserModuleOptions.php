<?php
namespace Huser\Service\Initializer;
use Zend\ServiceManager\InitializerInterface;
use Zend\ServiceManager\ServiceLocatorInterface;


class UserModuleOptions implements InitializerInterface
{
    public function initialize($instance,  ServiceLocatorInterface $serviceLocator) {
        
        if($instance instanceof \Huser\Options\UserModuleOptionsAwareInterface){
            
            $userModuleOptions =$serviceLocator->getServiceLocator()->get("UserModuleOptions");
           $instance->setUserMoudleOptions($userModuleOptions);
        }
        
    }
    
}

