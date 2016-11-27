<?php
$this->breadcrumbs=array(
	'Upcs'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Upc','url'=>array('index')),
	array('label'=>'Create Upc','url'=>array('create')),
	array('label'=>'View Upc','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage Upc','url'=>array('admin')),
);
?>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>