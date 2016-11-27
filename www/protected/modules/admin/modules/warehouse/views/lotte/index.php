<?php
$this->breadcrumbs=array(
	'Lottes',
);

$this->menu=array(
	array('label'=>'Create Lotte','url'=>array('create')),
	array('label'=>'Manage Lotte','url'=>array('admin')),
);
?>

<h1>Lottes</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
