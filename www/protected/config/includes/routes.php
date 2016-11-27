<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return array(
  // application components
  'components'=>array(
    // uncomment the following to enable URLs in path-format
    'urlManager'=>array(
      'urlFormat'=>'path',
      'showScriptName'=>false,
      'rules'=>array(
        // special routes

        // admin
        // 'admin' => 'admin/dashboard',
        // 'admin/<action:(login|logout)>' => 'admin/admin/<action>',
        // 'admin/<controller:\w+>/<id:\d+>' => 'admin/<controller>/view',
        // 'admin/<controller:\w+>/<action:\w+>/<id:\d+>' => 'admin/<controller>/<action>',
        // 'admin/<controller:\w+>/<action:\w+>' => 'admin/<controller>/<action>',
        // '<module:\w+>/<controller:\w+>/<action:\w+>/<id:\d+>' => '<module>/<controller>/<action>',

        // general
        '<controller:\w+>/<id:\d+>' => '<controller>/view',
        '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
        '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
      ),
    ),
  )
);

?>