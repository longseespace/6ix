<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
abstract class AbstractWarehouseController extends AbstractAdminController
{
  /**
   * @var layout
   */
  public $layout = 'warehouse';

  /**
   * @var string Path to the form configuration folder
   */
  public static $modelViewPath = 'application.models.warehouse.view';
}