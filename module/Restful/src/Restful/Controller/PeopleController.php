<?php

namespace Restful\Controller;

use Zend\Db\Sql\Select;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class PeopleController extends AbstractActionController
{

    public function indexAction()
    {
           $adapter=$this->getServiceLocator()->get("Zend\Db\Adapter\Adapter");
           $select=$sql=$sql->select('people');
           $select->columns(array(
               'first_name','last_name'
           ));
          $select->join('addresses','addresses.id=people.address_id',
                     array('street','number','city','postcode'),
                 Select::JOIN_LEFT
          );  //255


        return new ViewModel();
    }


}


