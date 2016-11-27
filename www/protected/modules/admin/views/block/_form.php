<?php $form = $this->beginWidget('CActiveForm', array(
  'id' => 'block-form',
  'enableAjaxValidation' => true,
  'enableClientValidation' => true,
  'clientOptions' => array(
    'validateOnSubmit' => true
  )
)); ?>

  <?php foreach ($block['elements'] as $element_id => $e): ?>
  <input data-id="<?php echo $element_id ?>" type="hidden" name="block[elements][<?php echo $element_id ?>]" value='<?php echo json_encode($e) ?>'>
  <?php endforeach ?>
  <div class="box-header">
    <h1>Block Info</h1>
  </div>

  <div class="box-content">
    <p>
      <label for="block-name">Block Name</label>
      <input type="text" name="Block[name]" value="<?php echo $block['name'] ?>" id="block-name">
    </p>
    <p>
      <label for="block-location">Block Location</label>
      <input type="text" name="Block[location]" value="<?php echo $block['location'] ?>" id="block-location">
    </p>
  </div>
  
  <div class="action_bar">
    <input type="submit" class="button blue" value="Save" />
  </div>

<?php $this->endWidget(); ?>
