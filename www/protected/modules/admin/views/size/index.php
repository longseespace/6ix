<?php
$this->breadcrumbs=array(
	'Sizes',
);

$this->menu=array(
	array('label'=>'Create Size','url'=>array('create')),
	array('label'=>'Manage Size','url'=>array('admin')),
);
?>

<h1>Sizes</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
