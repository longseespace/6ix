<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'upc-form',
	'enableAjaxValidation'=>false,
)); ?>
<div class="box">
    <div class="box-header">
        <span class="glyph note"></span>
        <h1>Edit UPC</h1>
    </div>
    <div class="box-content">

	<?php echo $form->errorSummary($model); ?>

    <p><b>UPC : </b><?php echo $model[code]; ?></p>

	<p><b>Size : </b><?php echo $form->dropDownList($model,'size_id',CHtml::listData(Size::model()->findAll(), 'id', 'name'),array('class'=>'span5')); ?></p>

	<p><b>Pattern : </b><?php echo $form->dropDownList($model,'pattern_id',CHtml::listData(Pattern::model()->findAll(), 'id', 'id'),array('class'=>'span5')); ?></p>
<!--	<p><b>Pattern : </b>--><?php //echo $form->textFieldRow($model,'pattern_id',array('class'=>'span5','maxlength'=>11)); ?><!--</p>-->
<!--	--><?php //echo $form->textFieldRow($model,'create_time',array('class'=>'span5')); ?>
<!--	--><?php //echo $form->textFieldRow($model,'size_id',array('class'=>'span5','maxlength'=>11)); ?>
<!--	--><?php //echo $form->textFieldRow($model,'update_time',array('class'=>'span5')); ?>
  <div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array(
      'buttonType'=>'submit',
      'type'=>'primary',
      'label'=>$model->isNewRecord ? 'Create' : 'Save',
    )); ?>
  </div>
</div></div>

<?php $this->endWidget(); ?>
