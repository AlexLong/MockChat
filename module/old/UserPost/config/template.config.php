<?php
return array(

    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
        'template_map' => array(
         //   'timeline/index' => __DIR__ . '/../view/user-timeline/index/index.phtml',
            'user_post/post_form' => __DIR__ . '/../view/user-post/post/_post_form.phtml'
        ),
        'strategies' => array(
            'ViewJsonStrategy',
        ),


    ),


);