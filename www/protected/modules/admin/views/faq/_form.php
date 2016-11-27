<?php
/* @var $this FaqController */
/* @var $model Faq */
/* @var $form CActiveForm */
?>

<div class="box">
<div class="box-header">
	<h1>Add New Page</h1>
</div>
<div class="box-content">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'faq-form',
	'enableAjaxValidation'=>false,
)); ?>
	<?php echo $form->errorSummary($model); ?>

	<div class="column-left">
		<p><?php echo $form->dropDownList($model, 'category', array('Cau hoi chung', 'Chinh sach mua hang','Thong tin khuyen mai','Thac mac giao dich'), array('empty'=>'Select Category')); ?><?php echo $form->error($model,'category'); ?></p>
		<p><?php echo $form->textArea($model,'question',array('rows'=>6, 'cols'=>50,'placeholder'=>'Question')); ?><?php echo $form->error($model,'question'); ?><p>		
	</div>
	<div class="clear"></div>
	<div class="description">
		<div class="box-content">
      <?php $this->widget('ext.tinymce.ETinyMce', array('model' => $model, 'attribute' => 'answer','useSwitch' => false, 'editorTemplate' => 'full')); ?>
			<?php echo $form->error($model,'answer'); ?>
	</div>
	</div>
	<div class="action_bar">
    <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array("class"=>"button blue")); ?>
    or <a href="http://www.6ix.tk/admin/faq" title="Discard current changes">Cancel</a>
  </div>
<?php $this->endWidget(); ?>
</div>
</div><!-- form -->