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

<div class="quick-actions">
  <a id="addnew-button" href="<?php echo $this->createUrl('element/create') ?>">
    <span class="glyph new"></span>
    Add Element
  </a>
  
</div>

<div id="addnew-popover" class="popover">
  <header>Element Type?</header>
  <section>
    <div class="content">
      <table>
        <tr><td><a href="<?php echo $this->createUrl('element/create', array('type' => 'banner')) ?>">Banner</a></td></tr>
        <tr><td><a href="<?php echo $this->createUrl('element/create', array('type' => 'product')) ?>">Product</a></td></tr>
      </table>
    </div>
  </section>
</div>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'element-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'type',
		'name',
		'template',
		'params',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
