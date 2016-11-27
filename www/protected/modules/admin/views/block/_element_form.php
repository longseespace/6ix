<?php 

$options['width'] = array(
  'auto' => 'auto',
  'w160' => '160px',
  'w240' => '240px',
  'w320' => '320px',
  'w360' => '360px',
  'w400' => '400px',
  'w460' => '460px',
  'w600' => '600px',
  'w640' => '640px',
  'w960' => '960px'
);

$options['height'] = array(
  'auto' => 'auto',
  'h100' => '100px',
  'h130' => '130px',
  'h150' => '150px',
  'h230' => '230px',
  'h250' => '250px',
  'h300' => '300px',
  'h460' => '460px'
);

?>

<form>
  <div class="box-content">
    <p>
      <?php echo CHtml::dropDownList('element_id', '', array_merge(array('0' => ''), CHtml::listData(Element::model()->findAll(), 'id', 'name')), array('blank' => '', 'id' => 'element-id', 'class' => 'chzn-select half', 'data-placeholder' => 'Choose an Element')); ?>
      <a href="#" type="button" class="button small right" id="add-element"/><span class="glyph plus2"></span>Add To Block</a>
    </p>
    <h5>Size</h5>
    <p class="size combined">  
      <?php echo CHtml::dropDownList('element_width', '', $options['width'], array('blank' => '', 'id' => 'element-width', 'class' => 'chzn-select half element-option', 'data-placeholder' => 'Width')) ?>
      <?php echo CHtml::dropDownList('element_height', '', $options['height'], array('blank' => '', 'id' => 'element-height', 'class' => 'chzn-select half element-option', 'data-placeholder' => 'Height')) ?>
    </p>

    <p>
      <a href="#" id='show-advance'>[+] Show Advanced Options</a>
    </p>
    <div id='advance-options' style='display:none;'>
      <h5>CSS Class</h5>
      <p>
        <input type="text" name="element_class" id="class">
      </p>
      <h5>Float</h5>
      <p class="float">
        <label for="float-left">Left</label>
        <input type="radio" name="element_float" value="left" checked id="float-left">
        <label for="float-right">Right</label>
        <input type="radio" name="element_float" value="right" id="float-right">
        <br class="clear"/>
      </p>
      
      <h5>Border</h5>
      <p class="border">
        <label for="border-top">Top</label>
        <input type="checkbox" name="element_border_top" value="border-top" id="border-top">
        <label for="border-right">Right</label>
        <input type="checkbox" name="element_border_right" value="border-right" id="border-right">
        <label for="border-bottom">Bottom</label>
        <input type="checkbox" name="element_border_bottom" value="border-bottom" id="border-bottom">
        <label for="border-left">Left</label>
        <input type="checkbox" name="element_border_left" value="border-left" id="border-left">
        <br class="clear"/>
      </p>
      
      <h5>Style</h5>
      <p>
        <textarea name="element_style" id="style"></textarea>
      </p>
      <p>
        <a href="#" type="button" class="button small" id="add-element-alt"/><span class="glyph plus2"></span>Add To Block</a>
      <p>
    </div>

    <div class="update-actions" style="display:none" >
      <a href="#" type="button" class="button small" id="update-element"/><span class="glyph tick"></span>Update</a>
      <a href="#" type="button" class="button small" id="delete-element"/><span class="glyph delete"></span>Delete</a>
      or <a href="#" class="cancel" id="cancel"/>Cancel</a>
    </div>
  </div>
</form>