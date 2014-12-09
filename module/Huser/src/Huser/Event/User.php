<?php
namespace Huser\Event;

class User extends \Zend\EventManager\Event implements \Huser\Options\UserModuleOptionsAwareInterface,  \Zend\ModuleManager\Listener\ServiceListenerInterface

{
    
    const USER_REGISTER_PER="user.register.per";
    const USER_REGISTER_POST="user.register.post";
    const USR_REGISTER_FAIL="user.register.fail";
    
    public function setServiceLocator(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator){
        $this->setParam("serviceLocator", $serviceLocator);
        return $this;
    }
    public function getServiceLocator(){
         return $this->getParam("serviceLocator");
    }
    public function addServiceManager($serviceManager, $key, $moduleInterface, $method) {
        ;
    }
    public function setDefaultServiceConfig($configuration) {
        ;
    }
    public function setUserMoudleOptions(\Huser\Options\UserModuleOptions $userModuleOptions) {
          $this->setParam("UserModuleOptions",$userModuleOptions);
        return $this;
    }

    public function getUserModuleOptions(){
           return $this->getParam("UserModuleOptions");
    }

    public function setForm(\Zend\Form\FormInterface $form){
        $this->setParam("form", $form);
        return $this;
    }
    public function getForm(){
        return $this->getParam("form");
    }
    public function setUserEntity(\Huser\Entity\UserEntity $userEntity){
        $this->setParam("userEntity", $userEntity);
        return $this;
    }
    public function getUserEntity(){
        return $this->getParam("userEntity");
    }
    public function attach(\Zend\EventManager\EventManagerInterface $events) {
        ;
    }
    public function detach(\Zend\EventManager\EventManagerInterface $events) {
        ;
    }
    
    
}
    
