<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
abstract class AbstractAdminController extends Controller
{
  
  /**
   * @var layout
   */
  public $layout = 'admin';
  /**
   * @var array context menu items. This property will be assigned to {@link CMenu::items}.
   */
  public $menu=array();
  /**
   * @var array the breadcrumbs of the current page. The value of this property will
   * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
   * for more details on how to specify this property.
   */
  public $breadcrumbs=array();

  private $_assetsUrl;

  /**
   * @var string Path to the form configuration folder
   */
  public static $modelViewPath = 'application.models.admin.view';

  public function getAssetsUrl($theme = 'admin')
  {
    if (YII_DEBUG) {
      $this->_assetsUrl = Yii::app()->getBaseUrl()."/themes/{$theme}/assets";
    } else {
      $this->_assetsUrl = Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias("webroot.theme.{$theme}.assets"));
    }

    return $this->_assetsUrl;
  }

  /**
   * @param string $file file name
   * @return string The path of alias to form config folder or $file
   */
  public function formConfig($file = '') {
    return $file === '' ? self::$modelViewPath : self::$modelViewPath . '.' . $file;
  }

  /**
   * Save flash success message
   * @param $message
   */
  public function success($message) {
    if (is_array($message)) {
      Yii::app()->user->setFlash('success', 'Success ' . $message['code'] . ': ' . $message['message']);
    } else {
      Yii::app()->user->setFlash('success', $message);
    }
  }

  /**
   * Save flash error message
   * @param $message
   */
  public function error($message) {
    if (is_array($message)) {
      Yii::app()->user->setFlash('error', 'Error ' . $message['code'] . ': ' . $message['message']);
    } else {
      Yii::app()->user->setFlash('error', $message);
    }
  }

  /**
   * @return array action filters
   */
  public function filters()
  {
    return array(
      'accessControl', // perform access control for CRUD operations
    );
  }

  /**
   * Specifies the access control rules.
   * This method is used by the 'accessControl' filter.
   * @return array access control rules
   */
  public function accessRules()
  {
    return array(
      array('allow', // allow admin user to perform 'admin' and 'delete' actions
        'users'=>UserModule::getAdmins(),
      ),
      array('deny',  // deny all users
        'users'=>array('*'),
      ),
    );
  }

  /**
   * Export data to file to download
   * @param CDataProvider $dataProvider
   * @param array $options
   */
  public function export(CDataProvider $dataProvider, array $options = array()) {
    $this->widget('ext.eexcelview.EExcelView', array(
      'dataProvider'=>$dataProvider,
      'grid_mode'=>'export'
    ) + $options);
    die();
  }

  public function actionDelete($id) {
    throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
  }

  /**
   * Generate random string with prefix string and a random text with length
   * @param $pre $len
   */
  public function generateCode($pre = '6IX', $len = 5) {
    $buffer='';
    $baseDigits = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    for ($i=0; $i < $len; $i++) {
      $buffer[$i] = $baseDigits[rand(0, strlen($baseDigits) - 1 )];
    }
    return empty($pre) ? implode($buffer) : $pre . implode($buffer);
  }
  
  protected function beforeRender($view) {
    $this->addJSVars(array('controller' => $this->uniqueid, 'action' => $this->action->Id));

    Yii::app()->clientScript->registerScript('jsVars', 'window.'.$this->jsNamespace.' = '.CJSON::encode($this->jsVars).';', CClientScript::POS_HEAD);
    return true;
  }
}