<?php

class SliderController extends AbstractAdminController
{
  var $allowedFileType = array('image/gif', 'image/jpeg', 'image/pjpeg', 'image/png');

  public function init() {

    if (!is_dir(Slider::UPLOAD_URL)) {
      @mkdir(Slider::UPLOAD_URL, 0777, true);
    }
  }
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Slider;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if(isset($_POST['Slider']))		
		{
			$model->attributes=$_POST['Slider'];
			$uploadedFile=CUploadedFile::getInstance($model,'image');
			$model->image = $uploadedFile;
			if($model->save()) {
				if(!empty($uploadedFile))  // check if uploaded file is set or not
          {
            $uploadedFile->saveAs(Slider::UPLOAD_URL.$model->image);
            $info = pathinfo(Slider::UPLOAD_URL . $model->image);
		        $image = new Image(Slider::UPLOAD_URL . $model->image);
		        $image->resize('100','100');
		        $image->save(Slider::UPLOAD_URL ."thumb_" .$info['filename'] .".". $info['extension']);
          }
				$this->redirect('index');
			}
		}
		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Slider']))
		{
			$model->attributes=$_POST['Slider'];			
			$uploadedFile=CUploadedFile::getInstance($model,'image');
			$model->image = $uploadedFile;
			// $_POST['Slider']['image'] = $model->image;
			if($model->save()){
				if(!empty($uploadedFile))  // check if uploaded file is set or not
          {          	
            $uploadedFile->saveAs(Slider::UPLOAD_URL.$model->image);
          	$info = pathinfo(Slider::UPLOAD_URL . $model->image);
		        $image = new Image(Slider::UPLOAD_URL . $model->image);
		        $image->resize('100','100');
		        $image->save(Slider::UPLOAD_URL ."thumb_" .$info['filename'] .".". $info['extension']);
          }
          $this->redirect('/admin/slider/index');
      }				
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model=new Slider('search');
		$count = $model->id;
    $model->image = $fileName;
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Slider']))
			$model->attributes=$_GET['Slider'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Slider('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Slider']))
			$model->attributes=$_GET['Slider'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Slider::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='slider-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	protected function saveImages() {
    if (in_array($_FILES["file"]["type"], $this->allowedFileType)) {
      $uploadDir = $this->kernel->config('app.path.uploads');
      $info = pathinfo($_FILES["file"]["name"]);
      $fileName = 'slider_' . time() . '.' . $info['extension'];

      if ($_FILES["file"]["error"] > 0) {
        $this->addNotification('File error: ' . $_FILES["file"]["error"], 'error');
      } else {
        if (!is_dir($uploadDir)) {
          @mkdir($uploadDir, 0777, true);
        }

        if (file_exists($uploadDir . $fileName)) {
          @unlink($uploadDir . $fileName);
        }
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $uploadDir . $fileName)) {
          $this->kernel->media()->generateThumbs($fileName, null, array('width' => 78, 'height' => 31, 'name' => 'thumbs'));
          return $fileName;
        }
      }
    }
    return false;
  }
}
