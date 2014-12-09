<?php
/**
 * Created by PhpStorm.
 * User: tao.huang
 * Date: 14-12-6
 * Time: 上午10:09
 */
namespace DAO\Db\DTO;


class Cards{

    private $id;
    private $color;
    private $type;
    private $value;
    /**
     * @param mixed $color
     */
    public function setColor($color)
    {
         $validColors=array('diamond','spade','heart','club');
         if(in_array($color,$validColors)===false){
               throw new \Exception("Type can only be 'diamond','spade','heart'"."or 'club'");
          }
         $this->color = $color;
    }

    /**
     * @return mixed
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        $validTypes = array('number', 'picture');
        if(!in_array($type,$validTypes)){
            throw new \Exception("Type can only 'number' or 'picture'");
        }
        return $this->type;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value)
    {

        $maxValue=6;
        if(strlen($value)>$maxValue){
            throw new \Exception('Maximum length of value is 6.');
        }
        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }
    public function __construct($type,$value,$color,$id=null){
        if($id!==null) $this->setId($id);
        $this->setColor($color);
        $this->setType($type);
        $this->setValue($value);
    }

}