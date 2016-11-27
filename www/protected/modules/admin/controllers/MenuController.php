<?php

class MenuController extends AbstractAdminController {

  /**
   * Creates a new model.
   * If creation is successful, the browser will be redirected to the 'view' page.
   */
  public function actionCreate() {

    //Add menu
    if (isset($_GET['menu'])) {
      $menu = new Menu();
      $menu->attributes = array('title' => 'Untitled');
      if ($menu->save()) {
        $this->success('Menu added');
        $this->redirect(array('update', 'id' => $menu->id));
      } else {
        $this->error('Error adding menu');
      }
    }

    //Add menu item
    if (!empty($_POST['data']) && $_POST['data']['additem'] && Yii::app()->request->getIsAjaxRequest()) {
      if (empty($_POST['type'])) {
        header("HTTP/1.1 400 Missing item type");
        die();
      }

      if ($_POST['type'] == 'custom') {
        $_POST['data']['url_params'] = json_encode(array(
          'class' => $_POST['data']['class']
        ));
      } else {
        $_POST['data']['url_params'] = json_encode(array(
          'module' => $_POST['type'],
          'item' => $_POST['data']['item'],
          'slug' => $_POST['data']['slug'],
          'class' => $_POST['data']['class']
        ));
      }

      $menuItem = new MenuItem();
      $menuItem->attributes = $_POST['data'];

      if ($menuItem->save()) {
        die($menuItem->id);
      } else {
        header("HTTP/1.1 500 Error adding item");
      }
    }

    $this->redirect(array('index'));
  }

  /**
   * Updates a particular model.
   * If update is successful, the browser will be redirected to the 'view' page.
   * @param integer $id the ID of the model to be updated
   */
  public function actionUpdate($id) {

    //Update menu
    if (!empty($_POST['menu'])) {
      $menu = $this->loadMenu($id);
      $menu->attributes = $_POST['menu'];
      if ($menu->save()) {
        $this->success('Menu updated');
      } else {
        $this->error('Error updating menu');
      }
    }

    //Update items
    if (!empty($_POST['item'])) {
      $items = $_POST['item'];
      $items = $this->arrayFlipConvert($items);

      foreach ($items as $item) {
        if (!empty($item['url_params'])) {
          if (!empty($item['url_params']['module'])) {
            $item['url_params'] = json_encode(array(
              'module' => $item['url_params']['module'],
              'item' => $item['url_params']['item'],
              'slug' => $item['url_params']['slug'],
              'class' => $item['url_params']['class']
            ));
          } else {
            $item['url_params'] = json_encode(array(
              'class' => $item['url_params']['class']
            ));
          }
        }

        $menuItem = $this->loadMenuItem($id);
        if ($menuItem != null) {
          $menuItem->attributes = $item;
          if (!$menuItem->save()) {
            $this->error('Error updating menu item: ' . $menuItem->id);
          }
        }
      }
    }

    $menus = Menu::model()->findAll();

    if (count($menus) == 0) return $this->render('index');
    $menu = $menus[0];
    foreach ($menus as $m) {
      if ($m->id == $id) {
        $menu = $m;
        break;
      }
    }

    $items = MenuItem::model()->findAllByAttributes(array('menu_id' => $menu->id));
    $categories = Category::model()->findAll();
    $brands = Brand::model()->findAll();

    $this->render('update', compact('menus', 'menu', 'items', 'categories', 'brands'));
  }

  /**
   * Deletes a particular model.
   * If deletion is successful, the browser will be redirected to the 'admin' page.
   * @param integer $id the ID of the model to be deleted
   */
  public function actionDelete($id = 0) {
    if (empty($id)) {
      $id = $_POST['id'];
    }

    if (empty($id)) {
      if (Yii::app()->request->getIsAjaxRequest()) {
        header("HTTP/1.0 400 Missing ID");
        die();
      }
      $this->error('Invalid request. Missing ID');
      $this->redirect(array('index'));
    }

    if (!empty($_POST['type']) && $_POST['type'] == 'item') { //Delete item
      $this->loadMenuItem($id)->delete();
      die('OK');
    }else { //Delete menu
      MenuItem::model()->deleteAll(array('condition'=>'menu_id=' . $id));
      $this->loadMenu($id)->delete();
      $this->success('Menu deleted');
    }

    $this->redirect(array('index'));
  }

  /**
   * Lists all models.
   */
  public function actionIndex() {
    $menus = Menu::model()->findAll();
//    $p = new Product();
//    $p->brand_id = 3;
//    $p->category_id = 2;
    $p = Product::model()->findByPk(9);
    $p->name = ' Đây    là dùng để kiểm }{^%} $^*($& tra product\'s slug   ';
    $p->save();

    if (empty($menus)) {
      $this->render('index');
    } else {
      $menus = Menu::model()->findAll();

      if (count($menus) == 0) return $this->render('index');
      $menu = $menus[0];

      $items = MenuItem::model()->findAllByAttributes(array('menu_id' => $menu->id));
      $categories = Category::model()->findAll();
      $brands = Brand::model()->findAll();

      $this->render('update', compact('menus', 'menu', 'items', 'categories', 'brands'));
    }
  }

  /**
   * Returns the data model based on the primary key given in the GET variable.
   * If the data model is not found, an HTTP exception will be raised.
   * @param integer the ID of the model to be loaded
   */
  public function loadMenu($id) {
    $model = Menu::model()->findByPk($id);
    if ($model === null)
      throw new CHttpException(404, 'The requested page does not exist.');
    return $model;
  }

  /**
   * Returns the data model based on the primary key given in the GET variable.
   * If the data model is not found, an HTTP exception will be raised.
   * @param integer the ID of the model to be loaded
   */
  public function loadMenuItem($id) {
    $model = MenuItem::model()->findByPk($id);
    return $model;
  }

  /**
   * Performs the AJAX validation.
   * @param CModel the model to be validated
   */
  protected function performAjaxValidation($model) {
    if (isset($_POST['ajax']) && $_POST['ajax'] === 'page-form') {
      echo CActiveForm::validate($model);
      Yii::app()->end();
    }
  }
}
