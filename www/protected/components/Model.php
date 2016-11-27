<?php
class Model extends CActiveRecord {
  public function behaviors() {
    return array(
      'timestamp' => array(
        'class' => 'zii.behaviors.CTimestampBehavior',
        'setUpdateOnCreate' => true
      )
    );
  }
}
?>