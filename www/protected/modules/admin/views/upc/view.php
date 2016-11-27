<?php
$this->breadcrumbs=array(
	'Upcs'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Upc','url'=>array('index')),
	array('label'=>'Create Upc','url'=>array('create')),
	array('label'=>'Update Upc','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Upc','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Upc','url'=>array('admin')),
);
?>

<h1>View Upc #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'product_id',
		'size_id',
		'pattern_id',
		'create_time',
		'update_time',
		'code',
	),
)); ?>
