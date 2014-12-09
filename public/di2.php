<?php
namespace oneNamespace;

	class FirstClass{
		private $secondClass;
		public function __construct(SecondClass $secondClass)
		{
			$this->secondClass = $secondClass;
		}
	}
	class SecondClass{
		
		private $thirdClass;
		private $vehicle;
		public function __construct(\AnotherNamespace\ThirdClass $thirdClass,$vehicle)
		{
			$this->thirdClass = $thirdClass;
			$this->vehicle = $vehicle;
		}
	  }

namespace AnotherNamespace;
	 class ThirdClass{
	 	private $first_name;
		private $last_name;
		public function __construct($first_name, $last_name)
		{
			$this->first_name = $first_name;
			$this->last_name = $last_name;
		}
	 }
	
 chdir(dirname(__DIR__));

// Setup autoloading
require 'init_autoloader.php';


/* $di= new \Zend\Di\Di();
  $lister=$di->get(
     "oneNamespace\FirstClass",
     array(
       "first_name"=>"jane",
       "last_name"=>"doe",
       "vehicle"=>"car"
	 )
  );*/
//   var_dump($lister);
   $configuration=array(
     "instance"=>array(
	   "SecondClass"=>array(
	     "parameters"=>array(
		   "vehicle"=>"Airplane",
		 )
	   ),
	   'FirstClass'=>array(
	      "parameters"=>array(
		     "first_name"=>"Neil",
		     "last_name"=>"deGra jj"
		  )
	    )
	 )
   );
   use \Zend\Di\Config;
   $diConfiguration=new Config($Configuration);
    $di= new \Zend\Di\Di($diConfiguration);
	
	$firstClass=$di->get("oneNameSpace\FirstClass");
	var_dump($firstClass);
?>