<?php
  return array(
    'preload'=>array(
      'bootstrap',
    ),
    'modules'=>array(
      'gii'=>array(
        'generatorPaths'=>array(
          'ext.bootstrap.gii',
        ),
      ),
    ),
    'components'=>array(
      'bootstrap'=>array(
        'class'=>'ext.bootstrap.components.Bootstrap',
        'responsiveCss' => true
      ),
    ),
    'import' => array(
      'ext.bootstrap.widgets.*'
    )
  );
?>