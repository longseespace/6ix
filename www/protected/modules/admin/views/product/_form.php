<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array('id' => 'product-form',
  'enableAjaxValidation' => false,)); ?>

<div class="box">
  <div class="box-header">
    <span class="glyph note"></span>
    <h1>Update Product</h1>
  </div>
  <div class="box-content">
    <form>
    <div class="column-left">

      <?php echo $form->errorSummary($model); ?>

      <p><?php echo $form->textField($model, 'name', array('class' => 'span5', 'maxlength' => 255)); ?></p>

      <p class="combined"><?php echo $form->textField($model, 'price_retail', array('class' => 'medium')); ?><?php echo $form->textField($model, 'price_sell', array('class' => 'medium last-child')); ?></p>
      
      <p class="combined"><?php echo $form->dropDownList($model, 'brand_id', CHtml::listData(Brand::model()->findAll(), 'id', 'name'), array('class' => '')); ?></p>
      
      <p class="combined"><?php echo $form->dropDownList($model, 'category_id', CHtml::listData(Category::model()->findAll(), 'id', 'name'), array('class' => 'medium last-child')); ?></p>

      <p class="combined two-selects"><?php echo $form->dropDownList($model, 'status', array('deactive', 'active')); ?><?php echo $form->textField($model, 'pcode', array('class' => 'medium last-child', 'maxlength' => 63)); ?></p>

      <!-- <?php echo $form->textFieldRow($model, 'original_style', array('class' => 'span5', 'maxlength' => 63)); ?> -->

      <p class="combined"><?php echo $form->dateField($model, 'create_time', array('class' => 'medium')); ?><?php echo $form->dateField($model, 'update_time', array('class' => 'medium last-child')); ?></p>

      <p><?php echo $form->checkbox($model, 'featured', array('class' => '')); ?><b> Feature?</b></p>
    </div>
    <div class="column-right">
      <div id="dropbox">
        <?php if (empty($model->productImages)): ?>
        <span class="message">Drop images here to upload.</span>
        <?php else: ?>
        <?php foreach ($model->productImages as $image): $i++; ?>
          <div class="preview done">
            <span class="glyph delete" style="display: none;"></span>
            <input type="hidden" class='id-input' name="upload[id][]" value="<?php echo $image->id ?>">
            <input type="hidden" class='filename-input' name="upload[file][]" value="<?php echo $image->file ?>">
            <input type="hidden" class='color-input' name="upload[pattern_id][]" value="<?php echo $image->pattern_id ?>">
            <span class="imageHolder">
              <a href="<?php echo $image->getImageURL() ?>" target="_blank" class='open-image'></a>
              <img src="<?php echo $image->getImageURL('thumbnail') ?>" />
            </span>
            <?php if (!empty($image->pattern_id)): ?>
            <span class='color-preview' style="background: <?php echo $image->pattern->color->hex ?>"></span>
            <?php endif ?>
          </div>
          <?php endforeach ?>
        <?php endif ?>
      </div>
    </div>
    <div class="clear"></div>
    <div class="box">
      <div class="box-header">
        <span class="glyph note"></span>
        <h1>Description</h1>
      </div>
      <div class="box-content">
        <?php
        $this->widget('widgets.redactorjs.Redactor', array(
          'model' => $model,
          'attribute' => 'description',
          'editorOptions' => array(
            'imageUpload' => Yii::app()->createAbsoluteUrl('/admin/file/uploads'),
            'imageGetJson' => Yii::app()->createAbsoluteUrl('/admin/file/images'),
            'minHeight' => 300,
          ),
        )); ?>
      </div>
    </div>
    <div class="action_bar">
        <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'type' => 'primary','label' => $model->isNewRecord ? 'Create' : 'Save',)); ?>
    </div>
    </form>
  </div>
</div>
<?php $this->endWidget(); ?>

<ul id="contextmenu" class='contextmenu'>
  <li><a href="#" data-action='open' title='Open image in new tab'>Open</a></li>
  <li><a href="#" data-action='delete' title='Delete this image'>Delete</a></li>
  <li class="divider"></li>
  <li class='header'>Colors:</li>
  <?php foreach ($pattern as $item): ?>
  <li class='color'><a href='#' data-action='label' data-color='<?php echo $item->id ?>' data-hex='<?php echo $item->color->hex ?>'><span class='hex' style="background: <?php echo $item->color->hex ?>;"></span> <?php echo $item->color->name ?></a></li>
  <?php endforeach ?>
</ul>
