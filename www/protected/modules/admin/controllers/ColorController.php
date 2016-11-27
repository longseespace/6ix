<?php

class ColorController extends AbstractAdminController
{

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id) {
		$patterns = new CActiveDataProvider('Pattern', array(
      'criteria'=>array(
        'condition'=>'t.color_id=' . $id,
        // 'scopes'=>'active',
        // 'with' => array('color'),
        // 'together' => true,
      ),

      // 'pagination'=> array(
      //   'pageSize'=> self::PAGE_SIZE,
      // ),
    ));
		$models = new CActiveDataProvider('Color');
		$this->render('admin', compact('models', 'patterns'));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	// public function actionCreate()
	// {
	// 	$model=new Color;

	// 	// Uncomment the following line if AJAX validation is needed
	// 	// $this->performAjaxValidation($model);

	// 	if(isset($_POST['Color']))
	// 	{
	// 		$model->attributes=$_POST['Color'];
	// 		if($model->save())
	// 			$this->redirect(array('view','id'=>$model->id));
	// 	}

	// 	$this->render('create',array(
	// 		'model'=>$model,
	// 	));
	// }

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	// public function actionUpdate($id)
	// {
	// 	$model=$this->loadModel($id);

	// 	// Uncomment the following line if AJAX validation is needed
	// 	// $this->performAjaxValidation($model);

	// 	if(isset($_POST['Color']))
	// 	{
	// 		$model->attributes=$_POST['Color'];
	// 		if($model->save())
	// 			$this->redirect(array('view','id'=>$model->id));
	// 	}

	// 	$this->render('update',array(
	// 		'model'=>$model,
	// 	));
	// }

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	// public function actionDelete($id)
	// {
	// 	if(Yii::app()->request->isPostRequest)
	// 	{
	// 		// we only allow deletion via POST request
	// 		$this->loadModel($id)->delete();

	// 		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
	// 		if(!isset($_GET['ajax']))
	// 			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	// 	}
	// 	else
	// 		throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	// }

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		// $dataProvider=new CActiveDataProvider('Color');
		// $this->render('index',array(
		// 	'dataProvider'=>$dataProvider,
		// ));

		$models = new CActiveDataProvider('Color');
		$this->render('admin',array(
			'models'=>$models
		));
	}

	/**
	 * Manages all models.
	 */
	// public function actionAdmin()
	// {
	// 	$model=new Color('search');
	// 	$model->unsetAttributes();  // clear any default values
	// 	if(isset($_GET['Color']))
	// 		$model->attributes=$_GET['Color'];

	// 	$this->render('admin',array(
	// 		'model'=>$model,
	// 	));
	// }

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Color::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='color-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
