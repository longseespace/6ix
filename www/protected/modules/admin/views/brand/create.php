<?php
$this->breadcrumbs=array(
	'Brands'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Brand','url'=>array('index')),
	array('label'=>'Manage Brand','url'=>array('admin')),
);
?>
<div class="box">
	<div class="box-header">
		<h1>Add A New Brand</h1>
	</div>
	<div class="box-content">
		<?php echo $this->renderPartial('_create', array('model'=>$model)); ?>
	</div>
</div>