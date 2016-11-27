<?php
  $cs = Yii::app()->clientScript;
  $cs->defaultScriptFilePosition = CClientScript::POS_HEAD;
  $baseUrl = $this->assetsUrl;
  $feAssetUrl = $this->getAssetsUrl('6ix');

  // Enqueue styles
  $cs->registerCssFile($baseUrl.'/css/checkboxes.css');
  $cs->registerCssFile($baseUrl.'/css/jqueryui.css');
  $cs->registerCssFile($baseUrl.'/css/tipsy.css');
  $cs->registerCssFile($baseUrl.'/css/tags.css');
  $cs->registerCssFile($baseUrl.'/css/chosen.css');
  $cs->registerLinkTag('stylesheet', 'text/less', $feAssetUrl.'/less/block.less');

  // Enqueue scripts
  $cs->registerScriptFile($baseUrl.'/js/jqueryui.min.js');
  $cs->registerScriptFile($baseUrl.'/js/formalize.min.js');
  $cs->registerScriptFile($baseUrl.'/js/jquery.metadata.js');
  $cs->registerScriptFile($baseUrl.'/js/jquery.checkboxes.js');
  $cs->registerScriptFile($baseUrl.'/js/jquery.chosen.js');
  $cs->registerScriptFile($feAssetUrl.'/js/less.js');

?>

<div class="block" id="preview">
  <?php if (empty($block->elements)): ?>
  <div class="placeholder">EMPTY BLOCK</div>  
  <?php endif ?>
  <div class="elements">
  <?php foreach ($block->elements as $element_id => $e): ?>
    <div class="<?php echo "no-space {$e->width} {$e->height} {$e->float} {$e->border} {$e->class}" ?>" id="element-<?php echo $element_id ?>" data-id='<?php echo $element_id ?>'>
    <?php 
      $this->widget('application.widgets.Element.ElementWidget', array(
        'element_id' => $element_id
      ));
    ?>
    </div>
  <?php endforeach ?>
  </div>
  <div class="clear"></div>
</div>

<div class="box column-left" id="block-box">
  <?php echo $this->renderPartial('_form', array('block'=>$block)); ?>
</div>

<div class="box column-right" id="element-box">
  <?php echo $this->renderPartial('_element_form'); ?>
</div>