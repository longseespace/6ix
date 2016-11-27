<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'category-form',
	'enableAjaxValidation'=>false,
)); ?>
	<?php echo $form->errorSummary($model); ?>
	<div class="one-third float-left separator">
		<div id="category-tree">
			<ul>
			<?php
				//var_dump($categoryTree);

				foreach ($categoryTree as $key => $value) {
					echo "<li><a href='".Yii::app()->createUrl('admin/category/update/', array('id' => $key))."'>".$value."</a></li>";
				}
			?>
			</ul>
		</div>

	</div>
	<div class="one-third float-right">
		<div id="dropbox">
			<span class="message">Drop images here to upload.</span>
		</div>
	</div>
	<div class="one-third float-right">
		<?php echo $form->textField($model,'name',array('placeholder'=>'Category Name','class'=>'span5','maxlength'=>255)); ?>
		<?php //echo $form->dropDownList($model,'root',$categoryList,array('data-placeholder'=>'Parent Category', 'class'=>'chzn-select')); ?>
		<?php //echo $form->textField($model,'root',array('placeholder'=>'Parent Category','class'=>'span5','maxlength'=>255)); ?>
		<?php echo $form->dropDownList($model,'root', $categoryTree); ?>
	</div>
	
	<div class="clear"></div>
	<div class="action_bar">
		<input type="submit" value="Save" class="button blue" /> or <?php echo CHtml::link('Cancel',array('/admin/category/admin'))?>
	</div>

<?php $this->endWidget(); ?>

<div id="browse-category">
  
</div>