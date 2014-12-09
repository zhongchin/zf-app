<?php
/**
 * Created by PhpStorm.
 * User: tao.huang
 * Date: 14-12-8
 * Time: 下午1:37
 */

namespace Authentication\Service;


use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Storage\Session;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use  Zend\Authentication\Adapter\DbTable as AuthDbTable;

class Authentication implements  ServiceLocatorAwareInterface
{
    private $serviceLocator;

    public function getServiceLocator(){
         return $this->serviceLocator;
    }
     public function setServiceLocator(ServiceLocatorInterface $serviceLocator){
          $this->serviceLocator=$serviceLocator;
     }
     public function isAuthentication(){
          $session=new Session("ok");
                  return false;
     //   return !$session->isEmpty();
     }
    public function authentication($username,$password){
         $authentication=new AuthDbTable($this->getServiceLocator()->get('Zend\Db\Adapter\Adapter'), 'user','name','password');
         $result=$authentication->setIdentity($username)->setCredential(md5($password))->authenticate();

        if($result->isValid()===true){
            $session=new Session("ok");
            $session->write($result->getIdentity());
        }
        return $result->isValid();
    }
    //获取验证信息
    public function getIdentity(){
          $session=new Session("ok");
         if($session->isEmpty()===true){
             return $session->read();
         }else{
             return false;
         }
    }
    //退出时清除session中的authenticate信息
     public function logout(){
         $session=new Session("ok");
         $session->clear();
     }
} 