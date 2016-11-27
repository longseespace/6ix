<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php //echo $form->textFieldRow($model,'id',array('class'=>'span5','maxlength'=>11)); ?>

	<?php echo $form->textField($model,'name',array('placeholder'=>'Search brand name','class'=>'span2','maxlength'=>255)); ?>

	<?php //echo $form->textFieldRow($model,'description',array('class'=>'span5','maxlength'=>255)); ?>

	<?php //echo $form->textFieldRow($model,'create_time',array('class'=>'span5')); ?>

	<?php //echo $form->textFieldRow($model,'update_time',array('class'=>'span5')); ?>

	<?php //echo $form->textFieldRow($model,'code',array('class'=>'span5','maxlength'=>45)); ?>
		<?php $this->widget('bootstrap.widgets.TbButton', array(
		  'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>

<?php $this->endWidget(); ?>
