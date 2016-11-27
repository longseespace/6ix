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
    Select Menu
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
          <?php foreach ($menus as $m) { ?>
          <tr>
            <td><?php echo $m->id ?></td>
            <td><a href="<?php echo $this->createUrl('update', array('id' => $m->id)) ?>"><?php echo $m->title ?></a></td>
          </tr>
          <?php } ?>
          </tbody>
        </table>
      </div>
    </section>
  </div>
</div>

<div class="column-left">
  <div class="box">
    <div class="box-header">
      <h1>Custom URL</h1>
    </div>

    <div class="box-content">
      <form action="<?php echo $this->createUrl('create') ?>" id="add-custom-menu" data-type="custom">
        <div class="add-menu-item" id="add-menu-custom">
          <input type="hidden" name="additem" value="1">
          <input type="hidden" name="menu_id" value="1">
          <p class="fields">
            URL<br>
            <input type="text" class="add-menu-url" name="url" placeholder="http://">
          </p>
          <p class="fields">
            Title<br>
            <input type="text" class="add-menu-title" name="title" placeholder="Home">
          </p>
          <p class="fields">
            Class<br>
            <input type="text" class="add-menu-class" name="class" placeholder="CSS Class">
          </p>
          <p>
            <a type="submit" class="button small add-item" href='#'><span class="glyph plus2"></span>Add</a>
            <img src="<?php echo $baseUrl . '/img/waiting.gif'; ?>" class="waiting" />
          </p>
        </div>
      </form>
    </div>
  </div>

  <div class="box">
    <div class="box-header">
      <h1>Category</h1>
    </div>

    <div class="box-content">
      <form action="<?php echo $this->createUrl('create') ?>" id="add-category-menu" class="add-fixed-menu" data-type="category">
        <div class="add-menu-item" id="add-menu-category">
          <input type="hidden" name="additem" value="1">
          <input type="hidden" name="menu_id" value="1">
          <p class="fields">
            Categories<br>
            <select class="chzn-select" data-placeholder="Choose a Categories" name="item" multiple="multiple" id="category">
              <?php foreach ($categories as $cat) : ?>
                <option value="<?php echo $cat->id; ?>"><?php echo $cat->name ?></option>
              <?php endforeach ?>
            </select>
          </p>
          <p class="fields">
            Navigation Label<br>
            <input type="text" id="category-menu-title" class="add-menu-title" name="title" placeholder="Home">
          </p>
          <p class="fields">
            Slug<br>
            <input type="text" id="category-menu-slug" class="add-menu-slug" name="slug" placeholder="Slug">
          </p>
          <p class="fields">
            Class<br>
            <input type="text" id="category-menu-class" class="add-menu-class" name="class" placeholder="CSS Class">
          </p>
          <p>
            <a type="submit" class="button small add-item" href='#'><span class="glyph plus2"></span>Add</a>
            <img src="<?php echo $baseUrl . '/img/waiting.gif'; ?>" class="waiting" />
          </p>
        </div>
      </form>
    </div>
  </div>

  <div class="box">
    <div class="box-header">
      <h1>Brand</h1>
    </div>

    <div class="box-content">
      <form action="<?php echo $this->createUrl('create') ?>" id="add-brand-menu" class="add-fixed-menu" data-type="brand">
        <div class="add-menu-item" id="add-menu-brand">
          <input type="hidden" name="additem" value="1">
          <input type="hidden" name="menu_id" value="1">
          <p class="fields">
            Brand<br>
            <select class="chzn-select" data-placeholder="Choose a Brand" name="item" id="brand">
              <?php foreach ($brands as $cat) : ?>
              <option value="<?php echo $cat->id; ?>"><?php echo $cat->name ?></option>
              <?php endforeach ?>
            </select>
          </p>
          <p class="fields">
            Categories (optional)<br>
            <select class="chzn-select" data-placeholder="Choose categories for this Brand" name="item" multiple="multiple" id="brand-category">
              <?php foreach ($categories as $cat) : ?>
              <option value="<?php echo $cat->id; ?>"><?php echo $cat->name ?></option>
              <?php endforeach ?>
            </select>
          </p>
          <p class="fields">
            Navigation Label<br>
            <input type="text" id="brand-menu-title" class="add-menu-title" name="title" placeholder="Home">
          </p>
          <p class="fields">
            Slug<br>
            <input type="text" id="brand-menu-slug" class="add-menu-slug" name="slug" placeholder="Slug">
          </p>
          <p class="fields">
            Class<br>
            <input type="text" id="brand-menu-class" class="add-menu-class" name="class" placeholder="CSS Class">
          </p>
          <p>
            <a type="submit" class="button small add-item" href='#'><span class="glyph plus2"></span>Add</a>
            <img src="<?php echo $baseUrl . '/img/waiting.gif'; ?>" class="waiting" />
          </p>
        </div>
      </form>
    </div>
  </div>

</div>

