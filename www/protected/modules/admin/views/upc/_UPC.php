<?php $this->widget('bootstrap.widgets.TbGridView',array(
    'id'=>'upc-grid',
    'template' => '{summary} {items} {pager}',
    'type'=>'striped condensed',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'htmlOptions'=> array( 
    // 'class'=>'datatable',
    // 'id'=>'inventory',
    ),
    'columns'=>array(
        array(
            'name' => 'code' ,
            'sortable'=>false,
            'value' => '$data->code',
        ) ,
        array(
            'name' => 'product' ,
            'sortable'=>false,
            'value' => '$data->product->pcode',
        ) ,
        array(
            'name' => 'size' ,
            'sortable'=>false,
            'value' => '$data->size_id',
        ) ,
        array(
            'name' => 'pattern' ,
            'sortable'=>false,
            'value' => '$data->pattern_id',
        ) ,
        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'{view} {update}',
        ),
    ),
)); ?>
