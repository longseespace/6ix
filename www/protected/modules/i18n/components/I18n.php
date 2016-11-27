<?php

Yii::import('application.modules.i18n.models.MessageSource');
Yii::import('application.modules.user.UserModule');

class I18n extends CApplicationComponent {

	const MODE_ADMIN = 0;
	const MODE_FREE = 1;
	const MODE_DISABLE = 2;

	const STATE_COOKIE_ENABLED = "yes";

	public $mode = self::MODE_FREE;
	public $stateCookie = false;
  public $shortcutFunctions = true;

  public static function missingTranslation($event) {
    $attributes = array(
      'category' => $event->category,
      'message' => $event->message
    );

    if (($model = MessageSource::model()->find('message=:message AND category=:category', $attributes)) === null) {
      $model = new MessageSource();
      $model->attributes = $attributes;
      if (!$model->save()) {
      	return Yii::log(Yii::t(__CLASS__, 'Message ' . $event->message . ' could not be added to messageSource table'));;
      }
    }

    return $event;
  }

  public function init(){
    $language = Yii::app()->session->get('language', null);
    if(!empty($language)){
      Yii::app()->language = $language;
    }

    if($this->shortcutFunctions){
      require_once('shortcutFunctions.php');
    }

    $this->registerScripts();
  }

  public function t($category,$message,$params=array(),$source=null,$language=null) {
  	$content = Yii::t($category,$message,$params);
  	if($this->isActive()){
      $attributes = compact('category', 'message');
      $model = MessageSource::model()->findByAttributes($attributes);
      if($model === null){
        $model = new MessageSource();
        $model->attributes = $attributes;
        if (!$model->save()) {
          return Yii::log(Yii::t(__CLASS__, 'Message ' . $event->message . ' could not be added to messageSource table'));;
        }
      }

      return CHtml::tag('span', array(
        'class' => 'i18n fancybox.ajax wtranslate wt-'.$model->id,
        'data-url' => Yii::app()->urlManager->createUrl('/i18n/translate/create',
          array('id' => $model->id, 'lang' => Yii::app()->language)),
      ), $content);


  	}else{
  		return $content;
  	}
  }

  private function isActive() {
    if(Yii::app()->language === Yii::app()->sourceLanguage){
      return false;
    }elseif($this->stateCookie && Yii::app()->request->cookie[$this->$stateCookie] != self::STATE_COOKIE_ENABLED){
  		return false;
  	}elseif($this->mode === self::MODE_DISABLE){
  		return false;
  	}elseif($this->mode === self::MODE_FREE){
  		return true;
  	}elseif(UserModule::isAdmin()){
  		return true;
  	}else{
  		return false;
  	}
  }

  private function registerScripts() {
    $assets = Yii::app()->getAssetManager()->publish(dirname(__FILE__) . '/../widgets/assets');

    $cs = Yii::app()->clientScript;
    $cs->registerCoreScript('jquery');

    /* widget js files */
    $cs->registerCoreScript('jquery');

    /* fancybox files */
    $cs->registerCssFile($assets . '/fancybox/source/jquery.fancybox.css');
    $cs->registerScriptFile($assets . '/fancybox/source/jquery.fancybox.pack.js', CClientScript::POS_END);

    /* jwysiwyg files */
    $cs->registerCssFile($assets . '/jwysiwyg/jquery.wysiwyg.css');
    $cs->registerScriptFile($assets . '/jwysiwyg/jquery.wysiwyg.js', CClientScript::POS_END);
    $cs->registerScriptFile($assets . '/jwysiwyg/controls/wysiwyg.link.js', CClientScript::POS_END);
    $cs->registerScriptFile($assets . '/jwysiwyg/controls/wysiwyg.table.js', CClientScript::POS_END);

    /* modified jbar files */
    $cs->registerCssFile($assets . '/jbar/css/jbar.style.css');
    $cs->registerScriptFile($assets . '/jbar/jquery.bar.js', CClientScript::POS_END);
    $cs->registerScriptFile($assets . '/wtranslate.js', CClientScript::POS_END);

    /* widget style files */
    $cs->registerCssFile($assets . '/wtranslator.style.css');

    /* init the module on document ready */
    $cs->registerScript('WTranslateReadyJS', 'wtranslate.init();', CClientScript::POS_READY);
  }

  public function setLanguage($lang){
    Yii::app()->session->add('language', $lang);
    Yii::app()->language = $lang;
  }

}
