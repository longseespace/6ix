<?php
$this->breadcrumbs=array(
	'Brands',
);

$this->menu=array(
	array('label'=>'Create Brand','url'=>array('create')),
	array('label'=>'Manage Brand','url'=>array('admin')),
);
?>

<h1>Brands</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
