<?php
$this->breadcrumbs=array(
	'Patterns'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Pattern','url'=>array('index')),
	array('label'=>'Manage Pattern','url'=>array('admin')),
);
?>

<h1>Create Pattern</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>