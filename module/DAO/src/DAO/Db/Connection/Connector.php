<?php
/**
 * Created by PhpStorm.
 * User: tao.huang
 * Date: 14-12-6
 * Time: 上午9:27
 */
namespace DAO\Db\Connection;

use Zend\Db\Adapter\Adapter;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class Connector implements  ServiceLocatorAwareInterface
{
      protected $serviceLocator;
      public function setServiceLocator(ServiceLocatorInterface $serviceLocator){
           $this->serviceLocator=$serviceLocator;
      }
     public function getServiceLocator(){
         return $this->serviceLocator;
     }
      public function  initialize(){
         $dao=$this->getServiceLocator()->get("config");
         $configItems=array(
             'hostname',
             'username',
             'database',
             'password'
         );
          foreach($configItems as $required){
                if(!in_array($required,array_keys($dao['dao']))){
                     throw new \Exception("{$required} is not in the DAO configuration!");
                }
              return new Adapter(array(
                  'driver'=>'Pdo_Mysql',
                  'database'=>$dao['dao']['database'],
                  'hostname'=>$dao['dao']['hostname'],
                  'username'=>$dao['dao']['username'],
                  'password'=>$dao['dao']['password'],

              ));

          }
      }
}