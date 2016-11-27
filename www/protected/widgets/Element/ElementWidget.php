<?php

class ElementWidget extends CWidget{

  public $element_id;

  protected $element;

  public function init(){
    $this->element = $this->loadModel($this->element_id);
  }
 
  public function run(){
    return $this->render("_{$this->element->type}", array('element' => $this->element));
  }

  /**
   * Returns the data model based on the primary key given in the GET variable.
   * If the data model is not found, an HTTP exception will be raised.
   * @param integer the ID of the model to be loaded
   */
  public function loadModel($id)
  {
    $model=Element::model()->findByPk($id);
    if($model===null)
      throw new CHttpException(404,'The requested page does not exist.');
    return $model;
  }

}

?>