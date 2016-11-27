<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController {
  public $breadcrumbs;
  public $menu;
  public $jsNamespace = 'six';
  public $jsVars = array();
  public $uploadOptions;

  /**
   * Pass PHP variables to Javascript
   * @param array $vars
   * @return Controller
   */
  public function addJSVars($vars = array()) {
    foreach ($vars as $key => $value) {
      $this->jsVars[$key] = $value;
    }
    return $this;
  }

  protected function beforeRender($view) {
    Yii::app()->clientScript->registerScript('jsVars', 'window.'.$this->jsNamespace.' = '.CJSON::encode($this->jsVars).';', CClientScript::POS_HEAD);
    return true;
  }

  /**
   * Convert to useful array style from HTML form input style
   * Useful for matching up input arrays without having to increment a number in field names
   *
   * Input an array like this:
   * [name]	=>	[0] => "Google"
   *				[1] => "Yahoo!"
   * [url]	=>	[0] => "http://www.google.com"
   *				[1] => "http://www.yahoo.com"
   *
   * And you will get this:
   * [0]	=>	[name] => "Google"
   *			[title] => "http://www.google.com"
   * [1]	=>	[name] => "Yahoo!"
   *			[title] => "http://www.yahoo.com"
   *
   * @param array $input
   * @return array
   */
  public function arrayFlipConvert($input = array())
  {
    $output = array();
    foreach($input as $key => $val) {
      foreach($val as $key2 => $val2) {
        $output[$key2][$key] = $val2;
      }
    }
    return $output;
  }

  public function actionUpload($id = 0)
  {
    $output = array('error' => true, 'message' => 'Unknown error');
    if (strtolower($_SERVER['REQUEST_METHOD']) != 'post') {
      $output = array('error' => true, 'message' => 'Invalid HTTP method');
    } elseif (empty($_FILES)) {
      $output = array('error' => true, 'message' => 'No files found');
    } else {
      foreach ($_FILES as $file) {
        $output = Uploader::process($file, $this->uploadOptions);
      }
    }
    die(json_encode($output));
  }

}