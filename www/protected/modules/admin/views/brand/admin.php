<?php
$this->breadcrumbs=array(
	'Brands'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Brand','url'=>array('index')),
	array('label'=>'Create Brand','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('brand-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<div class="quick-actions">
	<?php echo CHtml::link('<span class="glyph new"></span>'.'Add Brand', array('/admin/brand/create')); ?>
	<?php echo CHtml::link('<span class="glyph export"></span>'.'Export', '#'); ?>
</div>
<div class="box">
	<div class="box-header">
		<span class="glyph global"></span>
		<h1>Brands</h1>
		
	</div>
	<div class="box-content">
		<?php $this->widget('bootstrap.widgets.TbGridView',array(
			'id'=>'brand-grid',
			'dataProvider'=>$model->search(),
			'filter'=>$model,
			'columns'=>array(
				/*'id',
				*/
				'name',
				'code',
				/*'description',
				'create_time',*/
				'update_time',
				
				array(
					'class'=>'bootstrap.widgets.TbButtonColumn',
					'template'=>'{update}{view}',
					'buttons'=>array(
						'update'=>array(
							'label'=>'Edit',
							'options'=> array(
								'title'=>'Edit',
							),
						),
					),
				),
			),
		)); ?>
	</div>
</div>


