<?php
/**
 * Author: Long Doan
 * Date: 9/24/12 3:52 PM
 */
class UserController extends AbstractAdminController {


  /**
   * Updates a particular model.
   * If update is successful, the browser will be redirected to the 'view' Employee.
   * @param integer $id the ID of the model to be updated
   */
  public function actionUpdate($id)
  {
    $model=$this->loadModel($id);
      $profile=$model->profile;

      // ajax validator
      if(isset($_POST['ajax']) && $_POST['ajax']==='profile-form')
      {
          echo UActiveForm::validate(array($model,$profile));
          Yii::app()->end();
      }

      if(isset($_POST['User']))
      {
          $model->attributes=$_POST['User'];
          $profile->attributes=$_POST['Profile'];

          if($model->validate()&&$profile->validate()) {
              $model->save();
              $profile->save();
              Yii::app()->user->updateSession();
              Yii::app()->user->setFlash('profileMessage',UserModule::t("Changes is saved."));
          } else $profile->validate();
      }

      $this->render('update',array(
          'model'=>$model,
          'profile'=>$profile,
      ));
  }

  /**
   * Manages all models.
   */
  public function actionIndex()
  {
    $model = User::model()->findAll();

    $provider = new CActiveDataProvider('User', array(
      'criteria'=>array(
      ),

      'pagination'=>array(
        'pageSize'=>10,
      ),
    ));

    $this->render('index',array(
      'model'=>$model,
      'provider'=>$provider,
    ));
  }

  /**
   * Returns the data model based on the primary key given in the GET variable.
   * If the data model is not found, an HTTP exception will be raised.
   * @param integer the ID of the model to be loaded
   */
  public function loadModel($id)
  {
    $model=User::model()->findByPk($id);
    if($model===null)
      throw new CHttpException(404,'The requested Employee does not exist.');
    return $model;
  }

}

?>
