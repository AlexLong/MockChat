<?php
/**
 * 
 * User: Windows
 * Date: 4/5/14
 * Time: 4:15 PM
 * 
 */

namespace UserProfileEditor\Service\Db;


class MongoDbAuth{

    /**
     * @var \MongoDB
     */
    protected $mongoDb;

    protected $sessionDb;


    public function __construct(\MongoDB $mongodb){


       $this->mongoDb = $mongodb;


    }

    protected function  checkUserExist($connect_id)
    {



    }

    /**
     * @param mixed $sessionDb
     */
    public function setSessionDb($sessionDb)
    {
        $this->sessionDb = $sessionDb;
    }

    /**
     * @return mixed
     */
    public function getSessionDb()
    {
        return $this->sessionDb;
    }





} 