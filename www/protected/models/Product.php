<?php

/**
 * This is the model class for table "product".
 *
 * The followings are the available columns in table 'product':
 * @property string $id
 * @property string $brand_id
 * @property string $category_id
 * @property string $name
 * @property string $slug
 * @property string $description
 * @property string $about
 * @property string $size_guide
 * @property string $pcode
 * @property string $original_style
 * @property integer $price_retail
 * @property integer $price_sell
 * @property integer $featured
 * @property integer $status
 * @property string $create_time
 * @property string $update_time
 * @property double $cost
 *
 * The followings are the available model relations:
 * @property Category $category
 * @property Brand $brand
 * @property ProductImage[] $productImages
 * @property Tag[] $tags
 * @property Upc[] $upcs
 */
class Product extends Model
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Product the static model class
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
		return 'product';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('price_retail, price_sell, featured, status', 'numerical', 'integerOnly'=>true),
			array('cost', 'numerical'),
			array('brand_id, category_id', 'length', 'max'=>11),
			array('name, slug', 'length', 'max'=>255),
			array('pcode, original_style', 'length', 'max'=>63),
			array('description, about, size_guide, create_time, update_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, brand_id, category_id, name, slug, description, about, size_guide, pcode, original_style, price_retail, price_sell, featured, status, create_time, update_time, cost', 'safe', 'on'=>'search'),
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
			'category' => array(self::BELONGS_TO, 'Category', 'category_id'),
			'brand' => array(self::BELONGS_TO, 'Brand', 'brand_id'),
			'productImages' => array(self::HAS_MANY, 'ProductImage', 'product_id'),
			'tags' => array(self::MANY_MANY, 'Tag', 'product_tag(product_id, tag_id)'),
			'upcs' => array(self::HAS_MANY, 'Upc', 'product_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'brand_id' => 'Brand',
			'category_id' => 'Category',
			'name' => 'Name',
			'slug' => 'Slug',
			'description' => 'Description',
			'about' => 'About',
			'size_guide' => 'Size Guide',
			'pcode' => 'Pcode',
			'original_style' => 'Original Style',
			'price_retail' => 'Price Retail',
			'price_sell' => 'Price Sell',
			'featured' => 'Featured',
			'status' => 'Status',
			'create_time' => 'Create Time',
			'update_time' => 'Update Time',
			'cost' => 'Cost',
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
		$criteria->compare('brand_id',$this->brand_id,true);
		$criteria->compare('category_id',$this->category_id,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('slug',$this->slug,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('about',$this->about,true);
		$criteria->compare('size_guide',$this->size_guide,true);
		$criteria->compare('pcode',$this->pcode,true);
		$criteria->compare('original_style',$this->original_style,true);
		$criteria->compare('price_retail',$this->price_retail);
		$criteria->compare('price_sell',$this->price_sell);
		$criteria->compare('featured',$this->featured);
		$criteria->compare('status',$this->status);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('update_time',$this->update_time,true);
		$criteria->compare('cost',$this->cost);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

  public function behaviors() {
    return array(
      'slugBehavior' => array(
        'class' => 'application.models.behaviors.SlugBehavior',
      )
    );
  }
}