<?php
/**
 * Created by PhpStorm.
 * User: tao.huang
 * Date: 14-12-6
 * Time: 下午4:46
 */

namespace Application\Model;


use Zend\Stdlib\Hydrator\AbstractHydrator;

class SampleModelHydrator extends AbstractHydrator
{

     private $mapping=array(
         'id'=>'primary',
         'value'=>'engine',
         'description'=>'text'
     );
       public function extract($object){
           if(!is_object($object)===false){
               throw new \Exception("We expect object to be an actual object!");
           }
           $return =array();
            foreach($this->mapping as $key=>$map){
                $getter="get".ucfirst($map);
//                $return[$key]=$object->$getter;
                $return[$key]=$this->extractValue($key,$object->$getter());
            }
           return $return;
       }
    public  function hydrate(array $data,$object){
           if(!is_object($object)){
               throw new \Exception('we expect object to be an actual object!');
           }
          foreach($data as $property=>$value){
              if(in_array($property, $this->mapping)){
                  $setter='set'.ucfirst($this->mapping[$property]);
                //  $object->$setter($value);
                  $object->$setter($this->hydrateValue($this->mapping[$property],$value));
              }

          }
        return $object;
    }
} 