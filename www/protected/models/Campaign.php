<?php

/**
 * This is the model class for table "campaign".
 *
 * The followings are the available columns in table 'campaign':
 * @property string $id
 * @property string $name
 * @property string $start_time
 * @property string $end_time
 */
class Campaign extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Campaign the static model class
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
		return 'campaign';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
      array('name, start_time, end_time', 'safe', 'on' => 'update_products'),
			array('name', 'length', 'max' => 255),
			array('name, start_time, end_time', 'required', 'on' => 'original_update'),
			array('start_time, end_time', 'date', 'format' => 'yyyy-MM-dd HH:mm:ss', 'on' => 'update_products'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, start_time, end_time', 'safe', 'on'=>'search'),
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
			'CP' => array(self::HAS_MANY, 'CampaignProduct', 'campaign_id'),
      'products' => array(self::MANY_MANY, 'Product', 'campaign_product(campaign_id, product_id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'start_time' => 'Start Time',
			'end_time' => 'End Time',
		);
	}

	function behaviors() {
	  return array(
	    'taggable' => array(
        'class' => 'ext.yiiext-taggable-behavior.ETaggableBehavior',
        // Table where tags are stored
        'tagTable' => 'product',
        // Cross-table that stores tag-model connections.
        // By default it's your_model_tableTag
        'tagBindingTable' => 'campaign_product',
        // Foreign key in cross-table.
        // By default it's your_model_tableId
        'modelTableFk' => 'campaign_id',
        // Tag table PK field
        'tagTablePk' => 'id',
        // Tag name field
        'tagTableName' => 'id',
        // Tag counter field
        // if null (default) does not write tag counts to DB
        // 'tagTableCount' => 'count',
        // Tag binding table tag ID
        'tagBindingTableTagId' => 'product_id',
        // Caching component ID. If false don't use cache.
        // Defaults to false.
        'cacheID' => false,

        // Save nonexisting tags.
        // When false, throws exception when saving nonexisting tag.
        'createTagsAutomatically' => false,
	    )
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('start_time',$this->start_time,true);
		$criteria->compare('end_time',$this->end_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

  public function getProducts()
  {
    return Product::model()->findAllByPk($this->tags);
  }
}