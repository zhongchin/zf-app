<?php

namespace DAO\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class CardsController extends AbstractActionController
{

    public function indexAction()
    {
        return new ViewModel();
    }

      public function viewAction(){
/*            if(!$this->getParam('id')){
                  throw new \Exception("Missing id");
            }*/
              $id = $this->params()->fromQuery('id');
          echo $id;
              $cardMapper= $this->getServiceLocator()->get("DAO_Mapper_Cards");

              $card=$cardMapper->load($id);
             echo "<pre>".print_r($card)."</pre>";
             exit();

      }
}


