<?php
namespace Huser\Options;
use Zend\Stdlib\AbstractOptions;

class UserModuleOptions extends AbstractOptions{
    
    const CONFIG_KEY="h_user";
    protected $disabledRegister;
    protected $disabledLogin;

    public function setDisabledLogin($disabledLogin){
        $this->disabledLogin=$disabledLogin;
       
    }
    public function getDisabledLogin(){
        return $this->disabledLogin;
    }
    public function setDisabledRegister($disableRegister){
        $this->disabledRegister=$disableRegister;
       
    }
    public function getDisabledRegister(){
        return $this->disabledRegister;
    }
    
}

