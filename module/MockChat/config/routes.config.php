<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'MockChat\Controller\Form' => 'MockChat\Controller\FormController',
            'MockChat\Controller\Asset' => 'MockChat\Controller\AssetController',

        ),
    ),
    'router' => array(
        'routes' => array(
            'mock_chat' => array(
                'type' => 'Literal',
                'options' => array(
                    'route'    => '/mock',
                    'defaults' => array(
                        'controller' => 'MockChat\Controller\Form',
                        'action' => 'index'
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'chat_child' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/:action[/]',
                            'constraints' => array(
                                'action'     => '[a-zA-Z0-9_-]+',
                            ),
                            'defaults' => array(
                                'controller' => 'MockChat\Controller\Form',
                                'action' => 'index',
                            ),

                        ),
                    ),
                ),
            ),
            'prof_asset' => array(
                'type' => 'Literal',
                'options' => array(
                    'route'    => '/assets',
                    'constraints' => array(
                    ),
                    'defaults' => array(
                        'controller' => 'MockChat\Controller\Asset',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'profile_img' => array(
                        'type'    => 'Zend\Mvc\Router\Http\Regex',
                        'options' => array(
                            //   'route'    => '/profile_image/:user_id/:picture_name[]',
                            'regex' => '/(?<user_id>[a-zA-Z0-9_-]+)/profile_image/(?<pic_name>[a-zA-Z0-9_-]+)(\.(?<format>(jpg|png|gif)))',
                            'defaults' => array(
                                'controller' => 'MockChat\Controller\Asset',
                                'action' => 'profileImg',
                                'format' => 'jpg'
                            ),
                            'spec' => '/profile_image/%user_id%/%pic_name%.%format%',
                        ),
                    ),
                ),
            ),

        ),


    ),
);