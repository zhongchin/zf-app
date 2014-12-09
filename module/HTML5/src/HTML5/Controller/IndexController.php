<?php

namespace HTML5\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Form\Form;

class IndexController extends AbstractActionController
{

    public function indexAction()
    {
         $form=new Form();
         $dateTime=new \Zend\Form\Element\DateTime('element-date-time');
         $dateTime->setLabel("Date/Time Element")
                    ->setAttributes(array(
                     'min' => '2000-01-01T00:00:00Z',
                    'max' => '2020-01-01T00:00:00Z',
                    'step' => '1',
                  ));
         
         $form->add($dateTime);
         $dateTime = new \Zend\Form\Element\DateTimeLocal('element-date-time-local');
        $dateTime
                ->setLabel('Date/Time Local Element')
                ->setAttributes(array(
                    'min' => '2000-01-01T00:00:00Z',
                    'max' => '2020-01-01T00:00:00Z',
                    'step' => '1',
        ));
        $form->add($dateTime);
        // Time Element
        $time = new \Zend\Form\Element\Time('element-time');
        $time->setLabel('Time Element');
        $form->add($time);
        // Date Element
        $date = new \Zend\Form\Element\Date('element-date');
        $date
                ->setLabel('Date Element')
                ->setAttributes(array(
                    'min' => '2000-01-01',
                    'max' => '2020-01-01',
                    'step' => '1',
        ));
        $form->add($date);
        // Week Element
        $week = new \Zend\Form\Element\Week('element-week');
        $week->setLabel('Week Element');
        $form->add($week);
        // Month Element
        $month = new \Zend\Form\Element\Month('element-month');
        $month->setLabel('Month Element');
        $form->add($month);
        // Email Element
        $email = new \Zend\Form\Element\Email('element-email');
        $email->setLabel('Email Element');

        $form->add($email);
        // URL Element
        $url = new \Zend\Form\Element\Url('element-url');
        $url->setLabel('URL Element');
        $form->add($url);
        // Number Element
        $number = new \Zend\Form\Element\Number('element-number');
        $number->setLabel('Number Element');
        $form->add($number);
        // Range Element
        $range = new \Zend\Form\Element\Range('element-range');
        $range->setLabel('Range Element');
        $form->add($range);
        // Color Element
        $color = new \Zend\Form\Element\Color('element-color');
        $color->setLabel('Color Element');
        $form->add($color);
        return new ViewModel(array('form'=>$form));
    }
    public function multiUploadAction(){
        $form = $this->getServiceLocator()->get('MultiImageUploadForm');
        $request = $this->getRequest();
        if ($request->isPost()){
           $post = array_merge_recursive(
                        $request->getPost()->toArray(),
                        $request->getFiles()->toArray()); 
        }
        $form->setData($post);
        if ($form->isValid()){
            $data = $form->getData();
            return $this->redirect()->toRoute('html5',
                array('action' => 'processMultiUpload'));
        }
        $viewModel = new ViewModel(array('form' => $form));
        return $viewModel;
    }

}

