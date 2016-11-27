<?php
$this->breadcrumbs=array(
	'Brands'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Brand','url'=>array('index')),
	array('label'=>'Create Brand','url'=>array('create')),
	array('label'=>'View Brand','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage Brand','url'=>array('admin')),
);
?>
<div class="box">
	<div class="box-header">
		<h1>Update Brand <?php echo $model->name; ?></h1>
	</div>
	<div class="box-content">
		<?php echo $this->renderPartial('_edit',array('model'=>$model)); ?>
	</div>
</div>

