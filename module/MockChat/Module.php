<?php
namespace MockChat;

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
}
