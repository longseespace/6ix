<div class="form">
  <?php $form = $this->beginWidget('CActiveForm', array('id' => 'profile-form', 'enableAjaxValidation' => true,
  'htmlOptions' => array('enctype' => 'multipart/form-data'),)); ?>

    <p class="note"><?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></p>

  <?php echo $form->errorSummary(array($model, $profile)); ?>

    <div class="column-left">

        <p class="field">
          <?php echo $form->labelEx($model, 'email'); ?>
          <?php echo $form->textField($model, 'email', array('size' => 60, 'maxlength' => 128)); ?>
          <?php echo $form->error($model, 'email'); ?>
        </p>

      <?php
      $profileFields = $profile->getFields();
      if ($profileFields) {
        foreach ($profileFields as $field) {
          ?>
            <p class="field">
              <?php echo $form->labelEx($profile, $field->varname);

              if ($widgetEdit = $field->widgetEdit($profile)) {
                echo $widgetEdit;
              } elseif ($field->range) {
                echo $form->dropDownList($profile, $field->varname, Profile::range($field->range));
              } elseif ($field->field_type == "TEXT") {
                echo $form->textArea($profile, $field->varname, array('rows' => 6, 'cols' => 50));
              } else {
                echo $form->textField($profile, $field->varname, array('size' => 60,
                  'maxlength' => (($field->field_size) ? $field->field_size : 255)));
              }
              echo $form->error($profile, $field->varname); ?>
            </p>
          <?php
        }
      }
      ?>

      <p class="field">
        <?php echo $form->labelEx($model, 'status'); ?>
        <?php echo $form->dropDownList($model, 'status', array(User::STATUS_BANNED => 'Banned', User::STATUS_NOACTIVE => 'Inactive', User::STATUS_ACTIVE => 'Active')); ?>
        <?php echo $form->error($model, 'status'); ?>
      </p>

    </div>
    <div class="clear"></div>

    <div class="action_bar">
      <?php echo CHtml::submitButton($model->isNewRecord ? UserModule::t('Create') : UserModule::t('Save')); ?>
        or
        <a href="<?php echo $this->createUrl("user") ?>">Cancel</a>
    </div>

  <?php $this->endWidget(); ?>

</div><!-- form -->