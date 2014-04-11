<?php
return array(

    'view_manager' => array(

        'display_not_found_reason' => false,
        'display_exceptions'       => false,
        'doctype'                  => 'HTML5',

        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
        'strategies' => array(
            'ViewJsonStrategy',
            'ImageStrategy'
        ),
        //'asset_directory' => $this->basePath() . '/st/tmln',
    ),
);