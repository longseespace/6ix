<?php
$this->breadcrumbs=array(
	'Carts'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Cart','url'=>array('index')),
	array('label'=>'Create Cart','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('cart-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Carts</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'cart-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'user_id',
		'session_id',
		'order_code',
		'price',
		'real_price',
		/*
		'cod_fee',
		'discount',
		'expire',
		'ship_fullname',
		'ship_email',
		'ship_gender',
		'ship_address',
		'ship_mobile',
		'ship_city',
		'bill_fullname',
		'bill_email',
		'bill_gender',
		'bill_address',
		'bill_mobile',
		'bill_city',
		'bank_id',
		'payment_method',
		'payment_id',
		'note',
		'status',
		'create_time',
		'modifie_time',
		*/
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
