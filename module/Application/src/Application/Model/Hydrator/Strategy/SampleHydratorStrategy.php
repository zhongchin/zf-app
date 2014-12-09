<?php
/**
 * Created by PhpStorm.
 * User: tao.huang
 * Date: 14-12-6
 * Time: 下午4:58
 */

namespace Application\Model\Hydrator\Strategy;


use Zend\Stdlib\Hydrator\Strategy\StrategyInterface;

class SampleHydratorStrategy implements  StrategyInterface
{
      public function extract($value){
           if(is_int($value)){
               return (int)$value;
           }else{
               return rand(0,1000);
           }
      }

      public function hydrate($value){
          if(is_int($value)){
              return (int)$value;
          }else{
              return rand(0,1000);
          }
      }

} 