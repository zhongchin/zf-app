<?php
namespace Application\Repository;

class StaticGreetingRepository{
	
	protected $availableGreetings=array(
			"Hi","hello","go","on"
	);
	public function getRandomGreeting(){
		return $this->availableGreetings[array_rand($this->availableGreetings)];
	}
}

