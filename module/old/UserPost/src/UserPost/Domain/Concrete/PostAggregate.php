<?php
/**
 * 
 * User: Windows
 * Date: 3/7/14
 * Time: 3:49 PM
 * 
 */

namespace UserPost\Domain\Concrete;


use Application\Domain\Concrete\AbstractDbAggregate;
use UserPost\Entity\PostComment;
use UserPost\Entity\PostEntity;
use UserPost\Entity\PostLike;

class PostAggregate extends AbstractDbAggregate{

    protected $post;
    protected $comment;
    protected $like;

    protected $tables = array(
        'post' => 'ribbit_post',
        'comment' => 'ribbit_post_comment',
        'like' => 'ribbit_post_like'
    );
    /**
     * @return PostTable
     */
    public function getPost()
    {
        if(!$this->post){

            $this->post = new PostTable($this->tables['post'],
                $this->dbAdapter, new PostEntity());

        }
        return $this->post;
    }

    /**
     * @return CommentTable
     */
    public function getComment()
    {
        if(!$this->comment){
            $this->comment = new CommentTable($this->tables['comment'],
                $this->dbAdapter);
            $this->comment->setEntity(new PostComment());
        }
        return $this->comment;
    }

    /**
     * @return PostLikesTable
     */
    public function getLike()
    {
        if(!$this->like){
            $this->like = new PostLikesTable($this->tables['like'],
                $this->dbAdapter);
            $this->like->setEntity(new PostLike());
        }
        return $this->like;
    }





} 