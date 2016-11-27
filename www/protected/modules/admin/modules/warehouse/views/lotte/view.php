<?php
$this->breadcrumbs=array(
	'Lottes'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Lotte','url'=>array('index')),
	array('label'=>'Create Lotte','url'=>array('create')),
	array('label'=>'Update Lotte','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Lotte','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Lotte','url'=>array('admin')),
);
?>

<h1>View Lotte #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'code',
		'lotte_num',
		'update_time',
		'create_time',
	),
)); ?>
