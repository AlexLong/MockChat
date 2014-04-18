<?php
/**
 * 
 * User: Windows
 * Date: 3/8/14
 * Time: 9:12 AM
 * 
 */

namespace UserPost\Domain\Concrete;


use Application\Domain\Concrete\AbstractRepository;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Expression;
use Zend\Db\Sql\Sql;

class PostRepository extends AbstractRepository {

    /**
     * @var PostAggregate
     */
    public $postAggregate;

    public function findAll($where, $limit = 1){
        $aggregate = $this->getPostAggregate();
        $post_table = $aggregate->getPost()->getTable();
        $likes_table = $aggregate->getLike()->getTable();
        $comment_table = $aggregate->getComment()->getTable();
$query ="
select
	$post_table.post_content,
	$post_table.post_date,
	$post_table.post_picture,
	$post_table.post_id ,
	count($likes_table.post_id) as likes_number,
	count($comment_table.post_id) as comments_number,
	$comment_table.comment_content,
	$comment_table.comment_date,
	$comment_table.comment_image
from
	ribbit_post
	inner join $likes_table on($likes_table.post_id  = $post_table.post_id )
	inner join $comment_table on($comment_table.post_id =  $post_table.post_id)
	where :where
	LIMIT $limit;";

        $result = $this->getDbAdapter()->query($query,array(':where' => $where));

        return $result;
    }

    /**
     * @param PostAggregate $postAggregate
     */
    public function setPostAggregate($postAggregate)
    {
        $this->postAggregate = $postAggregate;
    }

    /**
     * @return PostAggregate
     */
    public function getPostAggregate()
    {
        return $this->postAggregate;
    }





} 