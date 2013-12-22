<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'UNICEF PCA Tracking Tool',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		//'application.extensions.CAdvancedArBehavior',
		'application.extensions.ESaveRelatedBehavior',
		'application.extensions.alpha',
		'application.modules.user.models.*',		
		'application.modules.profile.models.*',
		'application.modules.role.models.*',
		'application.modules.friendship.models.*',
		'application.vendors.phpexcel.PHPExcel'


	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'art',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1','46.99.39.9'),),

		'user' => array(
			'debug' => true,
			),		
		//'registration' => array(),
        'avatar' => array(),
        'role' => array(),
        'messages' => array(),
        'usergroup' => array(),
        // 'membership' => array(),
        'message'=>array(),
        'profile' => array(),
        'friendship' => array()
        
		
	),

	// application components
	'components'=>array(


		// include User Management extension components

		// include user components
		'user'=>array(
			// enable cookie-based authentication
			'class' => 'application.modules.user.components.YumWebUser',
			'allowAutoLogin'=>true,
			'loginUrl' => array('//user/login'),
		),
		// 'registration' => array(
  //           'enableRegistration' => true,
  //           'enableCaptcha' => true,
  //           'debug' => true,
  //           'registrationView' => 'application.views.registration.registration',
  //           'controllerMap' => array(
  //               'registration' => array(
  //                   'class' => 'application.controllers.RegistrationController' ),
  //           ),
  //       ),
		
		//include user models. tell your app to have access to User Model even if not in extension enviroment. 
		

		// set cashing component.
  		'cache' => array(
  			'class' => 'system.caching.CDummyCache'
  		),
  		
		// uncomment the following to enable URLs in path-format
		
		'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName'=>false,
			'rules'=>array(
				'caseSensitive'=>false,     
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		
		// 'db'=>array(
		// 	'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		// ),
		// uncomment the following to use a MySQL database
		
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=pcatracking',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '1dff352a54835700',
			'charset' => 'utf8',
			'tablePrefix' => '', 	   
		),
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
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

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),
);