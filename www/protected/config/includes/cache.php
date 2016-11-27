<?php
  return array(
    'components' => array(
      'cache'=>array(
        'class'=>'ext.redis.CRedisCache',
        'servers'=>array(
          array(
            'host'=>'lab.dynabyte.vn',
            'port'=>6379,
          )
        ),
      ),
    )
  );
?>