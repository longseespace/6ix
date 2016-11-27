<?php
$this->breadcrumbs=array(
	'Carts',
);

$this->menu=array(
	array('label'=>'Create Cart','url'=>array('create')),
	array('label'=>'Manage Cart','url'=>array('admin')),
);
?>

<h1>Carts</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
