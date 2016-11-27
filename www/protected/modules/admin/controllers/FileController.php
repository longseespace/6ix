<?php

/**
 * Author: Long Doan
 * Date: 8/29/12 10:35 AM
 */
class FileController extends AbstractAdminController {

  public $upload_dir;

  public function init() {
    parent::init();

    $this->upload_dir = Yii::app()->basePath . '/../uploads/';
    if (!is_dir($this->upload_dir)) {
      @mkdir($this->upload_dir, 0777);
    }
  }

  public function actions() {
    return array(
      'elfinder.' => 'widgets.elfinder.FinderWidget',
    );
  }

  public function actionIndex() {
    Yii::app()->getRequest()->getIsAjaxRequest() ? $this->renderPartial('index') : $this->render('index');
  }

  public function actionUploads() {
    $_FILES['file']['type'] = strtolower($_FILES['file']['type']);

    if ($_FILES['file']['type'] == 'image/png'
        || $_FILES['file']['type'] == 'image/jpg'
        || $_FILES['file']['type'] == 'image/gif'
        || $_FILES['file']['type'] == 'image/jpeg'
        || $_FILES['file']['type'] == 'image/pjpeg') {
      $filename = md5(date('YmdHis')).'.jpg';
      $file =  $this->upload_dir . $filename;

      // copying
      copy($_FILES['file']['tmp_name'], $file);
      $array = array(
        'filelink' => Yii::app()->baseUrl . '/uploads/' . $filename
      );

      die(stripslashes(json_encode($array)));
    }
    die();
  }

  public function actionImages() {
    $images = array();

    $handler = opendir($this->upload_dir);

    while ($file = readdir($handler))
    {
      if ($file != "." && $file != "..") {
        $images[] = $file;
      }
    }
    closedir($handler);

    $jsonArray=array();

    foreach($images as $image)
      $jsonArray[]=array(
        'image'=>Yii::app()->baseUrl.'/uploads/'.$image,
        'thumb'=>Yii::app()->baseUrl.'/uploads/'.$image,
      );

    header('Content-type: application/json');
    die(CJSON::encode($jsonArray));
  }
}

?>
