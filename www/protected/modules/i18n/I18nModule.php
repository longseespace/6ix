<?php

class I18nModule extends CWebModule {

	/**
	 * TranslateModule::init()
	 *
	 * @return
	 */
	public function init()
	{
		$this->defaultController = 'Translate';
		$this->setImport(array(
			'i18n.models.*',
			'i18n.controllers.*',
			'i18n.components.*',
			'i18n.widgets.*'
		));
		return parent::init();
	}

}