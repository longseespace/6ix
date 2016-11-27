<?php
/* @var $this PageController */
/* @var $model Page */
/* @var $form CActiveForm */
?>
<div class="quick-actions">
  <a href="/admin/page/create">
    <span class="glyph new"></span>
    Add Page
  </a>

  <a href="#">
    <span class="glyph export"></span>
    Export to CSV
  </a>
</div>
<div class="box">
  <div class="box-header">
    <h1>Add New Page</h1>
  </div>
  <div class="box-content">
    <?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'page-form',
    'enableAjaxValidation' => false,
  )); ?>
    <?php echo $form->errorSummary($model); ?>
    <?php echo $form->labelEx($model, 'title'); ?>
    <p><?php echo $form->textField($model, 'title', array(
      'size' => 60, 'maxlength' => 255, 'placeholder' => 'Page title'
    )); ?>
      <?php echo $form->error($model, 'title'); ?></p>

    <div class="clear"></div>
    <div class="description">
      <?php
    $this->widget('widgets.redactorjs.Redactor', array(
      'model' => $model,
      'attribute' => 'content',
      'editorOptions' => array(
        'imageUpload' => Yii::app()->createAbsoluteUrl('/admin/file/uploads'),
        'imageGetJson' => Yii::app()->createAbsoluteUrl('/admin/file/images'),
        'minHeight' => 300
      ),
    )); ?>
    </div>

    <div class="action_bar">
      <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array("class" => "button blue")); ?>
      or <a href="/admin/page" title="Discard current changes">Cancel</a>
    </div>
  </div>
</div>
<?php $this->endWidget(); ?>

</div><!-- form -->