<?php
$cs = Yii::app()->clientScript;
$cs->defaultScriptFilePosition = CClientScript::POS_HEAD;
$baseUrl = $this->assetsUrl;

// Register scripts
$cs->registerCoreScript('jquery');
$cs->registerCoreScript('jquery.ui');
$cs->registerScriptFile($baseUrl.'/js/jquery.livequery.js');
$cs->registerScriptFile($baseUrl.'/js/jquery.jgrowl.min.js');
$cs->registerScriptFile($baseUrl.'/js/notifications.js');
$cs->registerScriptFile($baseUrl.'/js/smoke.min.js');
//$cs->registerScriptFile($baseUrl.'/js/jquery.validate.js');
$cs->registerScriptFile($baseUrl.'/js/jquery.chosen.js');
$cs->registerScriptFile($baseUrl.'/js/jquery.fileinput.js');
$cs->registerScriptFile($baseUrl.'/js/jquery.filedrop.js');
$cs->registerScriptFile($baseUrl.'/js/pandora.uploader.js');
$cs->registerScriptFile($baseUrl.'/js/jquery.contextmenu.js');

$cs->registerScriptFile($baseUrl.'/js/application.js');
$cs->registerScriptFile($baseUrl.'/js/modules/' . $this->id . '.js');

// Register css
$cs->registerCssFile($baseUrl.'/css/reset.css');
$cs->registerCssFile($baseUrl.'/css/fonts.css');
$cs->registerCssFile($baseUrl.'/css/formalize.css');
$cs->registerCssFile($baseUrl.'/css/icons.css');
$cs->registerCssFile($baseUrl.'/css/main.css');
$cs->registerCssFile($baseUrl.'/css/jquery.jgrowl.css');
$cs->registerCssFile($baseUrl.'/css/notifications.css');
$cs->registerCssFile($baseUrl.'/css/portrait.css', 'all and (orientation:portrait)');
$cs->registerCssFile($baseUrl.'/css/smoke.css');
$cs->registerCssFile($baseUrl.'/css/smoke/dark.css');
$cs->registerCssFile($baseUrl.'/css/chosen.css');
$cs->registerCssFile($baseUrl.'/css/pandora.uploader.css');
$cs->registerCssFile($baseUrl.'/css/jquery.contextmenu.css');

$cs->registerCssFile($baseUrl.'/css/modules/' . $this->id . '.css');

?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <meta name="viewport" content="width=1024px, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta charset="UTF-8">

    <title><?php echo CHtml::encode($this->pageTitle); ?></title>

    <!-- HTML5 shim, for IE6-8 support of HTML elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
  </head>

  <body>
    <div id="overlay"><div id="modalcontainer"></div></div>

    <nav id="primary">
      <?php
      $this->widget('application.modules.admin.widgets.AdminMenu', array(
        'submenuHtmlOptions' => array('class' => 'submenu'),
        'items' => array(
          // Important: you need to specify url as 'controller/action',
          // not just as 'controller' even if default acion is used.
          // array(
          //   'label' => 'Warehouse',
          //   'url' => 'warehouse/catalog',
          //   'icon' => 'glyph note',
          //   'itemOptions' => array('class' => 'warehouse showSubmenu'),
          //   'items' => array(
          //     array('label' => 'Import', 'url' => array('/product')),
          //   )
          // ),
          array(
            'label' => 'Warehouse',
            'url' => array('/'),
            'icon' => 'glyph suitcase',
            'itemOptions' => array('class' => 'import showSubmenu'),
            'items' => array(
              array('label' => 'Import', 'url' => array('import/index')),
              array('label' => 'Lottes', 'url' => array('lotte/admin')),
              array('label' => 'Locations', 'url' => array('location/admin')),
            )
          ),
          array(
            'label' => 'Manage',
            'url' => array('/'),
            'icon' => 'glyph tools',
            'itemOptions' => array('class' => 'manage showSubmenu'),
            'items' => array(
              array('label' => 'Upcs', 'url' => array('/')),
            )
          ),
          array(
            'label' => 'Log Out',
            'url' => '/',
            'icon' => 'glyph quit',
            'itemOptions' => array('class' => 'bottom')
          ),
        )
      ));
      ?>
    </nav>

    <nav id="secondary">
    </nav>

    <section id="maincontainer">
      <div id="main">
        <?php echo $content ?>
      </div>
    </section>

    <div id="notifications" class="linen">
      <a class="show" title="Show All Notifications" href="#"><span class="glyph info"></span></a>
      <a class="hide" title="Hide All Notifications" href="#" style="display: none"><span class="glyph info"></span></a>
      <div class="clear"></div>
      <div class="notifications">
        <ul>
          <?php foreach ($notifications as $notification): ?>
            <li><?php echo $notification['message'] ?></li>
          <?php endforeach ?>
        </ul>
      </div>
    </div>

    <!-- Just examples, can be removed in production -->
    <?php // echo $asset->script('admin/application.js') ?>

  </body>
</html>