<?php 
$index = 0;
$products = $element->campaign->products;

?>


<?php if (!empty($products)): ?>

<!-- Prd List -->
<div class="p_title_bar">
  <?php
    $url = '#';
  ?>
  <span class="title"><a href="<?php echo $url; ?>"><?php echo $element->name ?></a></span>
  <span class="links"><a href="<?php echo $url; ?>">Xem thêm >></a> </span>
</div>
<div class="block">
  <?php if ($element->params->banner_pos == 'left'): ?>
  <div class="left w320 h460 border-right">
  <?php else: ?>
  <div class="right w320 h460 border-left">
  <?php endif ?>
    <?php 
      $this->widget('application.widgets.Element.ElementWidget', array(
        'element_id' => $element->params->banner_id
      ));
    ?>
  </div>

  <?php foreach ($products as $product): 
    $index++;
    if ($element->params->banner_pos == 'left') {
      if ($index % 4 == 0) {
        $class = 'left w160 h230 border-left';
      } else {
        $class = 'left w160 h230 border-left border-right';
      }
    } else {
      if ($index % 4 == 1) {
        $class = 'left w160 h230 border-right';
      } else {
        $class = 'left w160 h230 border-left border-right';
      }
    }
    
    if ($index <= 4) {
      $class .= ' border-bottom';
    } else {
      $class .= ' border-top';
    }
  ?>
  
  <div class="<?php echo $class ?>">
    <div class="item-m">
      <?php if (empty($product->images)): ?>
        <div class="prd_img">
          <a href="">
            <?php ?>
          </a>
        </div>
      <?php else: ?>
        <div class="prd_img">
          <a href="">
            <?php ?>
          </a>
        </div>
      <?php endif ?>
      <div class="info">
        <div class="prd_name"><a href=""><?php echo $product->name ?> </a></div>
        <div class="price"><?php echo $product->price_sell ?></div>
        <?php if ($product->price_retail > 0): ?>
          <div class="org-price"><?php echo $product->price_retail ?></div>
        <?php endif ?>
      </div>
    </div>
  </div>
  <?php endforeach ?>
  <div class="cB"></div>
</div>

<!-- End Prd List -->

<?php endif ?>