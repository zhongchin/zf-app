<?php

namespace Contact\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{

    public function indexAction()
    {
          $error=array(
              'hhh',
              'fdsafd'
          );
          $log=$this->getServiceLocator()->get("Logger");
          $log->info("hello zend log");
          
        return new ViewModel(array("error"=>$error));
    }
    public function fileUploadAction(){
        if($this->getRequest()->isPost()){
              $size=new \Zend\Validator\File\Size(array(
                  'min'=>'10KB','max'=>'10MB'
              ));
              $ext=new \Zend\Validator\File\ExcludeMimeType("pdf");
             
             $adapter =new \Zend\File\Transfer\Adapter\Http();
             $adapter->setDestination("public/uploads");
             $adapter->setValidators(array($size,$ext));
             
             $files=  $this->getRequest()->getFiles();
            if($adapter->receive($files['doc']['nmae'])){
                return new ViewModel(array('msg'=>$files['doc']['name']." uploaded!"));
            }else{
                 return new ViewModel(array("msg"=>$adapter->getMessages()));
            }
        }
    }


}

