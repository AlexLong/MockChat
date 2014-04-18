<?php
return array(

    'controllers' => array(
        'invokables' => array(

            'UserProfileEditor\Controller\Index' => 'UserProfileEditor\Controller\IndexController',
            'UserProfileEditor\Controller\ProfileAsset' => 'UserProfileEditor\Controller\ProfileAssetController',
        )
    ),
    'router' => array(
        'routes' => array(

            'private_profile' => array(
                'type' => 'Literal',

                'options' => array(
                    'route'    => '/edit',
                    'constraints' => array(
                    ),
                    'defaults' => array(
                        'controller' => 'UserProfileEditor\Controller\Index',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'p_child' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/:action[/]',
                            'constraints' => array(
                                'action'     => '[a-zA-Z0-9_-]+',
                            ),
                            'defaults' => array(
                                'controller' => 'UserProfileEditor\Controller\Index',
                                'action' => 'index',
                            ),

                        ),
                    ),
                ),
            ),

        ),
    ),
);