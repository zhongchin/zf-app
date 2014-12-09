<?php
/**
 * Created by PhpStorm.
 * User: tao.huang
 * Date: 14-12-6
 * Time: 下午5:59
 */

namespace Application\Service;


use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class Example implements ServiceLocatorAwareInterface
{
    protected  $serviceLocator;

    public function setServiceLocator(ServiceLocatorInterface $serviceLocator){
        $this->serviceLocator=$serviceLocator;
    }
    public function getServiceLocator(){
        return $this->serviceLocator;
    }
    public function encodeMyString($string){
        return str_rot13($string);
    }
} 