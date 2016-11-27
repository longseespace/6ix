<?php
$this->breadcrumbs=array(
	'Lottes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Lotte','url'=>array('index')),
	array('label'=>'Manage Lotte','url'=>array('admin')),
);
?>

<h1>Create Lotte</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>