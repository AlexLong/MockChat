<?php

namespace MockChat\Controller;


use MockChat\Domain\MockTableAggregate;
use MockChat\Entity\ProfilePicture;
use MockChat\Service\NodeAuthService;
use MockChat\Service\UploadManager;
use Zend\Config\Writer\Json;
use Zend\Http\Headers;
use Zend\Http\Response;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Mvc\MvcEvent;
use Zend\View\Model\JsonModel;
use Zend\View\Model\ViewModel;

class FormController extends AbstractActionController
{
    /**
     * @var NodeAuthService
     */
    public $nodeAuth;


    /**
     * @var MockTableAggregate
     */
    public $dbaggregate;


    public $picture_form;


    public $uploadManager;

    /**
     * @param MvcEvent $e
     * @return mixed|void
     */
    public function onDispatch(MvcEvent $e){

      parent::onDispatch($e);

    }

    public function indexAction()
    {

     $current_picture = $this->getUploadManager()->getUserPicture($this->getNodeAuth()->get_identity());

       return new ViewModel(array('picture_form' => $this->getPictureForm(), "profile_picture" => $current_picture));

    }


    function updatePictureAction(){
        if(!$this->getNodeAuth()->get_identity()){
            return new JsonModel(array("error" => 1, "message" => "Not authorized"));
        }
       $picture_form = $this->getPictureForm();

        $prg = $this->fileprg($picture_form);

        if ($prg instanceof \Zend\Http\PhpEnvironment\Response) {
            return $prg; // Return PRG redirect response
        } elseif (is_array($prg)) {
            if($picture_form->isValid()){
                $entity = new ProfilePicture($picture_form->get('profile_picture')->getValue());
                $updated_val = $entity->getParsedName();
                if($updated_val && isset($updated_val['profile_picture'])){
                    // $this->getUploadManager()->updateProfile($updated_val);
                    $picture =  $this->getUploadManager()->updatePicture($this->getNodeAuth()->get_identity(),$updated_val['profile_picture']);

                    if($picture){
                        return new JsonModel(array("error"=>0,"image_url" => $picture,"Image has been successfully uploaded."));
                    }
                }
            }else{
                return new JsonModel(array(
                    "error"     => 1,
                    "message" => "Oops, file cannot be uploaded. Please ensure that file has a valid format and size."
                ));

            }
        }

        return new JsonModel(array("error" => 1, "message" => "Not authorized"));




    }

    /**
     * @return NodeAuthService
     */
    public function getNodeAuth()
    {
        return  $this->getServiceLocator()->get('node_auth');
    }

    /**
     * @return MockTableAggregate
     */
    public function getAggregate(){
       return $this->getServiceLocator()->get('mock_aggregate');
    }

    /**
     * @return mixed
     */
    public function getPictureForm()
    {
        if(!$this->picture_form){
            $this->picture_form =  $this->getServiceLocator()->get('pictureEditForm');
        }
        return $this->picture_form;
    }

    /**
     * @return UploadManager
     */
    public function getUploadManager()
    {

        if(!$this->uploadManager){
            $this->uploadManager = $this->getServiceLocator()->get('upload_manager');
        }
        return $this->uploadManager;
    }




}


