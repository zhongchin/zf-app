<?php

namespace Authentication\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\View;

class IndexController extends AbstractActionController
{

    public function indexAction()
    {
        return new ViewModel();
    }
    public function loginAction(){
       if($this->params()->fromPost("username")!==null){
            $done=$this->getServiceLocator()->get("AuthenService")
                        ->authentication(
                         $this->params()->fromPost("user"),
                         $this->params()->fromPost("password"));
           if($done===true){
               $this->redirect()->toRoute("application");
           }else{
               echo "Useranme or password unknow!";
           }
       }

        return new ViewModel();
    }
    public  function logoutAction(){
        $this->getServiceLocator()->get("AuthenService")->logout();
        return $this->redirect()->toRoute("authentication");
    }

}

