<?php

class UpcController extends AbstractAdminController
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
		$model=new Upc;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Upc']))
		{
			$model->attributes=$_POST['Upc'];
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

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Upc']))
		{
			$model->attributes=$_POST['Upc'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
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
    $model=new Upc('search');
    $model->unsetAttributes();  // clear any default values
    if(isset($_GET['Upc']))
      $model->attributes=$_GET['Upc'];

    $this->render('admin',array(
      'model'=>$model,
    ));
		// $dataProvider=new CActiveDataProvider('Upc');
		// $this->render('index',array(
		// 	'dataProvider'=>$dataProvider,
		// ));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Upc('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Upc']))
			$model->attributes=$_GET['Upc'];

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
		$model=Upc::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='upc-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

  public function actionTest($id) {
    $model = $this->loadModel($id);
    $result = $model->getStocks(5, array('description' => 'upc getstocks test'));
    echo '<pre>';
    if ($result) {
      echo 'true<br/>';
      print_r($result);
    } else {
      echo 'false';
    }
    echo '</pre>';
  }

  public function export(CDataProvider $dataProvider, array $options = array()) {
    parent::export($dataProvider, $options + array(
      'columns' => array(
        array(
          'name' => 'ID' ,
          'value' => '$data->id',
        ) ,
        array(
          'name' => 'Code' ,
          'value' => '$data->code',
        ) ,
        array(
          'name' => 'Size' ,
          'value' => '$data->size->name',
        ) ,
        array(
          'name' => 'Color' ,
          'value' => '$data->pattern->color->name',
        ) ,
        array(
          'name' => 'Name' ,
          'value' => '$data->product->name',
        ) ,
        array(
          'name' => 'Brand' ,
          'value' => '$data->product->brand->name',
        ) ,
        array(
          'name' => 'Category' ,
          'value' => '$data->product->category->name',
        ) ,
        array(
          'name' => 'Price Retail' ,
          'value' => '$data->product->price_retail',
        ) ,
        array(
          'name' => 'Price Sell' ,
          'value' => '$data->product->price_sell',
        ) ,
        array(
          'name' => 'Cost' ,
          'value' => '$data->product->cost',
        ) ,
        array(
          'name' => 'Date' ,
          'value' => 'date("d/m/Y", CDateTimeParser::parse($data->create_time, "yyyy-MM-dd hh:mm:ss"))',
          'headerHtmlOptions' => array(
            'class' => ''
          ) ,
        ) ,
      ) ,
    ));
  }
}
