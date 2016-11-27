<?php
/* @var $this PageController */
/* @var $model Page */

// $this->breadcrumbs=array(
// 	'Pages'=>array('index'),
// 	'Create',
// );

$this->menu=array(
	array('label'=>'List Page', 'url'=>array('index')),
	array('label'=>'Manage Page', 'url'=>array('admin')),
);
?>


<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>