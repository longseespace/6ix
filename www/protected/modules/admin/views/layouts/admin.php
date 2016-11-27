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
$cs->registerScriptFile($baseUrl.'/js/jquery.validate.js');
$cs->registerScriptFile($baseUrl.'/js/jquery.chosen.js');
$cs->registerScriptFile($baseUrl.'/js/jquery.popover.js');
$cs->registerScriptFile($baseUrl.'/js/unorm.js');
$cs->registerScriptFile($baseUrl.'/js/jquery.slugify.js');
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
$cs->registerCssFile($baseUrl.'/css/jquery.popover.css');

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
          array(
            'label' => 'Dashboard', 
            'url' => array('/admin'),
            'icon' => 'glyph dashboard',
            'itemOptions' => array('class' => 'dashboard'),
          ),
          array(
            'label' => 'Catalog', 
            'url' => array('product/index'),
            'icon' => 'glyph note',
            'itemOptions' => array('class' => 'catalog showSubmenu'),
            'items' => array(
              array('label' => 'Products', 'url' => array('product/index')),
              array('label' => 'Flash Sale', 'url' => array('campaign/index')),
              array('label' => 'Category', 'url' => array('category/index')),
              array('label' => 'Brand', 'url' => array('brand/index')),
              array('label' => 'Color', 'url' => array('color/index')),
              array('label' => 'Size', 'url' => array('size/index')),
            )
          ),
          array(
            'label' => 'Users', 
            'url' => array('user/index'),
            'icon' => 'glyph user',
            'itemOptions' => array('class' => 'users showSubmenu'),
            'items' => array(
              array('label' => 'User', 'url' => array('user/index')),
              array('label' => 'Admin', 'url' => array('admin/index')),
              array('label' => 'Review', 'url' => array('review/index')),
            )
          ),
          array(
            'label' => 'Transactions', 
            'url' => array('/'), 
            'icon' => 'glyph cart',
            'itemOptions' => array('class' => 'transactions'),
          ),
          array(
            'label' => 'CMS', 
            'url' => array('menu/index'),
            'icon' => 'glyph images',
            'itemOptions' => array('class' => 'cms showSubmenu'),
            'items' => array(
              array('label' => 'Menu', 'url' => array('menu/index')),
              array('label' => 'Block', 'url' => array('block/index')),
              array('label' => 'Element', 'url' => array('element/index')),
              array('label' => 'FAQ', 'url' => array('faq/index')),
              array('label' => 'Page', 'url' => array('page/index')),
              array('label' => 'File', 'url' => array('file/index')),
            )
          ),
          array(
            'label' => 'Log Out', 
            'url' => '/user/logout',
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