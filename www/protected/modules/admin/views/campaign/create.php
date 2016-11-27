<?php
  $cs = Yii::app()->clientScript;
  $cs->defaultScriptFilePosition = CClientScript::POS_HEAD;
  $baseUrl = $this->assetsUrl;

  
  $cs->registerCssFile($baseUrl.'/css/checkboxes.css');
  $cs->registerCssFile($baseUrl.'/css/jqueryui.css');
  $cs->registerCssFile($baseUrl.'/css/tipsy.css');
  $cs->registerCssFile($baseUrl.'/css/chosen.css');
  $cs->registerCssFile($baseUrl.'/css/jquery.timepicker.css');
  $cs->registerCssFile($baseUrl.'/css/modules/flashsale.css');


  $cs->registerScriptFile($baseUrl.'/js/formalize.min.js');
  $cs->registerScriptFile($baseUrl.'/js/jqueryui.min.js');
  $cs->registerScriptFile($baseUrl.'/js/jquery.metadata.js');
  $cs->registerScriptFile($baseUrl.'/js/jquery.datatables.js');
  $cs->registerScriptFile($baseUrl.'/js/jquery.validate.js');
  $cs->registerScriptFile($baseUrl.'/js/jquery.checkboxes.js');
  $cs->registerScriptFile($baseUrl.'/js/jquery.fileinput.js');
  $cs->registerScriptFile($baseUrl.'/js/jquery.chosen.js');
  $cs->registerScriptFile($baseUrl.'/js/jquery.timepicker.min.js');
  $cs->registerScriptFile($baseUrl.'/js/jquery.datepair.js');

  $cs->registerScriptFile($baseUrl.'/js/modules/flashsale.js');

?>

<div class="box column-left" id="flashsale-box">
  <?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>

<div class="box column-right" id="element-box">
  <?php echo $this->renderPartial('_search', array('model'=>$model)); ?>
</div>