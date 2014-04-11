<?php
/**
 * 
 * User: Windows
 * Date: 4/9/14
 * Time: 10:54 AM
 * 
 */

namespace MockChat\Service;


use MockChat\Domain\MockTableAggregate;

class UploadManager {


    /**
     * @var MockTableAggregate
     */
    private $mockAggregate;


    private $rootDir;

    private $imageFolder;


    public function __construct($manager_config){
        $this->rootDir = $manager_config['root_dir'];
        $this->imageFolder = $manager_config['profile_image_folder'];
    }

    /**
     * @param $user_id
     * @param $picture
     * @return bool
     */
    public function updatePicture($user_id,$picture){

        $route = $this->formatRoute($user_id,$picture);

       $res = $this->getMockAggregate()->getUser()->update( array("_id" => new \MongoId($user_id)),array(
            '$set' => array('local.image_route' => $route)));

        return $route;
    }

    public function getUserPicture($user_id){


        $res = $this->getMockAggregate()->
            getUser()->findById($user_id,array('local.image_route' => true));
        if(isset($res['local']['image_route'])){
            return $this->formatPictureUrl($res['local']['image_route']);
        }

        return null;
    }

    public function formatPictureUrl($image_route){

       $host = $this->getMockAggregate()->getChatOption()->getOption("uploader_host");

       return rtrim(join("/",array($host,$image_route)),"/");

    }

    public function defaultPicture(){

        $route = $this->getMockAggregate()->getChatOption()->getOption('default_image');
        return $this->formatPictureUrl($route);
    }


    /**
     * @param \MockChat\Domain\MockTableAggregate $mockAggregate
     */
    public function setMockAggregate($mockAggregate)
    {
        $this->mockAggregate = $mockAggregate;
    }
    /**
     * @return \MockChat\Domain\MockTableAggregate
     */
    public function getMockAggregate()
    {
        return $this->mockAggregate;
    }

      public function formatRoute($user_id,$picture){
       return  rtrim(join("/",array($this->rootDir,
           $user_id,$this->imageFolder,$picture)),"/");
      }









} 