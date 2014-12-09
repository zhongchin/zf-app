<?php
namespace HBase\Form;

class UserBase extends Form{
    
    public function __construct() {
        $this->add(array(
            "type"=>"text",
            "name"=>"name",
            "options"=>array(
                 "label"=>"username"
            ),
            "attributes"=>array(
                "class"=>"name",
                ""
            )
        ));
        $this->add(array(
            "type"=>'password',
            "name"=>"password",
            "options"=>array(
                "label"=>"password",
            ),
            "attributes"=>array(
                "class"=>""
            )
        ));
        $this->add(array(
            "type"=>'password',
            "name"=>"confirm_password",
            "options"=>array(
                "label"=>"confirm password",
            ),
            "attributes"=>array(
                "class"=>""
            ),
           ),array(
                "priority"=>1,
          ));
    }
    
}