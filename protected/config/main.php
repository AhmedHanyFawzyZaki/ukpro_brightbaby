<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.

Yii::setPathOfAlias('bootstrap', dirname(__FILE__).'/../extensions/bootstrap');


return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'BrightBaby',
	'defaultController'=>'Home',
	//'homeUrl'=>'home',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		//'application.extensions.yiichat.*',
//		'application.extensions.LocationPicker.*',
		'ext.YiiMailer.YiiMailer',		

    	'ext.shoppingCart.*',

		'ext.galleryManager.*',
    	'ext.galleryManager.models.*',
    	'ext.galleryManager.GalleryController',

	),


    //'theme'=>'bootstrap', // requires you to copy the theme under your themes directory


	'modules'=>array(
		// uncomment the following to enable the Gii tool

		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'admin',
			'generatorPaths'=>array(
				'bootstrap.gii',
			),
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('*','::1'),
		),

	),


	// application components
	'components'=>array(
		'bootstrap'=>array(
			'class'=>'bootstrap.components.Bootstrap',
		),
		

		///////////// shopping cart
	    'shoppingCart' =>array(
	        'class' => 'ext.shoppingCart.EShoppingCart',
	        ),

		/* **For gallery extension  ** */
		'widgetFactory' => array(
		'class' => 'CWidgetFactory',
		'widgets' => array(

		    'GalleryManager'=>array(
		        'controllerRoute' => '/gallery',
		    ) ,


		)
		),

		'image' => array(
            'class' => 'application.extensions.image.CImageComponent',
            // GD or ImageMagick
            'driver' => 'GD',
            // ImageMagick setup path
        	'params'=>array('directory'=>'/var/www/projects/PHPLib/ImageMagick-6.8.6-8'),
        ),

			'mailer'=>array(
			'class'=>'ext.mail.Mailer',
		),

		'Paypal' => array(
		'class'=>'application.components.Paypal',
		'apiUsername' => 'prosel_1355392367_biz_api1.ukprosolutions.com',
		'apiPassword' => '1355392425',
		'apiSignature' => 'A3wB9wrrNWpacpiQQX9SVBFeXSFJALS5DGVJQ4H9X99K1efvyNjmnZGs',
		'apiLive' => false,
		'currency' => 'GBP',
		'returnUrl' => 'home/confirm/', //regardless of url management component
		'cancelUrl' => 'home/cancel/', //regardless of url management component
		),




		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		// uncomment the following to enable URLs in path-format

		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
				//'hometest/<slug:[a-zA-Z0-9-]+>'=>'hometest/product',
				//'hometest/<title>'=>'hometest/product',
				//'hometest/product/<title>'=>'hometest/product',
				'home/productDetails/<slug>'=>'home/productDetails',

			),
		),

		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		// uncomment the following to use a MySQL database


		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=brightbaby',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
		),

		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'home/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages

					//array(
					//	'class'=>'CWebLogRoute',
					//),
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'test@ukprosolutions.com',
		'webSite'=>'http://www.brightbaby.domains4reg.com',
	),
);