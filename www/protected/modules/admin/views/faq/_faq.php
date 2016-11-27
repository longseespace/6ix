<?php $this->widget('bootstrap.widgets.TbGridView', array(
  'type'=>'striped',  
  'itemsCssClass'=>'item table-hover' ,
  'dataProvider'=>$model->search(),
  // 'filter'=>$model,
  'htmlOptions'=> array( 
    // 'class'=>'datatable',
    // 'id'=>'inventory',
    ),
  'columns'=>array(
    array(
            'name' => 'id' ,
            'sortable'=>false,
            'value' => '$data->id',
        ) ,
    array(
            'name' => 'category' ,
            'sortable'=>true,
            'value' => '$data->category',
        ) ,    
    array(
            'name' => 'question' ,
            'sortable'=>false,
            'value' => '$data->question',
        ) , 
    // array(
    //         'name' => 'answer' ,
    //         'sortable'=>false,
    //         'value' => '$data->answer',
    //     ) , 
    // 'create_time',
    // 'update_time',
    array(
      'class'=>'bootstrap.widgets.TbButtonColumn',
      'template'=>'{view} {update} {delete}',
    ),
  ),
)); 

?>
