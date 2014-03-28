<?php
/**
 * 
 * User: Windows
 * Date: 3/8/14
 * Time: 11:07 AM
 * 
 */

namespace Application\Domain\Concrete;


use Application\Domain\DbInterfaces\AggregateDbInterface;

class AbstractQueryManager {


    protected $aggregate;

    public function __construct(AggregateDbInterface $aggregateDbInterface){

        $this->aggregate = $aggregateDbInterface;

    }
} 