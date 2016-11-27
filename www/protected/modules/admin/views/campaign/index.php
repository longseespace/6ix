<?php
  $cs = Yii::app()->clientScript;
  $cs->defaultScriptFilePosition = CClientScript::POS_HEAD;
  $baseUrl = $this->assetsUrl;

  
  $cs->registerCssFile($baseUrl.'/css/checkboxes.css');
  $cs->registerCssFile($baseUrl.'/css/jqueryui.css');
  $cs->registerCssFile($baseUrl.'/css/tipsy.css');
  $cs->registerCssFile($baseUrl.'/css/chosen.css');
  $cs->registerCssFile($baseUrl.'/css/jquery.timepicker.css');


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
?>

<div class="quick-actions">
  <?php echo CHtml::link('<span class="glyph new"></span> Add New Campaign', array('campaign/create')); ?>
</div>

<div class="box">
  <div class="box-header">
    <span class="glyph global"></span>
    <h1>Campaigns</h1>
  </div>
  <div class="box-content">
    <?php $this->widget('bootstrap.widgets.TbGridView',array(
      'id'=>'campaign-grid',
      'dataProvider'=>$model->search(),
      'filter'=>$model,
      'columns'=>array(
        'id',
        'name',
        'start_time',
        'end_time',
        array(
          'class'=>'bootstrap.widgets.TbButtonColumn',
        ),
      ),
    )); ?>
  </div>
</div>