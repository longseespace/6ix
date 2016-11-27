<?php
  return array(
    'modules' => array(
      'user' => array(
        'loginUrl' => array('/user/login'),
        'registrationUrl' => array('/user/register'),
        'autoLogin' => true,
        'sendActivationMail' => false,
        'activeAfterRegister' => true,
        'captcha' => array(),
        'tableUsers' => 'user',
        'tableProfiles' => 'profile',
        'tableProfileFields' => 'profile_field'
      )
    ),
    'components' => array(
      'user' => array(
        'class' => 'application.modules.user.components.WebUser',
        'allowAutoLogin' => true,
        'loginUrl' => array('/user/login')
      )
    ),
    'import'=>array(
      'application.modules.user.UserModule',
      'application.modules.user.models.*',
      'application.modules.user.components.*'
    )
  );
?>