<div class="column-right">
  <div class="box">
    <form action="<?php echo $this->createUrl('update', array('id' => $menu->id)) ?>" method="post" id="edit-custom-menu">
      <div class="box-header">

        <div class="menu-actions">
          <a class="delete" href="#">Delete Menu</a>
          <a class="submitdelete" href="<?php echo $this->createUrl('delete', array('id' => $menu->id)) ?>">Confirm</a>
        </div>

        <h1 id="menu-name"><?php echo $menu->title ?></h1>

        <input type="hidden" id="edit-menu-id" name="menu[id]" value="<?php echo $menu->id ?>">
        <input type="text" id="edit-menu-name" class="widefat code edit-menu-item-url" name="menu[title]" value="<?php echo $menu->title ?>" style="display: none;">
        <input type="hidden" id="edit-menu-structure" name="menu[structure]" value="<?php echo $menu->structure ?>">

      </div>

      <div class="box-content all-menus">

        <?php echo $menu->render(false); ?>

        <div class="action_bar">
          <input type="submit" class="button blue" value="Save" />
          or
          <a href="<?php echo $this->createUrl('update', array('id' => $menu->id)) ?>">Cancel</a>
        </div>
      </div>
    </form>
  </div>
</div>

<script id="add-custom-menu-template" type="text/x-jquery-tmpl">
  <li class="menu-item" id="menu-${id}">
    <div class="header"><span class="title">${title}</span><span class="newtitle"></span><a href="#"><span class="glyph down"></span><span class="glyph up" style="display: none;"></span></a></div>
    <input type="hidden" name="item[id][${id}]" value="${id}">
    <div class="menu-item-settings newly-added" id="menu-item-settings-${id}">
      <p class="fields">
        <label for="edit-menu-item-url-${id}">
          URL<br>
          <input type="text" id="edit-menu-item-url-${id}" class="widefat code edit-menu-item-url" name="item[url][${id}]" value="${url}" data-origin="${url}">
        </label>
      </p>
      <p class="fields">
        <label for="edit-menu-item-title-${id}">
          Navigation Label<br>
          <input type="text" id="edit-menu-item-title-${id}" class="widefat edit-menu-item-title" name="item[title][${id}]" value="${title}" data-origin="${title}">
        </label>
      </p>
      <p class="fields">
        <label for="edit-menu-item-class-${id}">
          Class<br>
          <input type="text" id="edit-menu-item-class-${id}" class="widefat edit-menu-item-class" name="item[url_params][${id}][class]" value="${classs}" data-origin="${classs}">
        </label>
      </p>

      <div class="menu-item-actions">
        <a class="delete" href="#">Remove</a>
        <a class="submitdelete" id="delete-${id}" href="<?php echo $this->createUrl('delete') ?>" data-id="${id}">Confirm</a>
        <span class="meta-sep"> | </span>
        <a class="submitcancel" id="cancel-${id}" href="#">Cancel</a>
        <img src="<?php echo $baseUrl . '/img/waiting.gif'; ?>" class="waiting" />
      </div>
    </div>
  </li>
</script>

<script id="add-fixed-menu-template" type="text/x-jquery-tmpl">
  <li class="menu-item" id="menu-${id}">
    <div class="header"><span class="title">${title}</span><span class="newtitle"></span><a href="#"><span class="glyph down"></span><span class="glyph up" style="display: none;"></span></a></div>
    <input type="hidden" name="item[id][${id}]" value="${id}">
    <input type="hidden" name="item[url_params][${id}][module]" value="${type}">
    <div class="menu-item-settings newly-added" id="menu-item-settings-${id}">
      <p class="fields">
      <dl>
        <dt>Type: </dt>
        <dd>${type}</dd>
        <dt>Item ID: </dt>
        <dd></dd>
      </dl>
      </p>
      <p class="fields">
        <label for="edit-menu-item-title-${id}">
          Navigation Label<br>
          <input type="text" id="edit-menu-item-title-${id}" class="widefat edit-menu-item-title" name="item[title][${id}]" value="${title}" data-origin="${title}">
        </label>
      </p>
      <p class="fields">
        <label for="edit-menu-item-slug-${id}">
          Slug<br>
          <input type="text" id="edit-menu-item-slug-${id}" class="widefat edit-menu-item-title" name="item[url_params][${id}][slug]" value="${slug}" data-origin="${slug}">
        </label>
      </p>
      <p class="fields">
        <label for="edit-menu-item-class-${id}">
          Class<br>
          <input type="text" id="edit-menu-item-class-${id}" class="widefat edit-menu-item-title" name="item[url_params][${id}][class]" value="${classs}" data-origin="${classs}">
        </label>
      </p>

      <div class="menu-item-actions">
        <a class="delete" href="#">Remove</a>
        <a class="submitdelete" id="delete-${id}" href="<?php echo $this->createUrl('delete'); ?>" data-id="${id}">Confirm</a>
        <span class="meta-sep"> | </span>
        <a class="submitcancel" id="cancel-${id}" href="#">Cancel</a>
        <img src="<?php echo $baseUrl . '/img/waiting.gif'; ?>" class="waiting" />
      </div>
    </div>
  </li>
</script>