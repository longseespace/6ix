<?php
$this->breadcrumbs=array(
	'Products'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Product','url'=>array('index')),
	array('label'=>'Create Product','url'=>array('create')),
	array('label'=>'Update Product','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Product','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Product','url'=>array('admin')),
);
?>

<h1>View Product #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'brand_id',
		'category_id',
		'name',
		'slug',
		'description',
		'about',
		'size_guide',
		'pcode',
		'original_style',
		'price_retail',
		'price_sell',
		'featured',
		'status',
		'create_time',
		'update_time',
		'cost',
	),
)); ?>
