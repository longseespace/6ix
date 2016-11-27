<?php
// $this->breadcrumbs=array(
// 	'Sizes'=>array('index'),
// 	'Manage',
// );

// $this->menu=array(
// 	array('label'=>'List Size','url'=>array('index')),
// 	array('label'=>'Create Size','url'=>array('create')),
// );
$cs = Yii::app()->clientScript;
$cs->registerCssFile($this->assetsUrl . '/css/modules/size.css');
?>
<div class="box">
	<div class="box-header">
		<h1>Sizes</h1>
	</div>

	<div class="box-content">
		<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
			'id'=>'size-form',
			'action'=>'',
			'enableAjaxValidation'=>false,
		)); ?>
			<div class="column-left">
				<?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>255)); ?>
				<?php echo $form->textFieldRow($model,'code',array('class'=>'span5','maxlength'=>15)); ?>
				<?php echo $form->textAreaRow($model,'description',array('rows'=>6, 'cols'=>50)); ?>
			</div>
			<div class="column-right">
				<ul id="sizes">
				<?php foreach ($models->data as $value) { ?>
					<li id="<?php echo $value->id; ?>" style="-webkit-transform: rotate(0deg);">
						<span class="glyph delete" style="display: none;"></span>
            <a href="<?php echo $this->createUrl('size/update/id/' . $value->id); ?>" title="<?php echo $value->name; ?>"><?php echo $value->name; ?></a>
					</li>
				<?php }; ?>
				</ul>
			</div>
			<div class="clear"></div>
			<div class="action_bar">
				<?php $this->widget('bootstrap.widgets.TbButton', array(
					'buttonType'=>'submit',
					'type'=>'primary',
					'label'=>$model->isNewRecord ? 'Create' : 'Save',
				)); ?>
			</div>
		<?php $this->endWidget(); ?>

	</div>
</div>