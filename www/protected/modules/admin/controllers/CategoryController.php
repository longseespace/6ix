<?php

class CategoryController extends AbstractAdminController
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
		$model=new Category;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Category'])) {
			$model->attributes=$_POST['Category'];
			if (isset($_POST['Category']['root'])) {
				if($model->saveToParent($_POST['Category']['root'])) {
					$this->redirect(array(
						'admin',
					));
				}
			}
			if($model->saveNode()) {
				$this->redirect(array(
					'admin',
				));
			}
		}
		//$categoryList = $model->createDropdownListData('name');
		$categoryTree = $model->createCategoryTreeData();
		$this->render('create',array(
			'model'=>$model,
			'categoryTree' => $categoryTree,
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

		if(isset($_POST['Category']))
		{
			$model->attributes=$_POST['Category'];
			//var_dump($_POST['Category']);
			if(isset($_POST['Category']['root'])) {
				if($model->saveToParent($_POST['Category']['root'])) {
					$this->redirect(array(
						'admin',
					));
				}
			}
			if($model->saveNode()) {
				$this->redirect(array(
					'admin',
				));
			}	
		}
		//$categoryList = $model->createDropdownListData('name');
		$categoryTree = $model->createCategoryTreeData();
		//var_dump($categoryTree);
		$this->render('update',array(
			'model'=>$model,
			'categoryTree'=>$categoryTree,
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
			$this->loadModel($id)->deleteNode();

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
		// $dataProvider=new CActiveDataProvider('Category');
		// $this->render('index',array(
		// 	'dataProvider'=>$dataProvider,
		// ));
		$this->redirect('create');
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		// $model=new Category('search');
		// $model->unsetAttributes();  // clear any default values
		// if(isset($_GET['Category']))
		// 	$model->attributes=$_GET['Category'];

		// $this->render('admin',array(
		// 	'model'=>$model,
		// ));
		$this->redirect('create');
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Category::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='category-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
