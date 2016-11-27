<?php $form = $this->beginWidget('CActiveForm', array(
  'id' => 'campaign-form',
  'enableAjaxValidation' => true,
  'enableClientValidation' => true,
  'clientOptions' => array(
    'validateOnSubmit' => true
  )
)); ?>

  <div class="box-header">
    <h1>Campaign Info</h1>
    <ul>
      <li class='active'><a href='#info'>Info</a></li>
      <li><a href='#products'>Products</a></li>
    </ul>
  </div>

  <div class="box-content">
    <div id='info' class='tab-content'>
      <div>
  			<?php echo $form->labelEx($model, 'name'); ?>
  			<?php echo $form->textField($model, 'name'); ?>
    		<?php echo $form->error($model, 'name') ?>
      </div>
      <div class='datepair' data-language='javascript'>
        <label for="start-date">Time <span class="required">*</span></label>
        <?php $start = explode(' ', $model->start_time) ?>
        <input type="text" autocomplete='off' value="<?php echo $start[0] ?>" id="start-date" class='date start' data-date-format="yyyy-mm-dd">
        <input type="text" autocomplete='off' value="<?php echo $start[1] ?>" id="start-time" class='time start'> to
        <?php $end = explode(' ', $model->end_time) ?>
        <input type="text" autocomplete='off' value="<?php echo $end[0] ?>" id="end-date" class='date end' data-date-format="yyyy-mm-dd">
        <input type="text" autocomplete='off' value="<?php echo $end[1] ?>" id="end-time" class='time end'>
        <?php echo $form->hiddenField($model, 'start_time'); ?>
        <?php echo $form->hiddenField($model, 'end_time'); ?>

        <?php echo $form->error($model, 'start_time') ?>
        <?php echo $form->error($model, 'end_time') ?>
      </div>
    </div>
    <div id='products' class='tab-content' style='display: none;'>
      <?php foreach ($model->products as $product): ?>
        <div class='product' data-id='<?php echo $product->id ?>'>
          <a target='_blank' href='' title='<?php echo $product->name ?>'>
            <img width='100' src='' alt='<?php echo $product->name ?>' />
          </a>
          <input type="hidden" name="sale[product_ids][]" value="<?php echo $product->id ?>">
          <a href='#' class='remove'><span class='glyph minus'></span></a>
        </div>
      <?php endforeach ?>
    </div>
    <div class='clear'></div>
  </div>
  
  <div class="action_bar">
    <input type="submit" class="button blue" value="Save" />
  </div>

<?php $this->endWidget(); ?>