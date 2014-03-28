<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'MockChat\Controller\Chat' => 'MockChat\Controller\ChatController',

        ),
    ),

    'router' => array(
        'routes' => array(
            'mock_chat' => array(
                'type' => 'Literal',
                'options' => array(
                    'route'    => '/mock',
                    'defaults' => array(
                        'controller' => 'MockChat\Controller\Chat',
                        'action' => 'index'
                    ),
                ),
            ),

        ),


    ),
);