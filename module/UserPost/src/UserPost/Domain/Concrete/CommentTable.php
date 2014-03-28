<?php
/**
 * 
 * User: Windows
 * Date: 3/7/14
 * Time: 4:48 PM
 * 
 */

namespace UserPost\Domain\Concrete;


use Application\Domain\Concrete\AbstractTable;

class CommentTable extends AbstractTable{

    /**
     * @return string
     */
    public function postFindSelect(){
        $table = $this->getTable();
        $find ="$table.comment_content,
        $table.comment_date,
        $table.comment_image";
        return $find;
    }


} 