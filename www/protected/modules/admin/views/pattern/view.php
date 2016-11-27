<?php
$this->breadcrumbs=array(
	'Patterns'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Pattern','url'=>array('index')),
	array('label'=>'Create Pattern','url'=>array('create')),
	array('label'=>'Update Pattern','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Pattern','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Pattern','url'=>array('admin')),
);
?>

<h1>View Pattern #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'color_id',
		'default',
		'image',
		'create_time',
		'update_time',
	),
)); ?>
