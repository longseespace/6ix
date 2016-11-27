<?php
$this->breadcrumbs=array(
	'Stocks'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Stock','url'=>array('index')),
	array('label'=>'Create Stock','url'=>array('create')),
	array('label'=>'Update Stock','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Stock','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Stock','url'=>array('admin')),
);
?>

<h1>View Stock #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'location_id',
		'lotte_id',
		'upc_id',
		'quantity',
		'wh_quantity',
		'create_time',
		'update_time',
		'original_code',
		'code',
	),
)); ?>
