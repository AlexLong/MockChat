<?php
return array(
    'mongodb' => array(
        'server' => "mongodb://localhost:27017",
        'database' => "ribbit",
    ),

    'user_file_manager' => array(
        'directories' => array(
            'public_directory' => 'data/assets',
            'profile_image_folder' => 'profile_image',
            'root_dir' => 'assets'
        ),
        'directory_permission' => 755
    ),



);