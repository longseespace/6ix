<?php
$this->breadcrumbs=array(
	'Categories'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Category','url'=>array('index')),
	array('label'=>'Manage Category','url'=>array('admin')),
);
?>
<div class="box">
	<div class="box-header">
		<h1>Add A New Category</h1>
	</div>
	<div class="box-content">
		<?php echo $this->renderPartial('_create', array('model'=>$model,'categoryTree'=>$categoryTree)); ?>
	</div>
</div>