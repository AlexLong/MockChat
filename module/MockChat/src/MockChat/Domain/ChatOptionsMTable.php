<?php
/**
 * 
 * User: Windows
 * Date: 4/9/14
 * Time: 9:17 PM
 * 
 */

namespace MockChat\Domain;


use MockChat\Domain\IAbstract\AbstractMongoTable;

class ChatOptionsMTable extends AbstractMongoTable{

    public function getOption($key){
     $res = $this->findOne(array('key' => $key));
        if($res && isset($res['key'])){
            return $res['value'];
        }
        return null;
    }
} 