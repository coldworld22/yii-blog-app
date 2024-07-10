<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
    'name'=>'Your Application',
	'defaultController' => 'site/login',

    // preloading 'log' component
    'preload'=>array('log'),

    // autoloading model and component classes
    'import'=>array(
        'application.models.*',
        'application.components.*',
    ),

    // application components
    'components'=>array(
        'user' => array(
        'class' => 'WebUser', // If you extend CWebUser
        'allowAutoLogin' => true, // Enables cookie-based authentication
        'loginUrl' => array('/site/login'), // Your login action
		'class' => 'CWebUser',
    ),
	'request' => array(
            'enableCsrfValidation' => true, // Correctly place it here
        ),
        // uncomment the following to enable URLs in path-format
        /*
        'urlManager'=>array(
            'urlFormat'=>'path',
            'rules'=>array(
                '<controller:\w+>/<id:\d+>'=>'<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
                '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
            ),
        ),
        */
        'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=yii_blog_db',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '', // Ensure this is correct as per your XAMPP setup
			'charset' => 'utf8',
		),
        'errorHandler'=>array(
            'errorAction'=>'site/error',
        ),
        'log'=>array(
            'class'=>'CLogRouter',
            'routes'=>array(
                array(
                    'class'=>'CFileLogRoute',
                    'levels'=>'error, warning',
                ),
                // uncomment the following to show log messages on web pages
                /*
                array(
                    'class'=>'CWebLogRoute',
                ),
                */
            ),
        ),
    ),

    'modules'=>array(
        'gii'=>array(
            'class'=>'system.gii.GiiModule',
            'password'=>'12345678',  // This should be replaced with a secure password.
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters'=>array('127.0.0.1','::1'),
        ),
    ),
);
