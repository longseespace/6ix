<?php
$this->breadcrumbs = array(
  'Manage',
);
?>

<div class="box">
    <div class="box-header">
        <h1>Manage Users</h1>
    </div>

    <div class="box-content">
      <?php $this->widget('bootstrap.widgets.TbGridView', array(
      'dataProvider' => $provider,
      'type' => 'striped',
      'itemsCssClass' => 'items table-hover',
      'columns' => array(
        'id',
        'email',
        'firstname' => array(
          'name' => 'First Name',
          'value' => '$data->profile->firstname'
        ),
        'lastname' => array(
          'name' => 'Last Name',
          'value' => '$data->profile->lastname'
        ),
        'status' => array(
          'name' => 'status',
          'value' => 'User::resolve("status", $data->status)'
        ),
        array(
          'class' => 'bootstrap.widgets.TbButtonColumn',
          'template' => '{update}',
          'buttons' => array(
            'update' => array(
              'url' => 'Yii::app()->controller->createUrl("update",array("id"=>$data->primaryKey))',
            ),
          ),
        ),
      ),
    )); ?>
    </div>
</div>
