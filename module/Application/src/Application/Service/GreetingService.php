<?php
namespace Application\Service;
use Application\Repository\StaticGreetingRepository;
use Application\Service\GreetingServiceInterface;

class GreetingService implements  GreetingServiceInterface
{
	 	
	 protected $repository;
	 
	 public function __construct(StaticGreetingRepository $repository){
	 	 $this->repository=$repository;
	 }
	 public function greet($name){
	 	return $this->repository->getRandomGreeting()." ".$name."!";
	 }
}






?>