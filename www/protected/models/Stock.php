<?php

/**
 * This is the model class for table "stock".
 *
 * The followings are the available columns in table 'stock':
 * @property string $id
 * @property string $location_id
 * @property string $lotte_id
 * @property string $upc_id
 * @property integer $quantity
 * @property integer $wh_quantity
 * @property string $create_time
 * @property string $update_time
 * @property string $original_code
 * @property string $code
 *
 * The followings are the available model relations:
 * @property Upc $upc
 * @property Location $location
 * @property Lotte $lotte
 * @property StockChange[] $stockChanges
 */
class Stock extends Model
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Stock the static model class
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
		return 'stock';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('original_code, code', 'required'),
			array('quantity', 'numerical', 'integerOnly'=>true),
			array('location_id, lotte_id, upc_id', 'length', 'max'=>11),
			array('original_code, code', 'length', 'max'=>45),
			array('create_time, update_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, location_id, lotte_id, upc_id, quantity, create_time, update_time, original_code, code', 'safe', 'on'=>'search'),
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
			'upc' => array(self::BELONGS_TO, 'Upc', 'upc_id'),
			'location' => array(self::BELONGS_TO, 'Location', 'location_id'),
			'lotte' => array(self::BELONGS_TO, 'Lotte', 'lotte_id'),
			'stockChanges' => array(self::HAS_MANY, 'StockChange', 'stock_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'location_id' => 'Location',
			'lotte_id' => 'Lotte',
			'upc_id' => 'Upc',
			'quantity' => 'Quantity',
			'create_time' => 'Create Time',
			'update_time' => 'Update Time',
			'original_code' => 'Original Code',
			'code' => 'Code',
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
		$criteria->compare('location_id',$this->location_id,true);
		$criteria->compare('lotte_id',$this->lotte_id,true);
		$criteria->compare('upc_id',$this->upc_id,true);
		$criteria->compare('quantity',$this->quantity);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('update_time',$this->update_time,true);
		$criteria->compare('original_code',$this->original_code,true);
		$criteria->compare('code',$this->code,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Change quantity of stock (caution: this funtion has not written with transaction yet, using it wisely)
	 * negative $delta for get
	 * positive $delta for add
	 * @return return stockChange have been created; throw exception if error
	 */
	public function changeQuantity($delta, array $options = array()) {
		if ($delta == 0) {
			throw new CHttpException(400, 'Nothing done here, you b****');
		}
		if (!isset($options['no_transaction'])) {
			$options['no_transaction'] = false;
		}
		if (!$options['no_transaction']) {
			if (Yii::app()->db->getCurrentTransaction() !== null) {
				throw new CHttpException(400, 'Current in other transaction, please check');
			}
			$transaction = Yii::app()->db->beginTransaction();
		}

		if ($this->quantity + $delta < 0) {
			throw new CHttpException(400,'Stock does not have enough quantity');
		}
		try {
			$stockChange = new StockChange;
			$stockChange->stock_id = $this->id;
			$stockChange->delta = $delta;
			$stockChange->description = $options['description'];
			$stockChange->save();
			$this->quantity += $delta;
			$this->save();
			if (!$options['no_transaction']) {
				$transaction->commit();
			}
			return $stockChange;
		} catch (Exception $ex) {
			if (!$options['no_transaction']) {
				$transaction->rollback();
			}
			throw $ex;
		}
	}
}