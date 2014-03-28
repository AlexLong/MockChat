<?php
/**
 * 
 * User: Windows
 * Date: 3/10/14
 * Time: 11:46 PM
 * 
 */

use Ratchet\Server\IoServer;

require './vendor/autoload.php';
require 'module/MockChat/src/MockChat/Model/MockChat.php';
$server = IoServer::factory(
    new \Ratchet\Http\HttpServer(
        new \Ratchet\WebSocket\WsServer(
            new \MockChat\Model\MockChat()
        )
    ),

    8080
);

$server->run();