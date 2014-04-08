<?php
/**
 * 
 * User: Windows
 * Date: 4/8/14
 * Time: 12:38 PM
 * 
 */

namespace MockChat\Domain;

use MockChat\Domain\IAbstract\AbstractMongoTable;

class SessionMTable extends AbstractMongoTable{

    protected $sessionSid = 'connect_sid'; //

    protected $field = 'session';

    public function findById($session_sid){
        $res = $this->findOne(array('_id' => $session_sid),
            array($this->field));
        if(isset($res[$this->field])){
            $res = json_decode($res[$this->field],true);
        }
        return $res;
    }


} 