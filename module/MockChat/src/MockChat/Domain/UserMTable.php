<?php
/**
 * 
 * User: Windows
 * Date: 4/8/14
 * Time: 12:34 PM
 * 
 */

namespace MockChat\Domain;


use MockChat\Domain\IAbstract\AbstractMongoTable;

class UserMTable extends AbstractMongoTable {


    function findById($user_id,$fields = array()){

     if(!$user_id) return null;

     $res =  $this->findOne(array("_id" => new \MongoId($user_id)),$fields);

     return $res;
    }

    function updateUser($user_id){




    }

} 