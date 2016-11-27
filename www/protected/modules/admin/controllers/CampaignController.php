<?php

class CampaignController extends AbstractAdminController
{

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
		$model=new Campaign;
		$model->scenario = 'original_update';

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Campaign']))
		{
			$model->attributes=$_POST['Campaign'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
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
		$model->scenario = 'original_update';

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Campaign']))
		{
			$model->attributes=$_POST['Campaign'];
			if($model->save())
				$this->redirect(array('update','id'=>$model->id));
		}

		$this->addJSVars(array(
			'campaign' => $model->attributes, 
			'addProductsUrl' =>  $this->createUrl('campaign/addProducts', compact('id')),
			'removeProductsUrl' =>  $this->createUrl('campaign/removeProducts', compact('id'))
		));

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
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model=new Campaign('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Campaign']))
			$model->attributes=$_GET['Campaign'];

		$this->render('index',array(
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
		$model=Campaign::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='campaign-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	/**
	 * Add product(s) to this campaign
	 */
	public function actionAddProducts($id)
	{
		$model = $this->loadModel($id);
		$model->scenario = "update_products";

		if (empty($_POST['product_ids'])) {
			return false;
		} else {
			$product_ids = $_POST['product_ids'];
			if (!is_array($product_ids)) {
				$product_ids = array($product_ids);
			}
		}

		$model->taggable->addTags($product_ids);

		if ($model->save()) {
			echo json_encode(array('products' => $model->tags));
		} else {
			echo json_encode(array('errors' => $model->getErrors()));
		}
		Yii::app()->end();
	}

	/**
	 * Remove product(s) from this campaign
	 */
	public function actionRemoveProducts($id)
	{
		$model = $this->loadModel($id);
		$model->scenario = "update_products";

		if (empty($_POST['product_ids'])) {
			return false;
		} else {
			$product_ids = $_POST['product_ids'];
			if (!is_array($product_ids)) {
				$product_ids = array($product_ids);
			}
		}

		$model->taggable->removeTags($product_ids);

		if ($model->save()) {
			echo json_encode(array('products' => $model->tags));
		} else {
			echo json_encode(array('errors' => $model->getErrors()));
		}
		Yii::app()->end();
	}

}
