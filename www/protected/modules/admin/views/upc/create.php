<?php
$this->breadcrumbs=array(
	'Upcs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Upc','url'=>array('index')),
	array('label'=>'Manage Upc','url'=>array('admin')),
);
?>

<h1>Create Upc</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>