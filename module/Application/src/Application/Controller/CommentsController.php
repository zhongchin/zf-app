<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class CommentsController extends AbstractActionController
{

    public function indexAction()
    {
        return new ViewModel();
    }

     public function ajaxAction(){

     }
     public function helperAction(){

     }
      public function forwardAction(){

      }

}

