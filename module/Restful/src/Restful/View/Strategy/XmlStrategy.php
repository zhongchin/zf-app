<?php
/**
 * Created by PhpStorm.
 * User: tao.huang
 * Date: 14-12-5
 * Time: 下午4:13
 */
namespace Restful\View\Strategy;

use Restful\View\Model\XmlModel;
use Restful\View\Renderer\XmlRender;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\View\ViewEvent;

class XmlStrategy implements  ListenerAggregateInterface{

    protected $listeners=array();
    protected $renderer;

     public function __construct(XmlRender $renderer){
             $this->renderer=$renderer;
     }

      public function selectRenderer(ViewEvent $e){
           if(!$e->getModel() instanceof XmlModel){
                return ;
           }
          return $this->renderer;
      }
    public function injectResponse(ViewEvent $e){
        if($e->getRenderer()!==$this->renderer){
            return ;
        }
        $result=$e->getResult();
        if(is_string($result)){
            return ;
        }
         $model=$e->getModel();
         $response=$e->getResponse();
         $response->setContent($result);
         $headers=$response->getHeaders();
         $charset=';charset='.$model->getEncoding().';';
        $headers->addHeaderLine(
           'content-type','application/xml'.$charset
        );
    }
    public function attach(EventManagerInterface $events,$priority=1){
           $this->listeners[]=$events->attach(
               ViewEvent::EVENT_RENDERER,
               array($this,'selectRenderer'),
               $priority
           );
        $this->listeners[]=$events->attach(
            ViewEvent::EVENT_RESPONSE,
            array($this,'injectResponse'),
            $priority
        );
    }
    public function detach(EventManagerInterface $events){
         foreach($this->listeners as $index=>$listener){
             if($events->detach($listener)){
                 unset($this->listeners[$index]);
             }
         }
    }

}