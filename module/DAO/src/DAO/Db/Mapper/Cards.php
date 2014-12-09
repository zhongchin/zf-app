<?php
/**
 * Created by PhpStorm.
 * User: tao.huang
 * Date: 14-12-6
 * Time: 上午9:29
 */
namespace DA0\Db\Mapper;

use DAO\Db\Mapper\MapperAbstract;
use DAO\Db\Mapper\MapperInterface;
use DAO\Db\DTO\Cards as CardsDto;
use Zend\Db\Sql\Insert;
use Zend\Db\Sql\Where;


class Cards extends  MapperAbstract implements  MapperInterface{

    public function delete($id){
            $sql=  $this->getSqlObject();
            $where=new Where();
            $where->equalTo('id',$id);
            try{
                  $statement=$sql->prepareStatementForSqlObject($sql->delete()->where($where));
                  $result=$statement->execute();
            }catch (\Exception $e){
                   return false;
            }
    }
    public function getAll(){
        $sql=$this->getSqlObject();
        $statement=$sql->prepareStatementForSqlObject($sql->select());
        $records=$statement->execute();
        $retval=array();
        foreach($records as $row){
             $retval[]=new CardsDto(
                  $row['type'],
                  $row['value'],
                  $row['color'],
                  $row['id']
             );
        }
        return $retval;
    }
    public function insert($data){
         if(!$data instanceof CardsDto){
             throw new \Exception('data needs to be of type DAO\Db\Dto\Cards');
         }
          $sql=$this->getSqlObject();
          try{
               $statement=$sql->prepareStatementForSqlObject($sql->insert()->values(
                  array( 'color'=>$data->getColor(),
                      'type'=>$data->getType(),
                      'value'=>$data->getValue()
                  )
               ));
               $result=$statement->execute();
               return $result->getGeneratedValue();
          }catch (\Exception $e){
                     return false;
          }
    }
    public function load($id){

        $sql=$this->getSqlObject();
        $where=new Where();
        $where->equalTo('id',$id);
        try{
            $statement=$sql->prepareStatementForSqlObject($sql->select()->where($where));
            $record=$statement->execute()->current();
            return new CardsDto(
                $record['type'],
                $record['value'],
                $record['color'],
                $record['id']
            );
        }catch (\Exception $e){
          return false;
        }
    }
      public function update($data){
           if(!$data instanceof CardsDto){
                throw new \Exception("Data needs to be of type DAO\Db\DTO\Cards");
           }
          if($data->getId()===null){
                  throw new  \Exception("Can't update anything if we don't have a card id!");
          }
            $sql=$this->getSqlObject();
          try{
                $where =new Where();
                $where->equalTo('id',$data->getId());
                $statement=$sql->prepareStatementForSqlObject($sql->update()->set(array(
                    'value'=>$data->getValue(),
                    'color'=>$data->getColor(),
                    'type'=>$data->getType()
                ))->where($where));
               $result=$statement->execute();
               return $result->getAffectedRows()>0;
          }catch (\Exception $e){
                    return false;
          }

      }



}