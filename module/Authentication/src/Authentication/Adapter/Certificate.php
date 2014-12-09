<?php
/**
 * Created by PhpStorm.
 * User: tao.huang
 * Date: 14-12-8
 * Time: 下午3:14
 */

namespace Authentication\Adapter;


use Zend\Authentication\Adapter\AdapterInterface;
use Zend\Db\Adapter\Adapter;

class Certificate implements  AdapterInterface
{

    const AUTH_FALL_INV_CERT=0;
    const AUTH_FALL_NO_HTTPS=1;
    const AUTH_FALL_PARSE_CERT=2;
    const AUTH_FALL_EXP_CERT=3;
    const AUTH_FALL_NOT_ALL_FIELDS=4;
    const AUTH_FAIL_NO_DB_ADAPTER = 5;
    // An error occurred in the SQL
    const AUTH_FAIL_SQL_ERR = 6;
   // The user requested couldn't be found
     const AUTH_FAIL_NO_USER = 7;
   // By default we have no error
    private $error = -1;
    private $certificate;
    private  $dbAdapter;
    private $identity;


    public function setError($error){
        $this->error=$error;
    }
    public function getErrorMessage()
    {
        switch ($this->error) {
            case self::AUTH_FAIL_SQL_ERR:
                $retval = "SQL error occurred while checking "
                    . "for the user.";
                break;
            case self::AUTH_FAIL_INV_CERT:
                $retval = "Certificate provided is invalid.";
                break;
            case self::AUTH_FAIL_PARSE_CERT:
                $retval = "Certificate provided couldn't be "
                    . "parsed.";
                break;
            case self::AUTH_FAIL_EXP_CERT:
                $retval = "Certificate has expired.";
                break;
            case self::AUTH_FAIL_NO_DB_ADAPTER:
                $retval = "No Database adapter set.";
                break;
            case self::AUTH_FAIL_NOT_ALL_FIELDS:
                $retval = "Not all the fields required are "
                    . "available.";
                break;
            case self::AUTH_FAIL_NO_USER:
                $retval = "The user could not be found.";
                break;
            case self::AUTH_FAIL_NO_HTTPS:
                $retval = "Connection is not secure.";
                break;
            case -1:
                $retval = "No error occurred.";
                break;
            default:
                $retval = "Unknown error occurred.";
                break;
        }
// Reset the error
        $this->error = -1;
// Return the string with the error message
        return $retval;
    }
    public function isHTTPS(){
        return isset($_SERVER['HTTPS']) ? true:false;
    }

    public function setCertificate($certificateContent){
            $certificate=openssl_x509_parse($certificateContent);
        if($certificate!==false){
            $this->certificate=$certificate;
            return true;
        }else{
            $this->setError(self::AUTH_FALL_PARSE_CERT);
            return false;
        }
    }
    public function checkRequiredFields(){
        $certificate=$this->getCertificate();
        if($certificate!==false){
            $required=array(
                'issuer' => array('O', 'CN', 'emailAddress'),
                'serialNumber' => null
            );
          foreach($required as $field=>$value){
               if(in_array($field,$certificate)===true){
                    if(is_array($value && is_array($certificate[$field]))){
                        foreach($value as $key){
                             if(in_array($key,array_keys($certificate[$field]))===false){
                                     return false;
                             }
                        }
                    }else{
                        return false;
                    }
               }
          }
            $retval=true;
            unset($required);
        }
        unset($certificate);
        return isset($retval) ? $retval:false;
    }
       public function isCertificateValid(){
            $certificate=$this->getCertificate();
           if($certificate!==false){
                 if(isset($certificate['validFrom_time_t'])===true&&isset($certificate['validTo_time_t'])===true){
                    if(time()>=$certificate['validFrom_time_t']&&time()<$certificate["validTo_time_t"]){
                          $retval=true;
                    }
                 }
           }
           unset($certificate);
           return isset($retval)?$retval:false;
       }
    public function getCretificateVariable($variable=null){
         if(is_array($this->certificate)===true&&isset($this->certificate[$variable])===false){
             return $this->certificate[$variable];
         }else if($this->certificate["issuer"][$variable]){
             return $this->certificate['issuer'][$variable];
         }else{
             return null;
         }
    }

    public function setDbAdapter(Adapter $db){
            $this->dbAdapter=$db;
    }
     public function getDbAdapter(){
         return $this->dbAdapter;
     }
    public function getIdentity(){
        return $this->identity;
    }
    public function authenticate(){
         $continue=true;

        if($this->getDbAdapter()!=null){
             if($this->isHTTPS()===true){
                 if($this->getCretificateVariable()!==false){
                     if($this->checkRequiredFields()===true){
                         if($this->isCertificateValid()===false){
                             $this->setError(self::AUTH_FAIL_EXP_CERT);
                             $continue=false;
                         }
                     }else{
                          $this->setError(self::AUTH_FALL_NOT_ALL_FIELDS);
                         $continue=false;
                     }
                 }else{
                     $this->setError(self::AUTH_FALL_INV_CERT);
                     $continue=false;
                 }
             }else{
                 $this->setError(self::AUTH_FALL_NO_HTTPS);
                 $continue=true;
             }
        }else{
             $this->setError(self::AUTH_FAIL_NO_DB_ADAPTER);
            $continue=false;
        }
        if($continue===true){
             $statement=$this->getDbAdapter()->createStatement("SELECT * from user where email=:email");
             try{
                  $result=$statement->execute(array(
                      "email"=>$this->getCretificateVariable('emailAddress')
                  ));
                    if($result->count()===1){
                        $this->identity=$result->current();
                        $this->identity['serialNumber']=$this->getCretificateVariable("serialNumber");
                        $this->identity['organization'] =  $this->getCertificateVariable('O');
                        $this->identity['commonName'] =$this->getCertificateVariable('CN');
                        $retval=true;
                    }else{
                        $this->setError(self::AUTH_FAIL_NO_USER);
                    }
             }catch (\Exception $e){
                 $this->setError(self::AUTH_FAIL_SQL_ERR);
                 error_log($e->getMessage());
             }
        }
        return isset($retval)?$retval:false;

    }

} 