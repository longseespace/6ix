<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'brand-form',
	'enableAjaxValidation'=>false,
)); ?>

	

	<?php echo $form->errorSummary($model); ?>
	<div class="column-left">
		<p><?php echo $form->textField($model,'name',array('placeholder'=>'Brand Name','class'=>'span5','maxlength'=>255)); ?></p>
		<p><?php echo $form->textField($model,'code',array('placeholder'=>'Brand Code','class'=>'span5','maxlength'=>45)); ?></p>
		<p><?php echo $form->textArea($model,'description',array('placeholder'=>'Description','maxlength'=>255)); ?></p>
		<p><?php echo $form->hiddenField($model,'update_time',array('type'=>'hidden','value'=>date("Y-m-d h:m:s"),'class'=>'span5')); ?></p>
	</div>
	<div class="column-right">

	</div>
	<div class="clear">
	</div>
	<div class="action-bar">
		<input type="submit" class="button blue" name="Save" /> or <?php echo CHtml::link('Cancel',array('/admin/brand/admin'), array('title'=>'Discard all changes'))?>
	</div>

<?php $this->endWidget(); ?>
