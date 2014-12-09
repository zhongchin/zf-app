<?php
namespace Huser\Listener;

class UserRegister implements \Zend\EventManager\ListenerAggregateInterface{
    
    use \Zend\EventManager\ListenerAggregateTrait;
    
    public function attach(\Zend\EventManager\EventManagerInterface $events) {
        $this->listeners[]=$events->getSharedManager()->attach("*", \Huser\Event\User::USER_REGISTER_PER,array($this,"checkUsername"));
        $this->listeners[]=$events->getSharedManager()->attach("*",\Huser\Event\User::USER_REGISTER_PER ,array($this,"regDate"));
        $this->listeners[]=$events->getSharedManager()->attach("*",\Huser\Event\User::USER_REGISTER_PER ,array($this,"regIp"));
    }
    public function checkUsername(\Zend\EventManager\EventInterface $event){
//          $serviceLocator=$event->getServiceLocator();
             $userEntity=$event->getUserEntity();
          if($userEntity->getName()==="admin"){
//              $event->stopPropagation();
                $form=$event->getForm();
                $username=$form->get("name");
                $username->setMessages(array_merge($username->getMessages(),array("用户名不能为admin")));
                return false;
          }
        //  var_dump($event->getForm());
    }
    public function regDate(\Zend\EventManager\EventInterface $event) {
         echo "regdate";
    }
    public function regIp(\Zend\EventManager\EventInterface $event) {
         echo "regIp";
    }
}

