<?php
/**
 * 
 * User: Windows
 * Date: 4/8/14
 * Time: 12:40 PM
 * 
 */

namespace MockChat\Domain;


use MockChat\Domain\IAbstract\AbstractMTableAggregate;

class MockTableAggregate extends AbstractMTableAggregate {

    protected $session;

    protected $user;

    protected $chatOption;

    /**
     * @return mixed
     */
    public function getSession()
    {
        if(!$this->session){

            $this->session = new SessionMTable($this->mongodb,"sessions");

        }
        return $this->session;
    }

    public function getUser(){
        if(!$this->user){
            $this->user = new UserMTable($this->mongodb,"users");
        }
        return $this->user;
    }

    /**
     * @return ChatOptionsMTable
     */
    public function getChatOption(){
        if(!$this->chatOption){
            $this->chatOption = new ChatOptionsMTable($this->mongodb,"chat_options");
        }
        return $this->chatOption;
    }






} 