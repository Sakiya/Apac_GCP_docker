<?php

// this contains the application parameters that can be maintained via GUI
// application-level parameters that can be accessed
// using Yii::app()->params['paramName'] 

return array(
	'md5Salt' => null,
	// this is displayed in the header section
	'title'=>'ONE ART Taipei ',
	'titleEN'=>'ONE ART Taipei ',
	'SSL'=>(isset($_SERVER['HTTPS']) && (strtolower($_SERVER['HTTPS']) != 'off')) ? 'https://' . $_SERVER['HTTP_HOST']: 'http://' . $_SERVER['HTTP_HOST'],
	// this is used in error pages
	'adminEmail'=>array(getenv('ADMIN_EMAIL') ?: 'info@onearttaipei.com'),
	'mailFromName'=>'ONE ART Taipei ',
	'mailend'=>'', 
	// the copyright information displayed in the footer section
	'copyrightInfo'=>'',
	// 後台預設分頁數量
	'backendPageSize' => 20,
	//後台action icon
	'backendIcon' => array('icon_list.gif', 'icon_new.gif', 'icon_E.gif', 'icon_D.gif', 'icon_F.gif', 'icon_R.gif', 'icon_V.gif', 'icon_arrange.gif','icon_exec.gif'),
	'dirname' => getenv('APP_DIRNAME') ?: '/home2/juso1326/website/onetaipeiair/www',//dirname(__FILE__),
    'customerfile' => array(
		'tmp' => '/_tmp',
		'file' => '/_file',
		'img' => '/_img',
		'year' => '/images/upload/year/',
		'gallery_experience' => '/images/upload/gallery/experience/',
		'gallery_art' => '/images/upload/gallery/art/',
		'gallery_award' => '/images/upload/gallery/award/',
		'gallery_print' => '/images/upload/gallery/print/',
		'gallery_usd300' => '/images/upload/gallery/usd300/',
    ),
    'folder' => array(
        'def' => '/images/upload/gallery/'
    ),
    'sub_folder' => array(
        'experience' => '/experience/',
        'art' => '/art/',
        'award' => '/award/',
        'print' => '/print/',
        'usd300' => '/usd300/',
    ),
	'LlangText' => array(
		'en' => '_en',
		'zh' => ''
	),

	'FlangText' => array(
		'en' => 'en_',
		'zh' => 'zh_'
	),
	
	'langCode' => array(
		'en' => 'en',
		'zh' => 'zh'
	),
	
	'langrecaptcha' => array(
		'en' => 'en',
		'zh' => 'zh-TW'
	),
	'galler_status' => array(
		'1' => '未驗證信箱',
		'2' => '未完成資料',
		'3' => '已付款',
		'4' => '取消報名',
	),
	'galler_pay_status' => array(
		'1' => '未付款',
		'2' => '已繳款',
		'3' => '人工完成繳款',
	),
	'week_chinese' => array(
		'0' => '日',
		'1' => '一',
		'2' => '二',
		'3' => '三',
		'4' => '四',
		'5' => '五',
		'6' => '六',
	),
	'galler_short' => array(
		'1'=>'未入圍',
		'2'=>'已入圍',
		'3'=>'未審核',
	),
);