<?php
if (! defined ( 'NOW' ))
	define ( 'NOW', date ( 'Y-m-d H:i:s' ) );

$params = require (__DIR__ . '/params.php');
$db = require (__DIR__ . '/db.php');
Yii::setAlias('@web', 'http://localhost/foodhouse/web');
define('DIR', '/');
$config = [ 
		'id' => 'foodhouse',
		'basePath' => dirname ( __DIR__ ),
		'bootstrap' => ['log'],
		'extensions' => require(__DIR__ . '/../vendor/yiisoft/extensions.php'),		
		'language' => 'vi',
		'aliases'=>[
			'@www'=>'http://localhost/foodhouse/web',
		],
		'components' => [ 
				'assetManager' => [
					'bundles' => [
						'yii\web\JqueryAsset' => [
							'sourcePath' => null,
							'js' => ['https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'],
						],
					],
				],
				'authManager' => [
						'class' => 'yii\rbac\DbManager',
						
				],
				
				'i18n' => [
					'translations' => [
						'appuser' => [
							'class' => 'yii\i18n\PhpMessageSource',
							'fileMap' => [
								'appuser' => 'app.php'
							],
						] ,
					] ,
				],
				'request' => [ 
						// !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
					'cookieValidationKey' => 'NobitaNobi117162@' 
				],
				'cache' => [ 
					'class' => 'yii\caching\FileCache' 
				],
				
				'errorHandler' => [ 
					'errorAction' => 'site/error' 
				],
				'mailer' => [ 
					'class' => 'yii\swiftmailer\Mailer',						
					'useFileTransport' => true 
				],
				'log' => [ 
					'traceLevel' => YII_DEBUG ? 3 : 0,
					'targets' => [ 
						[ 
							'class' => 'yii\log\FileTarget',
							'levels' => [ 
								'error',
								'warning' 
							] 
						] 
					] 
				],
				'db' => $db,
				
				'urlManager' => [ 						
					'enablePrettyUrl' => true,
					'showScriptName' => false,
					// 'suffix' => '.html',
					'rules'=>[
						'' => 'home/index',
						'admin/login.html' => '/admin/login',
						
					],					
				] ,
				'user'=> [
					'identityClass' => 'app\models\admin\UserModel',
					'enableAutoLogin' => false ,
					'authTimeout'=>3600,
					'loginUrl'=>['admin/login'],
				],
		],
		'modules' => [
				'gridview' => [
			          'class' => '\kartik\grid\Module',
			          // see settings on http://demos.krajee.com/grid#module
			     ],
			     'datecontrol' => [
			          'class' => '\kartik\datecontrol\Module',
			          // see settings on http://demos.krajee.com/datecontrol#module
			     ],
			      // If you use tree table
// 			     'treemanager' =>  [
// 			          'class' => '\kartik\tree\Module',
// 			          // see settings on http://demos.krajee.com/tree-manager#module
// 			     ]
		],
		'params' => $params 
		
];


	// configuration adjustments for 'dev' environment
	$config ['bootstrap'] [] = 'debug';
	$config ['modules'] ['debug'] = [ 
			'class' => 'yii\debug\Module' ,
		// uncomment the following to add your IP if you are not connecting from localhost.
		//  'allowedIPs' => ['127.0.0.11', '::1'],
	];	
	$config ['bootstrap'] [] = 'gii';
	$config ['modules'] ['gii'] = [
			'class' => 'yii\gii\Module',
			// uncomment the following to add your IP if you are not connecting from localhost.
			//  'allowedIPs' => ['127.0.0.11', '::1'],
	];


return $config;
