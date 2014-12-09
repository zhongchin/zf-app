<?php

namespace Huser\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class UserController extends AbstractActionController implements \Huser\Options\UserModuleOptionsAwareInterface
{
//    protected  $userModuleOptions;
//    
//    public function setUserMoudleOptions(\Huser\Service\Initializer\UserModuleOptions $userModuleOptions) {
//        $this->userModuleOptions=$userModuleOptions;
//     }
//     public function getUserModuleOptions() {
//        return $this->userModuleOptions;  
//     }
    use \Huser\Options\UserModuleOptionsTrait;
    
    public function disabledRegister(){
        
    }
    public function indexAction()
    {
        return new ViewModel();
    }
    public function disabledregisterAction(){
        
    }
    public function registerAction(){
        //var_dump($this->userModuleOptions);
         $form=new \Users\Form\RegisterForm();
         $request=$this->getRequest();
         
         if($request->isPost()){
            
              $parameters=$request->getPost();
              $form->setData($parameters);
              $form->setInputFilter(new \Users\Filter\RegisterFilter);
              if($form->isValid()){
                    $userEntity=$form->getData();
                    $userEvent=new \Huser\Event\User();
//                    $userEvent->setForm($form->setUser);
                  $userEvent->setForm($form)->setUserMoudleOptions($this->userModuleOptions)->setUserEntity($userEntity)->setServiceLocator($this->serviceLocator);
                  $responseCollection= $this->getEventManager()->trigger(\Huser\Event\User::USER_REGISTER_PER, $userEvent,function($callbackReturn){
                      return $callbackReturn===FALSE;
                  });
                 
                  if($responseCollection->stopped()){
                       echo $userEvent->propagationIsStopped();
                  }
//                   $this->getEventManager()->attach(\Huser\Event\User::USER_REGISTER_PER,$this,array("form"=>$form));
               //   var_dump($userEvent);
              }
            
            
         }
         return array("form"=>$form);   
    }
    public function loginAction(){
        
    }

}

