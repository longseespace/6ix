<?php
/* @var $this PageController */
/* @var $model Page */

// $this->breadcrumbs=array(
// 	'Pages'=>array('index'),
// 	'Manage',
// );

// $this->menu=array(
// 	array('label'=>'List Page', 'url'=>array('index')),
// 	array('label'=>'Create Page', 'url'=>array('create')),
// );

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('page-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
<div class="quick-actions">
  <a href="/admin/page/create">
    <span class="glyph new"></span>
    Add Page
  </a>

  <a href="#">
    <span class="glyph export"></span>
    Export to CSV
  </a>
</div>
<div class="box">
	<div class="box-header">
    <span class="glyph note"></span>
    <h1>Page</h1>
  </div>
    <div class="box-content">
        <?php 
            $this->renderPartial('_page',array('model'=>$model));
        ?>
    </div>
  </div>