<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'ONE ART Taipei ',
    'sourceLanguage'=>'zh_tw',
    'timeZone' => 'Asia/Taipei',
	//'timeZone' => 'UTC',
	// preloading 'log' component
	'preload'=>array('log'),
	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.widgets.*',
		'application.extensions.ExportDataExcel',
	),
	
	'defaultController'=>'member',
	
	'modules'=>array(
		// uncomment the following to enable the Gii tool
		'gii'=>(defined('YII_DEBUG') && YII_DEBUG) ? array(
			'class'=>'system.gii.GiiModule',
			'password'=>getenv('GII_PASSWORD') ?: '3w23648736',
		 	// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1','220.130.187.133','220.130.187.134','220.130.187.135','122.116.164.165'),
		) : array(),
	),
	// application components
	'components'=>array(
        'myClass' => array(
            'class' => 'MyClass',
        ),
		'user'=>array(
			// enable cookie-based authentication
			'class'=>'WebUser',
			'allowAutoLogin'=>true,
			//'authTimeout'=>60*30,
            'identityCookie' => array('httpOnly'=>true), //if span to multiple subdomains set 'domain'=>'.domain.com'; default: 'path'=>'/',
            'loginUrl'=> array('site/top2login'),
		),
		// uncomment the following to enable URLs in path-format
		'urlManager'=>array(
			'urlFormat'=>'path',
			//'languages' => ['TW', 'EN'],
			'showScriptName'=>false,
			'rules'=>array(
				//'/'=>'home/index',
				'<language:(zh|en)>'=>'home/index',
				'<language:(zh|en)>/<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<language:(zh|en)>/<controller:post>/<action:credit>/<type2:\w+>'=>'<controller>/<action>',
				'<language:(zh|en)>/<controller:member>/<action:checkemail>/<id:\w+>'=>'<controller>/<action>',
				'<language:(zh|en)>/<controller:home>/<action:page>/<view:.+>'=>'<controller>/<action>',
				'<language:(zh|en)>/<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<language:(zh|en)>/<controller:\w+>/<action:\w+>'=>'<controller>/<action>'
			),
		),
		/*
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=juso1326_ota',
			'emulatePrepare' => true,
			'username' => 'juso1326_work',
			'password' => '4a0zZvV-bnk+',
			'charset' => 'utf8',
			'tablePrefix' => 'zx_', //表格前綴詞
		),
		*/
		
		// 'db'=>array(
		// 	'connectionString' => 'mysql:host=localhost;dbname=onearttaipei',
		// 	'emulatePrepare' => true,
		// 	'username' => 'root',
		// 	'password' => 'root',
		// 	'charset' => 'utf8',
		// 	'tablePrefix' => 'zx_', //表格前綴詞
		// ),
		'db'=>array(
            'charset' => 'utf8mb4',
			'connectionString' => 'mysql:host=' . (getenv('DB_HOST') ?: 'localhost') . ';dbname=' . (getenv('DB_NAME') ?: 'juso1326_ota'),
			'emulatePrepare' => true,
			'username' => getenv('DB_USER') ?: 'juso1326_work',
			'password' => getenv('DB_PASSWORD'),
			'charset' => 'utf8mb4',
			'tablePrefix' => 'zx_', //表格前綴詞
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
					'categories'=>'system.db.*',
				),
                // array(
                //     'class'=>'CFileLogRoute',
                //     'levels'=>['error', 'warning','info'],
                //     'categories'=>'system.*',
                // ),
                // array(
                //     'class'=>'CEmailLogRoute',
                //     'levels'=>['error', 'warning'],
                //     'emails'=>'juso@3wcreative.com.tw',
                // ),
				// uncomment the following to show log messages on web pages
				/*
				array(
				    'class'=>'CWebLogRoute',
				),
				*/
			),
		),
		//Security
		'request'=>array(
            'enableCsrfValidation'=>true,  //CHtml::form
            'enableCookieValidation'=>true,//CHttpCookie
 			'csrfCookie'=>array(
				'httpOnly'=>true, //O大寫
			),
        ),
        'session' => array(
			'class' => 'CDbHttpSession',
			'timeout' => 14400,
            'connectionID' => 'db',
            'cookieParams' => array('httponly'=>true), //o小寫; 'domain'=>'','path'=>'/',
			'sessionName' => 'yiisession',
			'useTransparentSessionID'=>false,
			//'useTransparentSessionID'   =>($_POST['PHPSESSID'] || $_GET['PHPSESSID']) ? true : false,
			'cookieMode'                =>'only',
        ),
		'og' => array(
		    'class' => 'ext.opengraph.Opengraph',
		),
        'Smtpmail'=>array(
			'class'=>'application.extensions.smtpmail.PHPMailer',
			'SMTPAuth'=>true,
			'Host'=>getenv('SMTP_HOST') ?: "smtp.gmail.com",
			'SMTPSecure'=>"tls",
			'Port'=>getenv('SMTP_PORT') ?: 587,
			'Username'=>getenv('SMTP_USER') ?: 'application.oat@gmail.com',
			'Password'=>getenv('SMTP_PASSWORD'),
			'Mailer'=>'smtp'
		),
		/*
        'Smtpmail'=>array(
			'class'=>'application.extensions.smtpmail.PHPMailer',
			'SMTPAuth'=>true,
			'Host'=>"hwsmtp.exmail.qq.com",
			'Port'=>25,
			'Username'=>'application@onearttaipeien.com',
			'Password'=>'ZxKT4kpmYDw4Z6gN',
			//'Password'=>'ZxKT4kpmYDw4Z6gN',
		),
		*/
	),
	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>require(dirname(__FILE__).'/params.php'),
);