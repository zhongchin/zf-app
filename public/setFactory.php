<?php
namespace HgService;
//define("ZF2_PATH", __DIR__."/../vendor/ZF2/libaray");
chdir(dirname(__DIR__));

// Setup autoloading
require 'init_autoloader.php';
//include "../init_autoloader.php";

class Student{
     public $url="http://www.kittencup.com";

    
}


$serviceManger= new \Zend\ServiceManager\ServiceManager();

//$serviceManger->setService("st",new Student());
$serviceManger->setInvokableClass("hg", "\HgService\Student",false);