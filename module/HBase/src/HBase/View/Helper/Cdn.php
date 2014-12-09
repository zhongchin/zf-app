<?php
namespace HBase\View\Helper;
use Zend\ServiceManager\ServiceLocatorAwareTrait;

class Cdn extends \Zend\View\Helper\AbstractHelper implements \Zend\ServiceManager\ServiceLocatorAwareInterface
{
    use ServiceLocatorAwareTrait;
    protected $types=array(
        "qiniu"=>"cdn.qiniu.com",
        "google"=>"google.code.com",
    );
    protected static $defaultType="google";
    
    public function __invoke($type=null){
        if($type!=null){
            if(array_key_exists($type, $this->types)){
                return $this->types[$type];
            }
        }
       $serviceLocator=  $this->serviceLocator->getServiceLocator();
       $config=$serviceLocator->get("config");
       
      
           if(isset($config["view_manager"])&&isset($config["view_manager"]["base_path"])){
               return $config["view_manager"]["base_path"];
           }
        return $this->types[static::$defaultType];
       
    }
}

