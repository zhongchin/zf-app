<?php
namespace Restful\Service;

use Restful\View\Renderer\XmlRender;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ViewXmlRendererFactory implements FactoryInterface{

    public function createService(ServiceLocatorInterface  $serviceLocator){
              $renderer=new XmlRender();
              $viewResolver=
              $renderer->setResolver($serviceLocator->get('ViewResolver'));
              $renderer->setHelperPluginManager($serviceLocator->get('ViewHelperManager'));
              return $renderer;
    }

}

?>