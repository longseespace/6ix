<?php
// $this->breadcrumbs=array(
// 	'Upcs'=>array('index'),
// 	'Manage',
// );

// $this->menu=array(
// 	array('label'=>'List Upc','url'=>array('index')),
// 	array('label'=>'Create Upc','url'=>array('create')),
// );

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('upc-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
<div class="quick-actions">
    <?php echo CHtml::link('<span class="glyph export"></span>'.'Export CSV', '#'); ?>
</div>
<div class="box">
    <div class="box-header">
        <span class="glyph note"></span><h1><a href="/admin/product/">Product</a></h1>
        <span class="glyph global"></span><h1>UPC</h1>
    </div>
    <div class="box-content">
        <?php 
            $this->renderPartial('_UPC',array('model'=>$model));
        ?>
    </div>
</div>
