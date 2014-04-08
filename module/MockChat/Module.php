<?php
namespace MockChat;

use MockChat\Domain\MockTableAggregate;
use MockChat\Service\NodeAuthService;
use Zend\Config\Config;

class Module
{
    public function getConfig()
    {
        $conf = array_merge_recursive(
            include __DIR__ . '/config/template.config.php',
            include __DIR__ . '/config/routes.config.php',
            include __DIR__ . '/config/module.config.php'
        );

        return new Config($conf);
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public  function getServiceConfig(){
        return array(
            'invokables' => array(),

            'factories' => array(
                'node_auth' => function($sm){
                        $sessionTable = $sm->get('mock_aggregate')->getSession();
                        $mongo_auth = new NodeAuthService();
                        $mongo_auth->setSessionTable($sessionTable);
                        return $mongo_auth;
                    },
                'mongo_client' => function($sm){
                        $config = $sm->get('Config');
                        $mongoClient = new \MongoClient($config['mongodb']['server']);
                        $data = array('client' => $mongoClient,'database' => $config['mongodb']['database']);
                        return $data;
                },
                'mongodb' => function($sm){
                        $client_set = $sm->get('mongo_client');
                        $mongo = new \MongoDB($client_set['client'],$client_set['database']);

                        return $mongo;
                  },
                'mock_aggregate' => function($sm){

                 $aggregate = new MockTableAggregate($sm->get('mongodb'));
                 return $aggregate;
                 }
            ),

        );
    }


}
