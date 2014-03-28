<?php
/**
 * 
 * User: Windows
 * Date: 3/8/14
 * Time: 9:14 AM
 * 
 */

namespace Application\Domain\Concrete;


use Zend\Db\Adapter\Adapter;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Sql\Sql;


abstract class AbstractRepository {

    /**
     * @var Adapter
     */
    protected $dbAdapter;

    /**
     * @var Sql
     */
    protected $sql;




    public function __construct(AdapterInterface $adapter){
        $this->dbAdapter = $adapter;
    }

    /**
     * @param Adapter $dbAdapter
     */
    public function setDbAdapter($dbAdapter)
    {
        $this->dbAdapter = $dbAdapter;
    }

    /**
     * @return Adapter
     */
    public function getDbAdapter()
    {
        return $this->dbAdapter;
    }

    /**
     * @param \Zend\Db\Sql\Sql $sql
     */
    public function setSql($sql)
    {
        $this->sql = $sql;
    }

    /**
     * @return \Zend\Db\Sql\Sql
     */
    public function getSql()
    {
        return $this->sql;
    }




}
