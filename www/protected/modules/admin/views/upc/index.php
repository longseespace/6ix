<?php
$this->breadcrumbs=array(
	'Upcs',
);

$this->menu=array(
	array('label'=>'Create Upc','url'=>array('create')),
	array('label'=>'Manage Upc','url'=>array('admin')),
);
?>

<h1>Upcs</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
