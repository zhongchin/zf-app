<?php
namespace Contact\Model;
use Zend\EventManager\EventManagerAwareInterface;

class Contact implements EventManagerAwareInterface{
    
    private  $_db;
    protected $events;
    
    public function setEventManager(\Zend\EventManager\EventManagerInterface $events) {
        $events->setIdentifiers(__CLASS__,  get_called_class());
        $this->events=$events;
        return $this;
    }
    public function getEventManager() {
        if($this->events==NULL){
            $this->setEventManager(new \Zend\EventManager\EventManager);
        }
        return $this->events;        
    }
    public function __construct($db) {
        $this->_db=$db;
    }
    public function getAllRows(){
        $sql="select * from contact";
        $stat=  $this->_db->query($sql);
        return $stat->fetchAll();
    }
    public function addRow($data) {
        $this->getEventManager()->trigger('event.insert',$this);
        $sql="insert into  concact(name,email,phone) values('".$data['name']."','".$data['email']."','".$data['phone']."')";
        return $this->_db->exec($sql);
    }
    public function getRow($id){
        $sql="select * from concact where id=?";
        $stat=  $this->_db->prepare($sql);
        $stat->execute(array($id));
        return $stat->fetch();
    }
    public function updateRow($data,$id){
        $this->getEventManager()->trigger('event.edit',$this);
        $sql="update concact set name='".$data['name']."',email='".$data['email']."',phone='".$data['phone']."' where id=".$id;
        return $this->_db->exec($sql);
                              
    }
    public function delRow($id){
        $this->getEventManager()->trigger('event.delete',$this);
        $sql="delete from contact where id=".$id;
        return $this->_db->exec($sql);
                
    }

    
}
