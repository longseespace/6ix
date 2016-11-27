<?php
  $cs = Yii::app()->clientScript;
  $cs->defaultScriptFilePosition = CClientScript::POS_HEAD;
  $baseUrl = $this->assetsUrl;

  // Enqueue styles
  $cs->registerCssFile($baseUrl.'/css/checkboxes.css');
  $cs->registerCssFile($baseUrl.'/css/jqueryui.css');
  $cs->registerCssFile($baseUrl.'/css/tipsy.css');
  $cs->registerCssFile($baseUrl.'/css/tags.css');
  $cs->registerCssFile($baseUrl.'/css/chosen.css');
  $cs->registerCssFile($baseUrl.'/css/jquery.popover.css');

  // Enqueue scripts
  $cs->registerScriptFile($baseUrl.'/js/jqueryui.min.js');
  $cs->registerScriptFile($baseUrl.'/js/formalize.min.js');
  $cs->registerScriptFile($baseUrl.'/js/jquery.metadata.js');
  $cs->registerScriptFile($baseUrl.'/js/jquery.checkboxes.js');
  $cs->registerScriptFile($baseUrl.'/js/jquery.fileinput.js');
  $cs->registerScriptFile($baseUrl.'/js/jquery.chosen.js');
  $cs->registerScriptFile($baseUrl.'/js/jquery.popover.js');

?>

<?php echo $this->renderPartial('_form_'.$model->type, array('model'=>$model)); ?>