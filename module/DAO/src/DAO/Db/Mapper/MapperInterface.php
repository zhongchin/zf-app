<?php
/**
 * Created by PhpStorm.
 * User: tao.huang
 * Date: 14-12-6
 * Time: 上午9:29
 */
namespace DAO\Db\Mapper;

interface MapperInterface
{
     public function insert($data);

     public function update($data);

     public function delete($id);

     public  function load($id);

     public function getAll();
}