<?php $this->widget('bootstrap.widgets.TbGridView', array(
  'type'=>'striped ',
  'itemsCssClass'=>'items table-hover' ,
  'dataProvider'=>$model->search(),
  'columns'=>array(
    array(
            'name' => 'id' ,
            'sortable'=>false,
            'value' => '$data->id',
        ) ,
    array(
            'name' => 'title' ,
            'sortable'=>false,
            'value' => '$data->title',
        ) , 
    array(
            'name' => 'content' ,
            'sortable'=>false,
            'value' => '$data->exerpt()',
        ) , 
    // 'create_time',
    // 'update_time',
    array(
      'class'=>'bootstrap.widgets.TbButtonColumn',
      'template'=>'{view} {update} {delete}',
    ),
  ),
)); 

 ?>
