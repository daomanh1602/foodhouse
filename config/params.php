<?php
return [ 
		'adminEmail' => 'admin@example.com',
		'active_languages'=>['vi', 'en'],
		
		// Page elements
		'page_layout' => '',
		'page_body_class' => '',
		
		'page_title' => '',
		'page_small_title' => '',
		'page_meta_title' => '',
		'page_encode_title' => true,
		'page_icon' => '',
		'page_icon_class' => '',
		'page_header' => '',
		
		'page_layout' => false,
		'body_class' => false,
		'hide_page_actions' => false ,
		
		//user
		'components.user' => [
			'identityClass' => 'app\models\admin\UserModel',
			'enableAutoLogin' => true ,
			'authTimeout'=>720000,
			'loginUrl'=>['admin/login'],
		],
];
