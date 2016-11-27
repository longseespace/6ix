<?php
/**
 * Author: Long Doan
 * Date: 12/6/12 3:47 PM
 */

$cs = Yii::app()->clientScript;
$baseUrl = $this->assetsUrl;

$cs->registerScriptFile($baseUrl.'/js/jquery.ui.nestedSortable.js');
$cs->registerScriptFile($baseUrl.'/js/jquery.tmpl.js');
$cs->registerScriptFile($baseUrl.'/js/jquery.serializeObject.js');

?>
<div class="quick-actions">

  <a href="<?php echo $this->createUrl('create') ?>?menu">
    <span class="glyph new"></span>
    Add Menu
  </a>

  <a href="#" id="menu-list-button">
    <span class="glyph listicon"></span>
    Select Menus
  </a>

  <div id="menu-list-popover" class="popover">
    <header>
      Menu List
    </header>
    <section>
      <div class="content">
        <table>
          <thead>
          <tr>
            <th width="20%">ID</th>
            <th>Name</th>
          </tr>
          </thead>
          <tbody>
          <tr>
            <td>0</td>
            <td>No menu, use the 'Add Menu' button.</td>
          </tr>
          </tbody>
        </table>
      </div>
    </section>
  </div>
</div>

<div class="box">
  <div class="box column-left">
    <div class="box-header">
      <h1>Custom URL</h1>
    </div>

    <div class="box-content">
      <div class="add-menu-item" id="add-menu-custom">
        <input type="hidden" name="additem" value="1">
        <input type="hidden" name="menu_id" value="1">
        <p class="fields">
          URL<br>
          <input type="text" class="add-menu-url" name="url" disabled="disabled" placeholder="http://">
        </p>
        <p class="fields">
          Navigation Label<br>
          <input type="text" class="add-menu-title" name="title" disabled="disabled" placeholder="Home">
        </p>
      </div>
    </div>
  </div>

  <div class="box column-right">
    <div class="box-header">
      <h1>No Menu</h1>
    </div>

    <div style="margin: 10%">
      No item available
    </div>
  </div>
</div>