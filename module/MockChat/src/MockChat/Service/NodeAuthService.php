<?php
/**
 * 
 * User: Windows
 * Date: 4/7/14
 * Time: 7:35 PM
 * 
 */

namespace MockChat\Service;


use MockChat\Domain\SessionMTable;
use MockChat\Service\Interfaces\NodeAuthserviceInterface;

class NodeAuthService implements NodeAuthserviceInterface{

    protected $expressSession;

    protected $parseTemplate = '/^s:|\.(.*)/';

    protected $sessionSid = 'connect_sid'; //

    protected $sessionTable;

     public function get_identity(){
         $session = $this->getExpressSession();
         $valid = false;
         if(isset($session['passport'])){
             if(isset($session['passport']['user']) && !empty($session['passport']['user'])){
                $valid = $session['passport']['user'];
             }
         }
         return $valid;
     }
    /**
     * @return array
     */
    public function getExpressSession()
    {
        if(!$this->expressSession){
            $res = null;
            $connect_sid = $this->getSessionSid();
            if($connect_sid){
                $res = $this->getSessionTable()->findById($connect_sid);
            }
            $this->expressSession = $res;
        }
        return $this->expressSession;
    }
    public function getSessionSid(){
        if(isset($_COOKIE[$this->sessionSid])){
            return preg_filter($this->parseTemplate,'',$_COOKIE[$this->sessionSid]);
        }
       return null;
    }

    /**
     * @param mixed SessionMTable
     */
    public function setSessionTable($sessionTable)
    {
        $this->sessionTable = $sessionTable;
    }

    /**
     * @return SessionMTable
     */
    public function getSessionTable()
    {
        return $this->sessionTable;
    }





} 