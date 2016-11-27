<?php
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('product-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="quick-actions">
    <?php echo CHtml::link('<span class="glyph new"></span>'.'Add Product', array('/admin/product/create')); ?>
    <?php echo CHtml::link('<span class="glyph export"></span>'.'Export CSV', '#'); ?>
</div>
<div class="box">
    <div class="box-header">
        <span class="glyph note"></span>
        <h1>Products</h1>
        <span class="glyph global"></span>
        <h1><a href="/admin/upc/">UPC</a></h1>
    </div>
    <div class="box-content">
        <?php 
            $this->renderPartial('_products',array('model'=>$model));
        ?>
    </div>
</div>