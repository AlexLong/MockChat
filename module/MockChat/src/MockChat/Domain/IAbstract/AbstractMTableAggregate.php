<?php
/**
 * 
 * User: Windows
 * Date: 4/8/14
 * Time: 12:44 PM
 * 
 */

namespace MockChat\Domain\IAbstract;


class AbstractMTableAggregate {


    /**
     * @var \MongoClient
     */
    protected $mongoClient;

    /**
     * @var \MongoDb
     */

    protected $mongodb;

    /**
     * @param \MongoDb
     */
    public function __construct($mongodb){
        $this->mongodb = $mongodb;
    }


} 