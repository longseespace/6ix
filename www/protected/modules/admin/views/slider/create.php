<?php $form=$this->beginWidget('CActiveForm', array('enableAjaxValidation'=>false,'htmlOptions' => array('enctype' => 'multipart/form-data'),)); ?>
  <div class="box">
    <div class="box-header">
      <h1>Add New Slider</h1>
    </div>
    <div class="box-content">
      <div class="column-left">      
        <?php echo $form->errorSummary($model); ?>

        <p class="medium">
          <?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>1024,'placeholder'=>'Title and Alt')); ?>
          <?php echo $form->error($model,'title'); ?>
        </p>

        <p class="medium">
          <?php echo $form->textField($model,'url',array('size'=>60,'maxlength'=>1024,'placeholder'=>'Url')); ?>
          <?php echo $form->error($model,'url'); ?>
        </p>

        <p class="small">
          <?php echo $form->dropDownList($model,'active',array('1'=>'Active','0'=>'Deactive'),array('class'=>'chzn-select chzn-done')); ?>
          <?php echo $form->error($model,'active'); ?>
        </p>
      </div>
      <div class="column-right">
        <div class="placeholder">
            <div>P</div><br>
            <p><?php echo CHtml::activeFileField($model, 'image',array('placeholder'=>'Choose file to upload')); ?></p>
        </div>
      </div>
      <div class="clear"></div>
      <div class="action_bar">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
      </div>
    </div>
  </div>
<?php $this->endWidget(); ?>