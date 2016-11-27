<?php

/**
 * This is the model class for table "menu_items".
 *
 * The followings are the available columns in table 'menu_items':
 * @property integer $id
 * @property integer $menu_id
 * @property string $title
 * @property string $url_params
 * @property string $url
 * @property string $metadata
 *
 * The followings are the available model relations:
 * @property Menus $menu
 */
class MenuItem extends Model
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MenuItem the static model class
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
		return 'menu_items';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('menu_id', 'required'),
			array('menu_id', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>255),
			array('url_params, url, metadata', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, menu_id, title, url_params, url, metadata', 'safe', 'on'=>'search'),
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
			'menu' => array(self::BELONGS_TO, 'Menu', 'menu_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'menu_id' => 'Menu',
			'title' => 'Title',
			'url_params' => 'Url Params',
			'url' => 'Url',
			'metadata' => 'Metadata',
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
		$criteria->compare('menu_id',$this->menu_id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('url_params',$this->url_params,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('metadata',$this->metadata,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}