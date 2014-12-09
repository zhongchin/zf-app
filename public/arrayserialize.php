<?php
namespace Hydrator;
chdir(dirname(__DIR__));

// Setup autoloading
require 'init_autoloader.php';
use Zend\Stdlib\Hydrator\ArraySerializable;
use Zend\Stdlib\Hydrator\ClassMethods;

$studentArr=array(
    "id"=>10,
    "name"=>"掌聲"
);
class Student{
        protected $id;

        protected $name;

        public function getId(){
          return $this->id;
        }
        public function getName(){
            return $this->name;
        }
        public  function setId($id){
            $this->id=$id;
        }
        public function setName($name){
            $this->name=$name;
        }
      public function exchangeArray($data){
            $this->id=  isset($data["id"])?$data["id"]:0;
            $this->name=  isset($data["name"])?$data["name"]:0;
        }
         public function getArrayCopy(){
            return get_object_vars($this);
        }
  /*  
   */
}

//    $hydrator=new ArraySerializable();
//    $studentArr=$hydrator->hydrate($studentArr,new Student);
//    var_dump($studentArr);
//    $attr=$hydrator->extract($studentArr);
//
//    var_dump($attr);
/*
   $hydrator=new ClassMethods();
   $studentObject=$hydrator->hydrate($studentArr, new Student);
   
   
   $stu=$hydrator->extract($studentObject);
   
   var_dump($stu);
  
 * 
 */
     $hydrator=new ArraySerializable();
     $hydrator->addStrategy("id", new \Zend\Stdlib\Hydrator\Strategy\ClosureStrategy(function($value){
            return $value."extract";
     },function($value){
         return $value."hydrate";
     }));
   
     $studentObject=$hydrator->hydrate($studentArr,new Student);
     
     var_dump($studentObject);
     var_dump($hydrator->extract($studentObject));
     
   





