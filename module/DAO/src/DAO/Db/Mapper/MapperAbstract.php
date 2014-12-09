<?php
/**
 * Created by PhpStorm.
 * User: tao.huang
 * Date: 14-12-6
 * Time: 上午9:29
 */
namespace DAO\Db\Mapper;

use Zend\Db\Sql\Sql;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class MapperAbstract implements ServiceLocatorAwareInterface
{
      private    $sqlObject;
      protected  $serviceLocator;
      public function getServiceLocator(){
            return $this->serviceLocator;
      }
      public function setServiceLocator(ServiceLocatorInterface $serviceLocator){

           if(!$this->serviceLocator){
               $this->serviceLocator=$serviceLocator;
           }
      }
      public function getSqlObject(){
         if($this->connection===null){
            $config=$this->getServiceLocator()->get('config');
             $class=explode('\\',get_class($this));
             if(isset($config['dao']['mapper'])===true&&isset($config['dao']['mapper'][end($class)])){
                  $adapter=$this->getServiceLocator()->get('DAO_Connector')->initialize();
                  $this->sqlObject=new Sql($adapter,$config['dao']['mapper'][end($class)]);
             }else{
                  throw new \Exception('Configuration dao\mapper\\'.end($class)." not set.");
             }
             return $this->sqlObject;
         }
     }

}