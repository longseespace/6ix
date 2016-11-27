<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'product-grid',
  'template' => '{summary} {items} {pager}',
  'type'=>'striped',
  'itemsCssClass'=>'item table-hover' ,
	'dataProvider'=>$model->search(),
	'filter'=>$model,
  'htmlOptions'=> array( 
    // 'class'=>'datatable',
    // 'id'=>'inventory',
    ),
	'columns'=>array(
    array(
      'name' => 'name' ,
      'sortable'=>false,
      'value' => '$data->name',
    ) ,
    array(
      'name' => 'pcode' ,
      'sortable'=>false,
      'value' => '$data->pcode',
    ) ,   
		array(
			'name' => 'brand' ,
			'value' => '$data->brand->name',
		) ,
    array(
      'name' => 'category' ,
      'sortable'=>false,
      'value' => '$data->category->name',
    ) ,
		array(
      'name' => 'status' ,
      'sortable'=>false,
      'value' => '$data->status',
    ) ,
    array(
      'name' => 'price_sell' ,
      'sortable'=>false,
      'value' => '$data->price_sell',
    ) ,
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
      'template'=>'{view} {update}',
		),
	),
));
?>