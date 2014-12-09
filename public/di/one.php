<?php

 namespace oneNamespace
 {
 	class FirstClass{
 		private $secondClass;
		public function __construct(SecondClass $secondClass){
			  $this->secondClass=$secondClass;
		}
 	}
	class SecondClass{
	private $thirdclass;
	private $vehicle;
	public function __construct(ThirdClass $thirdClass,$vehicle){
		$this->thirdClass=$thirdClass;
		$this->vehicle=$vehicle;
	}
   }
 } 
 
 ?>