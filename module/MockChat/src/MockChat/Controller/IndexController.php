<?php

namespace MockChat\Controller;


use MockChat\Domain\MockTableAggregate;
use MockChat\Service\NodeAuthService;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Mvc\MvcEvent;
use Zend\View\Model\JsonModel;

class IndexController extends AbstractActionController
{
    /**
     * @var NodeAuthService
     */
    public $nodeAuth;


    /**
     * @var MockTableAggregate
     */
    public $dbaggregate;


    /**
     * @param MvcEvent $e
     * @return mixed|void
     */
    public function onDispatch(MvcEvent $e){

        parent::onDispatch($e);


    }
    public function indexAction()
    {


     $response = new JsonModel();


        return $response;
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




}


