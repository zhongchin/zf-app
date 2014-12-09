<?php

namespace SampleModule\Controller;

use SampleModule\Form\Element\Video;
use Zend\EventManager\EventManager;
use Zend\EventManager\EventManagerInterface;
use Zend\Mail\Message;
use Zend\Mail\Protocol\Smtp;
use Zend\Mail\Transport\Sendmail;
use Zend\Mail\Transport\SmtpOptions;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public $il8n;
     public function setEventManager(EventManagerInterface $events){
        parent::setEventManager($events);
           $c=$this;
         $events->attach("dispatch",function($e)  use ($c){
               $c->il8n=$this->getServiceLocator()->get("translator");
               $c->il8n->setLocale("zh_CN");
         },100);
         return $this;
     }
    public function indexAction()
    {
        $message= new Message();
        $message->addFrom("zhongchin123@163.com")
                ->addTo("zhongchin123@gmail.com")
                ->setSubject("watch and learn")->setBody("test email use of zend email");

        $sendmail=new Sendmail();
        if($message->isValid()===true){
            $sendmail->send($message);
        }
        return new ViewModel();
    }
    //测试使用SMTP发送邮件
    public function mailAction(){
        $message=new Message();
        $message->addTo("zhongchin123@163.com");
        $message->addFrom("zhongchin123@gmail.com");
        $message->setSubject("an example email");
        $message->setBody("this is a test message");

         $smtp=new Smtp();
        $smtp->setOptions(new SmtpOptions(
            array(
                'name'=>'163.com',
                'host'=>'smtp.163.com',
                'port'=>'25',
                'connection_class'=>'login',
                'connection_config'=>array(
                    'username'=>'zhongchin123@163.com',
                    'password'=>'(ht)921053538'
                )
            )));
        $smtp->send($message);
          exit();
    }
    public function videoAction(){
         $video=new Video();
        $video->setAttribute('src',array(
            'http://www.56.com/u46/v_MzA1NjUwNzU.html',
            'http://www.w3schools.com/html/mov_bbb.ogg',
        ));
        $video->setAttribute('autoplay',true);
        return  new ViewModel(array('video'=>$video));
    }
    public function cacheOneAction(){

    }
    public function cacheTwoAction(){

    }
}


