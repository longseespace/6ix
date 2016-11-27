<div class="box" id="element-banner">
  <div class="box-header">
    <h1>Update Banner Element</h1>
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
      <input type="hidden" name="Element[type]" value="banner">
      <div class="column-left">
        <p>
          <label for="name">Element Name</label>
          <input type="text" name="Element[name]" value="<?php echo $model->name ?>" id="name">
        </p>
        <p>
          <label for="url">Banner URL</label>
          <input type="text" name="Element[params][url]" value="<?php echo $model->params->url ?>" id="url">
        </p>
        <p>
          <label for="title">Banner Title</label>
          <input type="text" name="Element[params][title]" value="<?php echo $model->params->title ?>" id="title">
        </p>
        <p>
          <label for="title">Banner Image (E.g. banner_xmas.png) </label>
          <input type="text" name="Element[params][filename]" value="<?php echo $model->params->filename ?>" id="filename">
        </p>
      </div>
      <div class="column-right placeholder">
        <div>P</div>
        <p class='description'>
          No image, yet :P
        </p>
      </div>
      
      <div class="clear"></div>
      <div class="action_bar">
        <input type="submit" class="button blue" id="submit" value="Save" />
      </div>
    
    <?php $this->endWidget(); ?>
  </div>
</div>