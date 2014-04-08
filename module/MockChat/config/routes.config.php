<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'MockChat\Controller\Index' => 'MockChat\Controller\IndexController',

        ),
    ),

    'router' => array(
        'routes' => array(
            'mock_chat' => array(
                'type' => 'Literal',
                'options' => array(
                    'route'    => '/mock',
                    'defaults' => array(
                        'controller' => 'MockChat\Controller\Index',
                        'action' => 'index'
                    ),
                ),
            ),
        ),


    ),
);