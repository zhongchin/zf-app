<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\Navigation\Page\Mvc;

class Module
{
    private $locales;
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
        $sharedEvents=$eventManager->getSharedManager();
        $sm=$e->getApplication()->getServiceManager();
        $sharedEvents->attach(__NAMESPACE__,MvcEvent::EVENT_DISPATCH,function($e) use ($sm){
            $strategy=$sm->get("ViewJsonStrategy");
            $view=$sm->get("ViewManager")->getView();
            $strategy->attach($view->getEventManager());
        },100);
/*        $headers=$e->getApplication()->getRequest()->getHeaders();
        $translator=$e->getApplication()->getServiceManager()->get("translator");
        if($headers->has("Accept-Language")){
             $headerLocales=$headers->get("Accept-Language")->getPrioritized();
            $locales=$this->retrieveLocales();
            $translator->setFallbackLocale("en_US");
            foreach($headerLocales as $locale){
                $language=str_replace('_','_',$locale->getLanguage());
                if(in_array($language,$locales)===true){
                          break;
                }
            }
            $translator->setLocale($language);
        }*/

	}

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    private  function retrieveLocales(){
        if($this->locales===null){
            $handle=opendir(__DIR__.'/language');
            $locales=array();
            if($handle!==false){
                while(false!==($entry=readdir($handle))){
                   if($entry===".."||$entry==="."){
                       continue;
                   }
                    $split=explode('.',$entry);
                    if(in_array($split[0],$locales)===false){
                           $locales[]=$split[0];
                    }
                    unset($split);
                }
                closedir($handle);
            }
            $this->locales=$locales;
            unset($handle,$locales);
        }
        return $this->locales;
    }

}
