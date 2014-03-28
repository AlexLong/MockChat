<?php

namespace MockChat\Controller;

use MockChat\Model\MockChat;
use Ratchet\Server\IoServer;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ChatController extends AbstractActionController
{

    public function indexAction()
    {


        return new ViewModel();
    }


}

