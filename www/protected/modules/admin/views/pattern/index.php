<?php
$this->breadcrumbs=array(
	'Patterns',
);

$this->menu=array(
	array('label'=>'Create Pattern','url'=>array('create')),
	array('label'=>'Manage Pattern','url'=>array('admin')),
);
?>

<h1>Patterns</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
