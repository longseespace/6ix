<?php $form = $this->beginWidget('CActiveForm', array(
  'id' => 'search-form',
  'action' => array('product/search'),
  'enableAjaxValidation' => false,
  'enableClientValidation' => false,
  'clientOptions' => array(
    'validateOnSubmit' => false
  )
)); ?>
  <div class="box-content">
    <h5>Search For Products</h5>
    <p>
      <input type="search" results=5 name="product" id="search">
    </p>
    <p id='uhoh' style='display: none;'>
      <label for="campaign-name">Category</label>
      <?php echo CHtml::dropDownList('category_id', '', CHtml::listData(Category::model()->findAll(), 'id', 'name'), array('id' => 'category', 'class' => 'chzn-select')); ?>
    </p>
    <div id="results"></div>      
    <div class='clear'></div>
    <div id='more'>
      <a href='#' class='button small'>I want more!</a>
    </div>
  </div>
<?php $this->endWidget(); ?>