<?php

class DefaultController extends AbstractAdminController
{
	public function actionIndex()
	{
		$this->render('index');
	}
}