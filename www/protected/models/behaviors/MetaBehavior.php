<?php
class MetaBehavior extends CActiveRecordBehavior {

  private $_meta = null;

  private $_metaObject;

  public function getMeta()
  {
    $owner = $this->owner;
    if (!$this->_meta) {
      $meta = Metadata::model()->findAllByAttributes(array(
        'table' => $owner->tableName(),
        'owner_id' => $owner->id
      ));

      $this->_metaObject = $meta;

      $data = new stdClass;
      foreach ($meta as $row) {
        $data->{$row->key}[] = $row->value;
      }
      $this->_meta = $data;
    }
    return $this->_meta;
  }

  public function getMetaObject()
  {
    $owner = $this->owner;
    if (!$this->_metaObject) {
      $this->_metaObject = Metadata::model()->findAllByAttributes(array(
        'table' => $owner->tableName(),
        'owner_id' => $owner->id
      ));
    }

    return $this->_metaObject;
  }

  /**
   * Metadata getter/setter
   * @param string $key
   * @param mixed $value
   * @param string $oldvalue
   */
  public function attr($key = null, $values = null, $oldvalue = null)
  {
    $owner = $this->owner;
    if (is_null($key)) {
      // get all attributes
      return $this->meta;
    } else {
      // get attribute with key {$key}
      if (is_null($values)) {
        $values = $this->meta->{$key};
        if (count($values) == 1) {
          $values = $values[0];
        } else if (empty($values)) {
          $values = false;
        }
        return $values;
      } else {
        $conditions = array(
          'table' => $owner->tableName(),
          'owner_id' => $owner->id,
          'key' => $key
        );

        if (is_string($values)) {
          // set one item
          if (is_string($oldvalue)) {
            $conditions['value'] = $oldvalue;
          }
          $item = Metadata::model()->findByAttributes($conditions);
          if ($item) {
            $item->value = $values;
            return $item->save();
          }
        } else if (is_array($values)) {
          // set multi item
          // fail-safe update
          $oldValues = $this->metaObject;
          Metadata::model()->deleteAllByAttributes($conditions);
          foreach ($values as $value) {
            $item = new Metadata;
            $item->table = $owner->tableName();
            $item->owner_id = $owner->id;
            $item->key = $key;
            $item->value = $value;
            $item->save();
          }
          
          return true;
        }
      }
    }
  }
}

class Metadata extends CActiveRecord
{
  /**
   * Returns the static model of the specified AR class.
   * @param string $className active record class name.
   * @return CvFieldsValues the static model class
   */
  public static function model($className=__CLASS__)
  {
    return parent::model($className);
  }

  /**
   * @return string the associated database table name
   */
  public function tableName()
  {
    return 'metadata';
  }

}