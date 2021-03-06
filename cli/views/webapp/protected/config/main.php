<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'language'=>'en',
	'name'=>'My Web Application',

	'aliases' => array(
          'booster' => 'application.extensions.boosterku', // change this if necessary
          'gallery' => 'application.modules.gallery',
          'staticpage' => 'application.modules.staticpage',
    ),

	// preloading 'log' component
	'preload'=>array('log','booster'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'ext.boosterku.widgets.*',
		'ext.esearch.*',
		'ext.yiifilemanager.*',
	   	'ext.yiifilemanagerfilepicker.*',
		'application.modules.slider.models.*',
		'application.modules.staticpage.models.*',
		'application.modules.gallery.models.*',
		'application.modules.blog.models.*',
		'application.modules.slider.components.*',
		'application.modules.staticpage.components.*',
		'application.modules.gallery.components.*',
		'application.modules.blog.components.*',
	),

	'behaviors' => array(
	    'runEnd' => array(
	       'class' => 'application.components.WebApplicationEndBehavior',
	    ),
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		/*
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'Enter Your Password Here',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		*/
		'staticpage'=>array(
			'class'=>'application.modules.staticpage.StaticpageModule',
			'glyphicon'=>'file'
		),
		'blog'=>array(
			'class'=>'application.modules.blog.BlogModule',
			'subNav'=>array('category','comments','tags'),
			'name_alias'=>'Blog',
			'glyphicon'=>'list'

		),
		'slider'=>array(
			'class'=>'application.modules.slider.SliderModule',
			'glyphicon'=>'list-alt'
		),
		'photos'=>array(
			'class'=>'application.modules.gallery.GalleryModule',
			'glyphicon'=>'picture'
		),
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
			'loginUrl' => array('/site/login'),
			'class'=>'WebUser',
			
		),
		'booster' => array(
            'class' => 'ext.boosterku.components.Booster',
        ),
		// uncomment the following to enable URLs in path-format
		
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				// '<controller:\w+>/<id:\d+>'=>'<controller>/view',
				// '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				// '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),

		'fileman' => array(
		        'class'=>'application.extensions.yiifilemanager.YiiDiskFileManager',
		        'storage_path' => dirname(__FILE__)."/../../images/Blog/",
		),
		
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		// uncomment the following to use a MySQL database
		/*
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=testdrive',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
		),
		*/
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
		'adminEmail'=>'hidden_rebel@rocketmail.com',
		'images'=>dirname(__FILE__).'/../../images/',
		'uploadBlog'=>dirname(__FILE__).'/../../images/blog/',
		'uploadSlider'=>dirname(__FILE__).'/../../images/slider/',
	),
);