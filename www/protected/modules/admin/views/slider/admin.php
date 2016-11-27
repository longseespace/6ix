<?php
/* @var $this SliderController */
/* @var $model Slider */

$this->breadcrumbs=array(
	'Sliders'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Slider', 'url'=>array('index')),
	array('label'=>'Create Slider', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('slider-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
$assetsDir = "/uploads/sliders";
?>

<div class="quick-actions">
    <?php echo CHtml::link('<span class="glyph new"></span>'.'Add Slider', array('/admin/slider/create')); ?>
    <?php echo CHtml::link('<span class="glyph export"></span>'.'Sort Slider', array('/admin/slider/sort')); ?>
</div>
<div class="box">
    <div class="box-header">
        <span class="glyph note"></span>
        <h1>Silde</h1>
    </div>
    <div class="box-content">
        <?php $this->widget('bootstrap.widgets.TbGridView',array(
					'id'=>'product-grid',
				  'template' => '{summary} {items} {pager}',
				  'type'=>'striped',
				  'itemsCssClass'=>'item table-hover' ,
					'dataProvider'=>$model->search(),
					'columns'=>array(
				    array(
				      'name' => 'title',
				      'sortable'=>false,
				      'value' => '$data->title',
				    ) ,
						array(
							'name' => 'url',
				      'sortable'=>false,
							'value' => '$data->url',
						) ,
						array(
							'name' => 'image',
							'type'=>'image',
				      'sortable'=>false,
            	// 'value'=>'(!empty($data->image))?Yii::app()->request->baseUrl."/uploads/sliders/".$data->image:"no image"',
            	'value'=>'Yii::app()->request->baseUrl."/uploads/sliders/thumb_".$data->image',
							),
						array(
							'class'=>'bootstrap.widgets.TbButtonColumn',
				      'template'=>'{view} {update} {delete}',
						),
					),
				)); 
				//CHtml::image(Yii::app()->request->baseUrl.'/uploads/sliders/'.$data->image,"image",array("style"=>"width:100px;height:100px;"))
        //Yii::app()->request->baseUrl."/uploads/sliders/".$data->image
				?>
    </div>
</div>
