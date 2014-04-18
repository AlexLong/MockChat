<?php
/**
 * 
 * User: Windows
 * Date: 3/7/14
 * Time: 5:16 PM
 * 
 */

namespace UserPost\Domain\Concrete;


use Application\Domain\Concrete\AbstractTable;

class PostLikesTable extends AbstractTable{


    public function likesNumber($post_id){


    }

    /**
     * @return string
     */
    public function postFindSelect(){
        $table = $this->getTable();
        $find =
        "count($table.post_id) as likes_number,
        count($table.post_id) as comments_number";
        return $find;
    }

} 