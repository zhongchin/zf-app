<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Application\Model\Hydrator\Strategy\SampleHydratorStrategy;
use Application\Model\SampleModel;
use Zend\Authentication\Adapter\Http\FileResolver;
use Zend\Authentication\Adapter\Http;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\View\Model\ViewModel;
use  Application\Model\SwagMachine;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {

/*        $machine=new SwagMachine();
        $machine->getEventManager()->attach("findSwag.begin",function(Event $e){
          return $e->getParam("id")+10;
        });
        $machine->getEventManager()->attach("findSwag.end",function(Event $e){
            echo "we are returning:".$e->getParam("returnValue");
        });
       echo $machine->findSwag(20);*/
        return new ViewModel();
    }
    public function viewAction(){

            $model=new SampleModel();
            $data=array(
                'id'=>'some id',
                'value' => 'Some Awesome Value',
                'description' => 'Pecunia non olet',
                'text'=>300
            );
             $hydrator= new ClassMethods();
             $hydrator->addStrategy('text',new SampleHydratorStrategy());
             $newObject= $hydrator->hydrate($data,$model);
             $extract=$hydrator->extract($newObject);
            echo "<pre>";
            print_r($extract);
            echo "</pre>";
            exit();
    }
    public function seAction(){
         $exampleService=$this->getServiceLocator()->get('ExampleService');
        echo $exampleService->encodeMyString('avdsagfg');
        exit();
    }
    public function auAction(){
          $basicResolver=new FileResolver();
          $basicResolver->setFile(__DIR__.'/some/file/with/credentials.txt');

        // digest file
//                 $digestResolver= new FileResolver();
//                 $digestResolver->setFile(__DIR__.'/some/other/with/credentials.txt');
                 $adapter= new Http();
                 $adapter->setBasicResolver($basicResolver);

          var_dump($adapter);
           exit();
    }
    public function logAction(){
         $this->getServiceLocator()->get("log")->debug("test debug log");
            exit();
    }

}
