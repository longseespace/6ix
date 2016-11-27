<?php
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
// change the following paths if necessary
$yii=dirname(__FILE__).'/../framework/yii.php';
$kickstart=dirname(__FILE__).'/protected/kickstart.php';
$env=dirname(__FILE__).'/protected/env.local.php';

if(file_exists($env)){
  require_once($env);
}
require_once($kickstart);

// include Yii
require_once($yii);

$config=require_once(dirname(__FILE__).'/protected/config/main.php');
$common=require_once(dirname(__FILE__).'/protected/config/common.php');
$config = array_merge_recursive_distinct($config, $common);
foreach (glob(dirname(__FILE__).'/protected/config/includes/*.php') as $filename){
  $c = require_once($filename);
  $config = array_merge_recursive_distinct($config, $c);
}

Yii::createWebApplication($config)->run();