<?php
/**
 * Created by PhpStorm.
 * User: tao.huang
 * Date: 14-12-5
 * Time: 下午4:08
 */
namespace Restful\View\Model;

use Zend\View\Model\ViewModel;

class XmlModel extends  ViewModel{

    protected  $captureTo="content";
    protected  $terminate=true;
    protected  $encoding='utf-8';

    protected $contentType='application/xml';

    public function setEncoding($encoding){
          $this->encoding=$encoding;
         return $this;
    }
    public function getEncoding(){
        return $this->encoding;
    }
    public function setContentType($contentType){
        $this->encoding=$contentType;
        return $this;
    }
    public function getContentType(){
        return $this->contentType;
    }
}
