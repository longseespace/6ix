<?php
/* @var $this FaqController */
/* @var $model Faq */

$this->breadcrumbs = array(
  'Faqs' => array('index'),
  'Manage',
);

$this->menu = array(
  array('label' => 'List Faq', 'url' => array('index')),
  array('label' => 'Create Faq', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('faq-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<!-- <div class="search-form" style="display:none">
<?php //$this->renderPartial('_search', array(
//  'model' => $model,
//)); ?>
</div><!-- search-form -->
<div class="quick-actions">
  <a href="/admin/faq/create">
    <span class="glyph new"></span>
    Add QA
  </a>

  <a href="#">
    <span class="glyph export"></span>
    Export to CSV
  </a>
</div>
<div class="box">
  <div class="box-header">
    <span class="glyph note"></span>

    <h1>FAQ</h1>
  </div>
  <div class="box-content">
    <?php $this->renderPartial('_faq', array('model' => $model)); ?>
  </div>
</div>