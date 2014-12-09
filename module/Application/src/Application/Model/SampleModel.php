<?php
/**
 * Created by PhpStorm.
 * User: tao.huang
 * Date: 14-12-6
 * Time: 下午4:44
 */

namespace Application\Model;


class SampleModel {

    private $engine;
    private $primary;
    private $text;

    /**
     * @param mixed $engine
     */
    public function setEngine($engine)
    {
        $this->engine = $engine;
    }

    /**
     * @return mixed
     */
    public function getEngine()
    {
        return $this->engine;
    }

    /**
     * @param mixed $primary
     */
    public function setPrimary($primary)
    {
         if(!is_int($primary)){
             throw new \Exception("Primary ({$primary}) should be an integer!");
         }
        $this->primary = $primary;
    }

    /**
     * @return mixed
     */
    public function getPrimary()
    {
        return $this->primary;
    }

    /**
     * @param mixed $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }


} 