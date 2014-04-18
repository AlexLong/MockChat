<?php
namespace UserPost;

use UserPost\Domain\Concrete\PostAggregate;
use UserPost\Domain\Concrete\PostRepository;
use Zend\Db\Sql\Sql;

class Module
{
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
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

    public function getViewHelperConfig()
    {
        return array(
            'invokables' => array(),
            'factories' => array(),
        );
    }


    public  function  getServiceConfig(){
        return array(
            'invokables' => array(
            ),
            'factories' => array(
                'postAggregate' => function($sm){
                    $aggregate = new PostAggregate($sm->get('Zend\Db\Adapter\Adapter'));
                    return $aggregate;
                },
                'postRepository' => function($sm){
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $repository = new PostRepository($dbAdapter);

                    $aggregate= $sm->get('postAggregate');
                    $repository->setPostAggregate($aggregate);
                    $sql = new Sql($dbAdapter);
                    $repository->setSql($sql);
                    return $repository;
                },
            )
        );
    }
}
