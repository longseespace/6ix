<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.

return array(
  'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
  'name'=>'6ix',
  'theme' => '6ix',

  // preloading 'log' component
  'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),

	'modules'=>array(
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'123'
		)
	),

	// application components
	'components'=>array(
		'db'=>array(
      'connectionString' => 'mysql:host=ocd.dynabyte.vn;dbname=6ixv1_dev',
      'emulatePrepare' => false,
      'username' => '6ixv1_dev',
      'password' => '9fnBZ8mRsYjCZpQf',
      'charset' => 'utf8',
      'enableProfiling' => YII_DEBUG,
      'enableParamLogging' => YII_DEBUG,
      'schemaCachingDuration' => YII_DEBUG ? 0 : 3600,
    ),
		'errorHandler'=>array(
			'errorAction'=>'site/error',
		),
    'clientScript'=>array(
      'coreScriptUrl'=>'/source/js'
    )
	),
  'params'=>array(
    // this is used in contact page
    'adminEmail'=>'webmaster@example.com',
    'languages'=>array('vi' => 'Tiếng Việt', 'en' => 'English'),
    'cities' => array("Hà Nội", "TP. HCM", "An Giang", "Bình Dương", "Bình Phước",
      "Bình Thuận", "Bình Định", "Bạc Liêu", "Bắc Giang", "Bắc Kạn", "Bắc Ninh", "Bến Tre", "Cao Bằng", "Cà Mau", "Cần Thơ",
      "Điện Biên", "Đà Nẵng", "Đắk Lắk", "Đắk Nông", "Đồng Nai", "Đồng Tháp",
      "Gia Lai", "Hà Giang", "Hà Nam", "Hà Tĩnh", "Hòa Bình", "Hưng Yên", "Hải Dương", "Hải Phòng", "Hậu Giang",
      "Khánh Hòa", "Kiên Giang", "Kon Tum", "Lai Châu", "Long An", "Lào Cai", "Lâm Đồng", "Lạng Sơn", "Nam Định", "Nghệ An",
      "Ninh Bình", "Ninh Thuận", "Phú Thọ", "Phú Yên", "Quảng Bình", "Quảng Nam ", "Quảng Ngãi", "Quảng Ninh", "Quảng Trị",
      "Sóc Trăng", "Sơn La", "Thanh Hóa", "Thái Bình", "Thái Nguyên", "Thừa Thiên Huế", "Tiền Giang", "Trà Vinh",
      "Tuyên Quang", "Tây Ninh", "Vĩnh Long", "Vĩnh Phúc", "Vũng Tàu", "Yên Bái"
    )
  ),
  'aliases' => array(
    'widgets' => 'application.widgets',
  ),
);
