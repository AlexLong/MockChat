<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Application\Service\NodeAuthService;
use Zend\Config\Config;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\Session\Container;

use Zend\Session\SessionManager;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);


        $this->bootstrapSession($e);
      //  $this->registerStrategy($e);
    }

    public  function  bootstrapSession($e)
    {
        $session = $e->getApplication()
                    ->getServiceManager()
                    ->get('Zend\Session\SessionManager');


        $session->start();

        $container = new Container('initialized');
        if(!isset($container->init)){
            $session->regenerateId(true);
            $container->init = 1;
        }
    }

    /*
    public function registerStrategy($e){
        $sharedEvents        = $e->getApplication()->getEventManager()->getSharedManager();
        $sm = $e->getApplication()->getServiceManager();

        $sharedEvents->attach(__NAMESPACE__, MvcEvent::EVENT_DISPATCH, function($e) use ($sm) {
            $strategy = $sm->get('ImageStrategy');
            $view     = $sm->get('ViewManager')->getView();
            $strategy->attach($view->getEventManager());
        }, 100);
    }
    */
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


    public function getViewHelperConfig()
    {
        return array(
            'invokables' => array(
                'userFormErrors' => 'Application\ViewHelpers\UserFormErrors',

            ),
            'factories' => array(

            ),
        );
    }
    public  function  getServiceConfig()
    {
        return array(
            'invokables' => array(),
           'factories' => array(
               'GlobalCacheService' => 'Zend\Cache\Service\StorageCacheFactory',
               'ImageRenderer' => 'Application\Service\ImageRendererFactory',
               'ImageStrategy' => 'Application\Service\ImageFactory',


               'Zend\Session\SessionManager' => function ($sm) {
                       $config = $sm->get('config');
                       if (isset($config['session'])) {
                           $session = $config['session'];
                           $sessionConfig = null;
                           if (isset($session['config'])) {
                               $class = isset($session['config']['class'])  ? $session['config']['class'] : 'Zend\Session\Config\SessionConfig';
                               $options = isset($session['config']['options']) ? $session['config']['options'] : array();
                               $sessionConfig = new $class();
                               $sessionConfig->setOptions($options);
                           }

                           $sessionStorage = null;
                           if (isset($session['storage'])) {
                               $class = $session['storage'];
                               $sessionStorage = new $class();
                           }

                           $sessionSaveHandler = null;
                           if (isset($session['save_handler'])) {
                               // class should be fetched from service manager since it will require constructor arguments
                               $sessionSaveHandler = $sm->get($session['save_handler']);
                           }

                           $sessionManager = new SessionManager($sessionConfig, $sessionStorage, $sessionSaveHandler);

                           if (isset($session['validators'])) {
                               $chain = $sessionManager->getValidatorChain();
                               foreach ($session['validators'] as $validator) {
                                   $validator = new $validator();
                                   $chain->attach('session.validate', array($validator, 'isValid'));

                               }
                           }
                       } else {
                           $sessionManager = new SessionManager();
                       }
                       Container::setDefaultManager($sessionManager);
                       return $sessionManager;
                   },
           )
        );

    }
}
