<?php
/**
 * 
 * User: Windows
 * Date: 3/7/14
 * Time: 2:35 PM
 * 
 */

namespace UserPost\Entity;


use Application\Entity\AbstractEntity;

class PostLike extends AbstractEntity {

    public $id = null;

    public $post_id = null;

    public $user_id = null;

    public $like_date = null;



} 