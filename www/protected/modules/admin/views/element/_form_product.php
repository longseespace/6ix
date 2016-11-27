<div class="box" id="element-banner">
  <div class="box-header">
    <h1>Product Element</h1>
  </div>

  <div class="box-content">
    <?php $form = $this->beginWidget('CActiveForm', array(
      'id' => 'element-form',
      'enableAjaxValidation' => true,
      'enableClientValidation' => true,
      'clientOptions' => array(
        'validateOnSubmit' => true
      )
    )); ?>
      <div class="column-left">
        <p>
          <label for="name">Element Name</label>
          <input type="text" name="Element[name]" value="<?php echo $model->name ?>" id="name">
        </p>
        <p>
          <label for="url">Campaign</label>
          <?php echo CHtml::dropDownList('Element[params][campaign_id]', $model->params->campaign_id, CHtml::listData(Campaign::model()->findAll(), 'id', 'name'), array('blank' => '', 'id' => 'flashsale', 'class' => 'chzn-select', 'data-placeholder' => 'Choose a Campaign')); ?>
        </p>
        <p>
          <label for="url">Banner</label>
          <?php echo CHtml::dropDownList('Element[params][banner_id]', $model->params->banner_id, CHtml::listData(Element::model()->findAll('`type` = :type', array(':type' => 'banner')), 'id', 'name'), array('blank' => '', 'id' => 'banner', 'class' => 'chzn-select', 'data-placeholder' => 'Choose a Banner')); ?>
        </p>

        <?php $checked['left'] = ''; $checked['right'] = ''; $checked[$model->params->banner_pos] = 'checked'; ?>
        <p>
          <label>Banner Position</label>
          <label for="banner-left">Left</label>
          <input type="radio" name="Element[params][banner_pos]" <?php echo $checked['left'] ?> value="left" id="banner-left"> 
          <label for="banner-right">Right</label>
          <input type="radio" name="Element[params][banner_pos]" <?php echo $checked['right'] ?> value="right" id="banner-right"> 
        </p>

      </div>
      <div class="column-right placeholder">
        <div>P</div>
        <p class='description'>
          No preview, yet :P
        </p>
      </div>
      
      <div class="clear"></div>
      <div class="action_bar">
        <input type="submit" class="button blue" id="submit" value="Save" />
      </div>
    
    <?php $this->endWidget(); ?>
  </div>
</div>