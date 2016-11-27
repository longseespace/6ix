<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'id',array('class'=>'span5','maxlength'=>11)); ?>

	<?php echo $form->textFieldRow($model,'user_id',array('class'=>'span5','maxlength'=>11)); ?>

	<?php echo $form->textFieldRow($model,'session_id',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'order_code',array('class'=>'span5','maxlength'=>31)); ?>

	<?php echo $form->textFieldRow($model,'price',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'real_price',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'cod_fee',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'discount',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'expire',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'ship_fullname',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'ship_email',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'ship_gender',array('class'=>'span5')); ?>

	<?php echo $form->textAreaRow($model,'ship_address',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textFieldRow($model,'ship_mobile',array('class'=>'span5','maxlength'=>31)); ?>

	<?php echo $form->textFieldRow($model,'ship_city',array('class'=>'span5','maxlength'=>31)); ?>

	<?php echo $form->textFieldRow($model,'bill_fullname',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'bill_email',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'bill_gender',array('class'=>'span5')); ?>

	<?php echo $form->textAreaRow($model,'bill_address',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textFieldRow($model,'bill_mobile',array('class'=>'span5','maxlength'=>31)); ?>

	<?php echo $form->textFieldRow($model,'bill_city',array('class'=>'span5','maxlength'=>31)); ?>

	<?php echo $form->textFieldRow($model,'bank_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'payment_method',array('class'=>'span5','maxlength'=>31)); ?>

	<?php echo $form->textFieldRow($model,'payment_id',array('class'=>'span5','maxlength'=>63)); ?>

	<?php echo $form->textAreaRow($model,'note',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textFieldRow($model,'status',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'create_time',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'modifie_time',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
		  'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
