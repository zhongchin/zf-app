<?php
namespace Huser\Options;

Trait  UserModuleOptionsTrait
{
    protected  $userModuleOptions;
 
    public function setUserMoudleOptions(\Huser\Options\UserModuleOptions $userModuleOptions){
         $this->userModuleOptions=$userModuleOptions;                 
    }
    public function getUserModuleOptions(){
        return $this->userModuleOptions;
    }
    
    
}


