<?php

class DefaultController extends AbstractWarehouseController
{
	public function actionIndex()
	{
		$this->render('index');
	}
}