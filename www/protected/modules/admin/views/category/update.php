<?php
$this->breadcrumbs=array(
	'Categories'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Category','url'=>array('index')),
	array('label'=>'Create Category','url'=>array('create')),
	array('label'=>'View Category','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage Category','url'=>array('admin')),
);
?>

<div class="box">
	<div class="box-header">
		<h1>Update Category <?php echo $model->name; ?></h1>		
	</div>
	<div class="box-content">
		<?php echo $this->renderPartial('_create',array('model'=>$model,'categoryTree'=>$categoryTree)); ?>		
	</div>
</div>


