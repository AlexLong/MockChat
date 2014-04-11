<?php
/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

return array(

    'dev_mode' => array(
        'under_dev' => true,
    ),

    'db' => array(
        'driver'         => 'Pdo',
        'dsn'            => 'mysql:dbname=ribbit;host=localhost',
        'driver_options' => array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
        ),
    ),



    'session' => array(
        'config' => array(
            'class' => 'Zend\Session\Config\SessionConfig',
            'options' => array(
                'name' => 'c_user',
            ),
        ),

        'storage' => 'Zend\Session\Storage\SessionArrayStorage',
        'handler_options' => array(
            'database' => 'ribbit',
            'collection' => 'sessions',
            'dataField' => 'session',
            'lifetimeField' => 'expires'
        ),

        'validators' => array(
            'Zend\Session\Validator\RemoteAddr',
            'Zend\Session\Validator\HttpUserAgent',
        ),
    ),


    // ...
);
