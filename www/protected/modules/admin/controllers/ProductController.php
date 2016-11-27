<?php

class ProductController extends AbstractAdminController {

  public function init() {
    parent::init();
  }

  /**
   * Displays a particular model.
   * @param integer $id the ID of the model to be displayed
   */
  public function actionView($id) {
    $this->render('view', array('model' => $this->loadModel($id),));
  }

  /**
   * Creates a new model.
   * If creation is successful, the browser will be redirected to the 'view' page.
   */
  public function actionCreate() {
    $this->addJSVars(array(
      'uploadURL' => $this->createUrl('product/upload', array('id' => $id)),
      'deleteURL' => $this->createUrl('product/delete', array('id' => $id)),
      'action' => $this->action->id,
    ));

    $model = new Product;

    // Uncomment the following line if AJAX validation is needed
    // $this->performAjaxValidation($model);

    if (isset($_POST['Product'])) {
      $model->attributes = $_POST['Product'];
      if ($model->save()) $this->redirect(array('view', 'id' => $model->id));
    }

    $this->render('create', array('model' => $model,));
  }

  /**
   * Updates a particular model.
   * If update is successful, the browser will be redirected to the 'view' page.
   * @param integer $id the ID of the model to be updated
   */
  public function actionUpdate($id) {
    $this->addJSVars(array(
      'uploadURL' => $this->createUrl('product/upload', array('id' => $id)),
      'deleteURL' => $this->createUrl('product/delete', array('id' => $id)),
      'action' => $this->action->id,
    ));

    $model = $this->loadModel($id);
    $modelupc = $this->loadModel($id);
    $pattern = Pattern::model()->with('color')->findAll();

    // Uncomment the following line if AJAX validation is needed
    // $this->performAjaxValidation($model);

    if (isset($_POST['Product'])) {
      $images = $this->arrayFlipConvert($_POST['upload']);
      $i = 0;
      foreach ($images as $image) {
        $i++;
        $pi = ProductImage::model()->findByPk($image['id']);
        $pi->pattern_id = empty($image['pattern_id']) ? null : $image['pattern_id'];
        $pi->rank = $i;
        $pi->update();
      }
      $model->attributes = $_POST['Product'];
      if ($model->save()) $this->redirect(array('update', 'id' => $model->id));
    }
    if (isset($_POST['upc'])) {
      $modelupc->attributes = $_POST['upc'];
      if ($modelupc->save()) $this->redirect(array('view', 'id' => $modelupc->id));
    }
    $this->render('update', array('model' => $model, 'modelupc' => $modelupc, 'pattern' => $pattern));
  }

  /**
   * Deletes a particular model.
   * If deletion is successful, the browser will be redirected to the 'admin' page.
   * @param integer $id the ID of the model to be deleted
   */
  public function actionDelete($id) {
    if (Yii::app()->request->isPostRequest) {
      ProductImage::model()->findByPk($_POST['id'])->delete();
    } else
      throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
  }

  /**
   * Lists all models.
   */
  public function actionIndex() {
    $model = new Product('search');
    $model->unsetAttributes(); // clear any default values
    if (isset($_GET['Product'])) $model->attributes = $_GET['Product'];

    $this->render('admin', array(
      'model' => $model,
    ));
    // $dataProvider = new CActiveDataProvider('Product');
    // $this->render('index', array('dataProvider' => $dataProvider,));
  }

  /**
   * Manages all models.
   */
  public function actionAdmin() {
    $model = new Product('search');
    $model->unsetAttributes(); // clear any default values
    if (isset($_GET['Product'])) $model->attributes = $_GET['Product'];

    $this->render('admin', array(
      'model' => $model,
    ));
  }

  public function actionUpload($id = 0) {
    $this->uploadOptions['uploadDir'] = ProductImage::UPLOAD_URL;
    $this->uploadOptions['success'] = function ($file, $options) use ($id) {
      $pi = new ProductImage();
      if ($id != 0) {
        $pi->product_id = $id;
      }
      $pi->rank = 100;
      $pi->file = $file['name'];
      $pi->save();

      $info = pathinfo(ProductImage::UPLOAD_URL . $file['name']);
      foreach (ProductImage::$size as $k => $v) {
        $image = new Image(ProductImage::UPLOAD_URL . $file['name']);
        $image->resize($v['width'], $v['height']);
        $image->save(ProductImage::UPLOAD_URL . $info['filename'] . "_{$k}." . $info['extension']);
      }
      return array(
        'error' => false, 'message' => 'File was uploaded successfully', 'filename' => $file['name'], 'id' => $pi->id
      );
    };
    parent::actionUpload($id);
  }

  /**
   * Returns the data model based on the primary key given in the GET variable.
   * If the data model is not found, an HTTP exception will be raised.
   * @param integer the ID of the model to be loaded
   */
  public function loadModel($id) {
    $model = Product::model()->findByPk($id);
    if ($model === null) throw new CHttpException(404, 'The requested page does not exist.');
    return $model;
  }

  /**
   * Performs the AJAX validation.
   * @param CModel the model to be validated
   */
  protected function performAjaxValidation($model) {
    if (isset($_POST['ajax']) && $_POST['ajax'] === 'product-form') {
      echo CActiveForm::validate($model);
      Yii::app()->end();
    }
  }

  public function export(CDataProvider $dataProvider, array $options = array()) {
    parent::export($dataProvider, $options + array(
      'columns' => array(
        array('name' => 'ID', 'value' => '$data->id',),
        array('name' => 'Name', 'value' => '$data->name',),
        array('name' => 'Brand', 'value' => '$data->brand->name',),
        array('name' => 'Category', 'value' => '$data->category->name',),
        array('name' => 'Pcode', 'value' => '$data->pcode',),
        array('name' => 'Original Style', 'value' => '$data->original_style',),
        array('name' => 'Price Retail', 'value' => '$data->price_retail',),
        array('name' => 'Price Sell', 'value' => '$data->price_sell',),
        array('name' => 'Cost', 'value' => '$data->cost',),
        array('name' => 'Tags', 'value' => 'implode(", ", array_map(function($a) { return $a->name;}, $data->tags))',),
        array(
          'name' => 'Date',
          'value' => 'date("d/m/Y", CDateTimeParser::parse($data->create_time, "yyyy-MM-dd hh:mm:ss"))',
          'headerHtmlOptions' => array('class' => ''),
        ),
      ),
    ));
  }

  /**
   * Search for Products
   * @param string keyword
   * @return string json-encoded products
   */
  public function actionSearch()
  {
    $keyword = $_GET['keyword'];
    $limit = empty($_GET['limit']) ? 12 : intval($_GET['limit']);
    $offset = empty($_GET['offset']) ? 0 : intval($_GET['offset']);
    $category_id = empty($_GET['category_id']) ? '' : intval($_GET['category_id']);

    $q = new CDbCriteria();
    $q->addSearchCondition('name', $keyword, true, 'OR');
    $q->addSearchCondition('slug', $keyword, true, 'OR');
    $q->addSearchCondition('description', $keyword, true, 'OR');
    $q->addSearchCondition('pcode', $keyword, true, 'OR');
    $q->limit = $limit;
    $q->offset = $offset;
     
    $models = Product::model()->findAll( $q );
    $products = array();
    foreach ($models as $model) {
      $products[] = $model->attributes;
    }

    echo json_encode($products);
    Yii::app()->end();
  }
}