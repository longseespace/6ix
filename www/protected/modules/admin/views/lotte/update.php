<?php
$this->breadcrumbs=array(
	'Lottes'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Lotte','url'=>array('index')),
	array('label'=>'Create Lotte','url'=>array('create')),
	array('label'=>'View Lotte','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage Lotte','url'=>array('admin')),
);
?>

<h1>Update Lotte <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>