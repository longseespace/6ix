<?php
$this->breadcrumbs=array(
	'Brands'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Brand','url'=>array('index')),
	array('label'=>'Create Brand','url'=>array('create')),
	array('label'=>'Update Brand','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Brand','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Brand','url'=>array('admin')),
);
?>
<div class="box">
	<div class="box-header">
		<h1>Brand <?php echo $model->name; ?></h1>
	</div>
	<div class="box-content">
		<?php $this->widget('bootstrap.widgets.TbDetailView',array(
			'data'=>$model,
			'attributes'=>array(
				'id',
				'name',
				'description',
				'create_time',
				'update_time',
				'code',
			),
		)); ?>
	</div>
</div>



