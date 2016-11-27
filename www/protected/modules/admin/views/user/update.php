<?php
$this->breadcrumbs=array(
	'Pages'=>array('adminindex'),
	$model->email
);
?>
<div class="box">
    <div class="box-header">
        <h1>Update Page <?php echo $model->id; ?></h1>
    </div>

    <div class="box-content">
        <?php echo $this->renderPartial('_form',array('model'=>$model, 'profile'=>$profile)); ?>
    </div>
</div>