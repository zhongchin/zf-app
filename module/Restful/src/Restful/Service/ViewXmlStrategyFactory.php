<?php
/**
 * Created by PhpStorm.
 * User: tao.huang
 * Date: 14-12-5
 * Time: 下午4:44
 */
namespace Restful\Service;

use Restful\View\Strategy\XmlStrategy;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\FactoryInterface;

class ViewXmlStrategyFactory implements FactoryInterface{

    public function createService(ServiceLocatorInterface $serviceLocator){
        return new XmlStrategy($serviceLocator->get('ViewXmlRenderer'));
    }

}