<?php
/**
 * Created by PhpStorm.
 * User: tao.huang
 * Date: 14-12-4
 * Time: 下午3:19
 */
namespace Application\Model;
use Zend\EventManager\EventManager;


class SwagMachine {
    private $em;
    public function getEventManager(){
        if(!$this->em){
            $this->em=new EventManager(__CLASS__);
        }
       return $this->em;
    }
  public function findSwag($id){
      $response=$this->getEventManager()->trigger('findSwag.begin',$this,array("id"=>$id));
      if($response->count()>0){
          $id=$response->last();
          $returnValue="Original Value (".$id.")";
          $this->getEventManager()->trigger("findSwag.end",$this,array(
              'returnValue'=>$returnValue
          ));
          return $returnValue;
      }

  }

} 