<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Service\GreetingService;

class GreetingController extends AbstractActionController
{

   protected $greetingService;
   
    public function indexAction()
    {
        return new ViewModel();
    }
  
    public function __construct(GreetingService $greetingService){
    	 $this->greetingService=$greetingService;
    }
	public function  helloAction(){
		$name=$this->getRequest()->getQuery("name","anonymous");
		return new ViewModel(array("greeting"=>$this->greetingService->greet($name)));
	}
	
	

}

