<?php

/**
 * This is the model class for table "menus".
 *
 * The followings are the available columns in table 'menus':
 * @property integer $id
 * @property string $title
 * @property string $struture
 *
 * The followings are the available model relations:
 * @property MenuItem[] $menuItems
 */
class Menu extends Model
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Menu the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'menus';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title', 'length', 'max'=>255),
			array('structure', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, struture', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'menuItems' => array(self::HAS_MANY, 'MenuItem', 'menu_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Title',
			'struture' => 'Struture',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('struture',$this->struture,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

  public function render($frontend = true) {
    $structure = $this->structure;
    if (!is_object($this->structure)) $structure = json_decode($this->structure, true);

    $children = array();
    foreach ($this->menuItems as $item) {
      $children[$item->id] = $item;
    }

    $result = '<ul class="sortable menus">';
    $result .= $this->renderList($structure, $children, $frontend);

    //Orphans, items does not present in structure
    foreach ($children as $item) {
      $params = json_decode($item->url_params);

      $result .= '<li class="menu-item' . (!empty($params->class) ? " {$params->class}" : '') . '" id="menu-' . $item->id . '">';
      if ($frontend) {
        $result .= self::getItem($item);
      } elseif (empty($item->url)){
        $result .= self::getFixedItem($item);
      } else {
        $result .= self::getCustomItem($item);
      }
      $result .= '</li>';
    }
    $result .= '</ul>';

    return $result;
  }

  private function renderList ($structure, &$items = array(), $frontend = true, $depth = 0) {
    if ($structure == '') return '';
    $result = '';
    $depth++;

    foreach ($structure as $s) {
      if (!isset($items[$s['id']])) { //Menu item not found, should not happen
        if (!empty($s['children'])) { //This item still has children
          $result .= $this->renderList($s['children'], $items);
        }
        continue;
      }

      $item = $items[$s['id']];
      $params = json_decode($item->url_params);
      $class = empty($s['children']) ? "menu-item" : "menu-item parent";
      $class .= !empty($params->class) ? " {$params->class}" : '';
//      $class .= self::getCurrentClass($params);

      $result .= '<li class="'.$class.'" id="menu-' . $item->id . '">';
      if ($frontend) {
        $result .= $this->getItem($item);
      } elseif (empty($item->url)){
        $result .= $this->getFixedItem($item);
      } else {
        $result .= $this->getCustomItem($item);
      }
      unset($items[$s['id']]); //Remove rendered item

      if (!empty($s['children'])) {
        $result .= '<ul class="sub-menu sub-menu-level-' . $depth . '">';
        $result .= $this->renderList($s['children'], $items, $frontend, $depth);
        $result .= '</ul>';
      }

      $result .= '</li>';
    }

    return $result;
  }

  private function getItem ($item) {
    if (!empty($item->url_params) && ($params = json_decode($item->url_params)) && !empty($params->module)) {
      if (is_array($params->item)) {
        $params->item = implode(',', $params->item);
      }
      $url = Yii::app()->urlManager->createUrl('/' . $params->module . '/' . $params->slug, array('id' => $params->item));
    } else {
      $url = $item->url;
    }

    return "<a href='{$url}'>{$item->title}</a>";
  }

  private function getFixedItem ($item) {
    $deleleUrl = Yii::app()->urlManager->createUrl('admin/menu/delete');
    $waitingUrl = Yii::app()->urlManager->baseUrl . '/themes/admin/assets/img/waiting.gif';
    $params = json_decode($item->url_params);
    $itemInput = '';
    foreach ($params->item as $item_id) {
      $itemInput .= "<input type='hidden' name='item[url_params][".$item->id."][item][]' value=".$item_id.">";
    }
    $params->item = implode(', ', $params->item);
    return
<<< fuck
<div class="header"><span class="title">{$item->title}</span><span class="newtitle"></span><a href="#"><span class="glyph down"></span><span class="glyph up" style="display: none;"></span></a></div>
<input type="hidden" name="item[id][{$item->id}]" value="{$item->id}">
<input type="hidden" name="item[url_params][{$item->id}][module]" value="{$params->module}">
{$itemInput}
<div class="menu-item-settings" id="menu-item-settings-{$item->id}">
  <p class="fields">
    <dl>
      <dt>Type: </dt>
      <dd>{$params->module}</dd>
      <dt>Item ID: </dt>
      <dd>{$params->item}</dd>
    </dl>
  </p>
  <p class="fields">
    <label for="edit-menu-item-title-{$item->id}">
      Navigation Label<br>
      <input type="text" id="edit-menu-item-title-{$item->id}" class="widefat edit-menu-item-title" name="item[title][{$item->id}]" value="{$item->title}" data-origin="{$item->title}">
    </label>
  </p>
  <p class="fields">
    <label for="edit-menu-item-slug-{$item->id}">
      Slug<br>
      <input type="text" id="edit-menu-item-slug-{$item->id}" class="widefat edit-menu-item-slug" name="item[url_params][{$item->id}][slug]" value="{$params->slug}" data-origin="{$params->slug}">
    </label>
  </p>
  <p class="fields">
    <label for="edit-menu-item-class-{$item->id}">
      CSS Class<br>
      <input type="text" id="edit-menu-item-class-{$item->id}" class="widefat edit-menu-item-class" name="item[url_params][{$item->id}][class]" value="{$params->class}" data-origin="{$params->class}">
    </label>
  </p>

  <div class="menu-item-actions">
    <a class="delete" href="#">Remove</a>
    <a class="submitdelete" id="delete-{$item->id}" href="{$deleleUrl}" data-id="{$item->id}">Confirm</a>
    <span class="meta-sep"> | </span>
    <a class="submitcancel" id="cancel-{$item->id}" href="#">Cancel</a>
  <img src="{$waitingUrl}" class="waiting" />
  </div>
</div>
fuck;
  }

  private function getCustomItem ($item) {
    $deleleUrl = Yii::app()->urlManager->createUrl('admin/menu/delete');
    $waitingUrl = Yii::app()->urlManager->baseUrl . '/themes/admin/assets/img/waiting.gif';
    $params = json_decode($item->url_params);
    return
<<< fuck
<div class="header"><span class="title">{$item->title}</span><span class="newtitle"></span><a href="#"><span class="glyph down"></span><span class="glyph up" style="display: none;"></span></a></div>
<input type="hidden" name="item[id][{$item->id}]" value="{$item->id}">
<div class="menu-item-settings" id="menu-item-settings-{$item->id}">
  <p class="fields">
    <label for="edit-menu-item-url-{$item->id}">
      URL<br>
      <input type="text" id="edit-menu-item-url-{$item->id}" class="widefat code edit-menu-item-url" name="item[url][{$item->id}]" value="{$item->url}" data-origin="{$item->url}">
    </label>
  </p>
  <p class="fields">
    <label for="edit-menu-item-title-{$item->id}">
      Navigation Label<br>
      <input type="text" id="edit-menu-item-title-{$item->id}" class="widefat edit-menu-item-title" name="item[title][{$item->id}]" value="{$item->title}" data-origin="{$item->title}">
    </label>
  </p>
  <p class="fields">
    <label for="edit-menu-item-class-{$item->id}">
      CSS Class<br>
      <input type="text" id="edit-menu-item-class-{$item->id}" class="widefat edit-menu-item-class" name="item[url_params][{$item->id}][class]" value="{$params->class}" data-origin="{$params->class}">
    </label>
  </p>

  <div class="menu-item-actions">
    <a class="delete" href="#">Remove</a>
    <a class="submitdelete" id="delete-{$item->id}" href="{$deleleUrl}" data-id="{$item->id}">Confirm</a>
    <span class="meta-sep"> | </span>
    <a class="submitcancel" id="cancel-{$item->id}" href="#">Cancel</a>
  <img src="{$waitingUrl}" class="waiting" />
  </div>
</div>
fuck;
  }

  private function getCurrentClass($params) {
    $class = '';

    if (!empty($params->module)) {
      if (is_array($params->item)) {
        $params->item = implode('%2c', $params->item);  // , (comma) character
      }

      if (Yii::app()->getController()->id == 'product' && $params->module == 'category') {
        $product = self::$currentProduct;
        if ($product->found()) {
          if (strstr($params->item, $product->data()->category->_id)) {
            $class = ' current-item';
          } else {
            $i = 0;
            foreach ($product->data()->category->ancestors as $anc) {
              $i++;
              if (strstr($params->item, $anc)) {
                $class = ' current-ancestor current-ancestor-level-' . $i;
              }
            }
          }
        }

      } elseif (Yii::app()->getController()->id == 'category' && $params->module == 'category') {
        $response = self::$currentTaxonomy;
        if ($response->code == 200) {
          foreach ($response->content->data as $data) {
            if (strstr($params->item, $data->_id)) {
              $class = ' current-item';
            } else {
              $i = 0;
              foreach ($data->ancestors as $anc) {
                $i++;
                if (strstr($params->item, $anc)) {
                  $class = ' current-ancestor current-ancestor-level-' . $i;
                }
              }
            }
          }
        }

      } else {
        if (strstr($_SERVER["REQUEST_URI"], $params->item)) $class = ' current-item';
      }
    }

    return $class;
  }
}