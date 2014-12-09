<?php
/**
 * Created by PhpStorm.
 * User: tao.huang
 * Date: 14-12-5
 * Time: 下午12:17
 */
namespace SampleModule\View\Helper;
use Zend\Form\ElementInterface;
use Zend\Form\View\Helper\AbstractHelper;
use Zend\Form\Exception;

class FormVideo extends  AbstractHelper{
       protected  $validTagAttributes=array(
           'autoplay'=>true,
           'controls'=>true,
           'height'=>true,
           'loop'=>true,
           'muted' => true,
           'poster' => true,
           'preload' => true,
           'src' => true,
           'width' => true,
       );
    public function __invoke(ElementInterface $element=null){
        if(!$element){
            return $this;
        }
        return $this->render($element);
    }
  protected function createSourceString($src){
         $retval='';
         if(is_array($src)===true){
             foreach($src as $tmpSrc){
                 $retval.=$this->createSourceString($tmpSrc);
             }
         }else{
              $retval=sprintf('<source src="%s">',$src);
         }
      return $retval;
  }
    public function render(ElementInterface $element){
         $src=$element->getAttribute('src');
        if($src===null||$src===''){
            throw new Exception(sprintf('%s requires that the element has an assigned'.'src;none discovered',__METHOD__));
        }
          $attributes=$element->getAttributes();
          unset($attributes['src']);
          return  sprintf('<video %s>%s</video>',$this->createAttributesString($attributes),$this->createSourceString($src));
    }

}