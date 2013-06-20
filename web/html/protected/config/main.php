<?php

Yii::setPathOfAlias('bootstrap', dirname(__FILE__).'/../extensions/bootstrap');

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'KanKan',

	// preloading 'log' component
	'preload'=>array('log'),

    //'language'=>'zh_cn',//要翻译的语言，这个可以在程序中动态设置
	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),
    'theme' => 'charisma',
	'modules'=>array(
		// uncomment the following to enable the Gii tool

		'gii'=>array(
            'generatorPaths'=>array(
                'bootstrap.gii',
            ),
			'class'=>'system.gii.GiiModule',
			'password'=>'daisy',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
        "admin"
	),

	// application components
	'components'=>array(
        'bootstrap'=>array(
            'class'=>'bootstrap.components.Bootstrap',
        ),
		'user'=>array(
			// enable cookie-based authentication
			//'allowAutoLogin'=>true,
            'class' => 'WebUser'
		),
		// uncomment the following to enable URLs in path-format
        'session' => array(
            //'cookieParams' => array('path'=>'/','domain'=>'.kankan.com'),
        ),

		'urlManager'=>array(
			'urlFormat'=>'path',
            'showScriptName'=>false,
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),

		/*
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		*/
		// uncomment the following to use a MySQL database

		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=kankan',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => 'abeajqn',
			'charset' => 'utf8',
		),

		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
        'viewRenderer'=>array(
            'class'=>'application.extensions.ESmartyViewRenderer',
            'fileExtension' => '.tpl',
            //'pluginsDir' => 'application.smartyPlugins',
            //'configDir' => 'application.smartyConfig',
            //'prefilters' => array(array('MyClass','filterMethod')),
            //'postfilters' => array(),
            'config'=>array(
                'force_compile' => YII_DEBUG,
            //   ... any Smarty object parameter
            )
        ),

		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning, trace',
                    'categories'=>'system.db.CDbCommand'
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
        'url_prefix' => '/',
        'link_prefix' => '/',
		'adminEmail'=>'abraham1@163.com',
        'adminName' => 'kankan',
        /*
         * 密码使用了PwdHelper.encode加密
         * 原始密码为 gjl1vO6u 这是随机生成的强密码。
         * 如果要改密码请使用PwdHelper.encode（位于/protected/components/PwdHelper.php）生成密码
         * 如果不清楚怎么做，请联系本项目的开发人员，abraham1@163.com
         *
         */
        'adminPassword' => '880f15fa6a37bde5dfcf8a17ee193e7b',
        /*
         * 看看的图片上传服务器列表。为分布式做简单的铺垫。
         */
        'KanKanImageServer' => array(
            'http://localhost:8089'
        ),
        'maxViewNumberEachDay' => 3,
        'staticServer' => 'http://localhost:8090',
        'uploadDir'=> '/Users/abraham/workspace/kan/web/static'

	),
);