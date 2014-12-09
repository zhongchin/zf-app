<?php

namespace Restful\Controller;

use Restful\View\Model\XmlModel;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Adapter\ParameterContainer;
use Zend\Db\Sql\Delete;
use Zend\Db\Sql\Insert;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Update;
use Zend\Db\Sql\Where;
use Zend\Db\TableGateway\TableGateway;
use Zend\Feed\Writer\Feed;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\FeedModel;
use Zend\View\Model\ViewModel;
use Zend\View\View;

class IndexController extends AbstractActionController
{
    protected  $acceptCriteria=array(
         'Zend\View\Model\ViewModel'=>array(
             'text/html',
         ),
        'Zend\View\Model\JsonModel'=>array(
            'application/json',
            'text/json'
        )
    );

    public function indexAction()
    {
          $feed=new Feed();
          $feed->setTitle("My Awesome Feed!");
          $feed->setFeedLink(
              'http://winter.example.com/rss',
              'atom'
          );
         $feed->addAuthor(array(
             'name'=>'Jack',
             'email'=>'ned@winter.example.com',
             'uri'=>'http://winter.example.com',
         ));
        $feed->setDescription('Loremipsul');
        $feed->setLink('http://winter.example.com');
        $feed->setDateModified(time());
        $data=array(
            array(
                'title' => 'Post 1',
                'link' => 'http://winter.example.com/post/1',
                'description' => 'Loremipsum..',
                'date_created' => strtotime('2001-01-01 12:03:23'),
                'date_modified' => strtotime('2001-02-12 11:05:24'),
            )
        );
         foreach($data as $row){
              $feed->addEntry(
                 $feed->createEntry()->setTitle($row['title'])
                     ->setLink($row['link'])
                     ->setDescription($row['description'])
                     ->setDateModified($row['date_modified'])
                     ->setDateCreated($row['date_created'])
              );
         }
             $feed->export('rss');
             $feedModel=new FeedModel();
             $feedModel->setFeed($feed);

             return $feedModel;
    }

     public function jsonAction(){
           $viewModel=new ViewModel();
            $viewModel=$this->acceptableViewModelSelector($this->acceptCriteria);
            $viewModel->setVariables(array('output'=>array(
               'one'=>'one,row,row your boat',
                'two'=>'gently down the stream',
                'three' => 'Merrily, merrily, merrily, merrily,',
                'four' => 'life is but a dream.',
            )));
         return $viewModel;
     }
    public function testXmlAction(){
        echo "xml test";
         $xmlModel=new XmlModel(array(
            'some_variable'=>'Awesome',
             'why_not_another_one'=>'while we are here'
         ));

        $xmlModel->setTemplate('restful/index/test-xml.phtml');
        var_dump($xmlModel);
        return $xmlModel;
    }

   public function dbAction(){
        $connection=$this->getServiceLocator()->get("Zend\Db\Adapter\Adapter");
/*       $query= $connection->query(
            'SELECT * FROM user where id=?',
           Adapter::QUERY_MODE_PREPARE
        );
          $replacements=array('2');
          $result=$query->execute($replacements);*/
           $statement=$connection->createStatement();
           $statement->setSql("select * from user where id=:id");
           $container=new ParameterContainer(array(
                 'id'=>'2'
             ));
           $statement->setParameterContainer($container);
           $statement->prepare();
           $result=$statement->execute();

            foreach($result as $res){
                echo "<pre>";
                print_r($res);
                echo "</pre>";
            }
          // echo  $connection->getPlatform()->quoteIdentifier("some_var");
/*          echo $connection->getPlatform()->quoteIdentifierChain(array(
              'some_table','some_column'
          ));*/
        //   echo $connection->getPlatform()->quoteValue('great-value');
        //  echo $connection->getPlatform()->quoteTrustedValue('great-value');
        /*  echo $connection->getPlatform()->quoteValueList(array(
              'value_one','value_two'
          ));*/
         echo $connection->getPlatform()->quoteIdentifierInFragment(
             '(fork.* AS spoon)',
             array('(',')')
         );
          exit();
   }
    //以下是插入数据的两种方法
    public function insertAction(){
        $connection=$this->getServiceLocator()->get("Zend\Db\Adapter\Adapter");
        //
         $insert=new Insert('user');
         $insert->columns(array('name','email','password'));
         $insert->values(array(
             'name'=>'chenglong',
             'email'=>'chenglong@163.com',
             'password'=>md5('chenglong')
         ));
     /*    $tableGateway=new TableGateway('user',$connection);
          try{
                $tableGateway->insertWith($insert);
              echo "insert success";
              $hasResult=true;
          }catch (\Exception $e){
                echo "insert failed";
                echo $e->getMessage();
          }*/
/*             $sql=new Sql($connection);
             $statement=$sql->prepareStatementForSqlObject($insert);
             $statement->execute();*/
        //----------------------------------
            exit();
    }
    //以下是更新数据的方法
      public function updateAction(){
               $adapter=$this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
               $tableGateway= new TableGateway('user',$adapter);
               $update=new Update('user');
               $update->set(array(
                   'name'=>'lilianjie',
                   'email'=>'lilianjie@126.com',
               ));
                $where=new Where();
                $where->equalTo('id',14);
                $update->where($where);
                $updated=$tableGateway->updateWith($update);
                exit();
      }
    //删除数据
      public function deleteAction(){
            $adapter=$this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
            $tableGateway= new TableGateway('user',$adapter);
            $delete=new Delete('user');
            $delete->where($where);
            $deleted=$tableGateway->deleteWith($delete);
      }

}


