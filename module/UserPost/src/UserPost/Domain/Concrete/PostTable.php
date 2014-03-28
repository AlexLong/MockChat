<?php
/**
 * 
 * User: Windows
 * Date: 3/7/14
 * Time: 3:51 PM
 * 
 */

namespace UserPost\Domain\Concrete;


use Application\Domain\Concrete\AbstractTable;
use UserPost\Entity\PostEntity;
use Zend\Db\Adapter\AdapterInterface;


class PostTable extends AbstractTable{


    public function __construct($table,AdapterInterface $adapter, PostEntity $user_profile){
        parent::__construct($table,$adapter);
        $this->entity = $user_profile;
    }

    /**
     * @return string
     */

    public function postFindSelect(){
        $table = $this->getTable();
        $find =
   "$table.post_content,
	$table.post_date,
	$table.post_picture,
	$table.post_id";
    return $find;
    }


} 