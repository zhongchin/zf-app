<?php

namespace HBase;

class Module implements \Zend\ModuleManager\Feature\AutoloaderProviderInterface, \Zend\ModuleManager\Feature\ControllerProviderInterface {

    public function getConfig() {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig() {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getControllerConfig() {
        return array(
            "abstract_factories" => array(
                "HBase\Service\AbstractFactories\Controller"
            )
        );
    }
    public function getViewHelperConfig(){
        return array(
            "invokables"=>array(
                "cdn"=> "\HBase\View\Helper\Cdn"
            )
        );
        
    }
}
