<?php

/**
 * This is the model class for table "upc".
 *
 * The followings are the available columns in table 'upc':
 * @property string $id
 * @property string $product_id
 * @property string $size_id
 * @property string $pattern_id
 * @property string $create_time
 * @property string $update_time
 * @property string $code
 *
 * The followings are the available model relations:
 * @property CartUpc[] $cartUpcs
 * @property Stock[] $stocks
 * @property Pattern $pattern
 * @property Product $product
 * @property Size $size
 */
class Upc extends Model
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Upc the static model class
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
		return 'upc';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('code', 'required'),
			array('product_id, size_id, pattern_id, quantity', 'length', 'max'=>11),
			array('code', 'length', 'max'=>45),
			array('create_time, update_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, product_id, size_id, quantity, pattern_id, create_time, update_time, code', 'safe', 'on'=>'search'),
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
			'cartUpcs' => array(self::HAS_MANY, 'CartUpc', 'upc_id'),
			'stocks' => array(self::HAS_MANY, 'Stock', 'upc_id'),
			'pattern' => array(self::BELONGS_TO, 'Pattern', 'pattern_id'),
			'product' => array(self::BELONGS_TO, 'Product', 'product_id'),
			'size' => array(self::BELONGS_TO, 'Size', 'size_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'product_id' => 'Product',
			'size_id' => 'Size',
			'quantity' => 'Quantity',
			'pattern_id' => 'Pattern',
			'create_time' => 'Create Time',
			'update_time' => 'Update Time',
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
		$criteria->compare('product_id',$this->product_id,true);
		$criteria->compare('size_id',$this->size_id,true);
		$criteria->compare('quantity',$this->quantity,true);
		$criteria->compare('pattern_id',$this->pattern_id,true);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('update_time',$this->update_time,true);
		$criteria->compare('code',$this->code,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
   * Generate upc code with brand, color, size infomation
   * @return Upc code but not check if it existed
   */
  public static function generateUpc($brand=null, $color=null, $size=null) {
    $upc = (!(empty($brand) && empty($brand->$code)) ? $brand->$code : '---') . (!(empty($color) && empty($color->$code)) ? $color->$code : '---') . (!(empty($size) && empty($size->$code)) ? $size->$code : '--');
    $upc .= strpos($upc,'-') !== false ? '------' : generateCode('', 6);
    return $upc;
  }

	/**
	 * Change quantity of upc (caution: transaction enable default, set option no_transaction=true to disable, using it wisely)
	 * negative $delta for get
	 * positive $delta for add
	 * @return return upcChange have been created; throw exception if error
	 */
	public function changeQuantity($delta, array $options = array()) {
		if ($delta == 0) {
			throw new CHttpException(400, 'Nothing done here, you b****');
		}
		if (!isset($options['no_transaction'])) {
			$options['no_transaction'] = false;
		}
	  if (!isset($options['description'])) {
		  $options['description'] = '';
		}
		if ($this->quantity + $delta < 0) {
			throw new CHttpException(400,'Upc does not have enough quantity');
		}
		if (!$options['no_transaction']) {
			if (Yii::app()->db->getCurrentTransaction() !== null) {
				throw new CHttpException(400, 'Current in other transaction, please check');
			}
			$transaction = Yii::app()->db->beginTransaction();
		}
		try {
			$upcChange = new UpcChange;
			$upcChange->upc_id = $this->id;
			$upcChange->delta = $delta;
			$upcChange->description = $description;
			$upcChange->save();
			$this->quantity += $delta;
			$this->save();
			if (!$options['no_transaction']) {
				$transaction->commit();
			}
			return $upcChange;
		} catch (Exception $ex) {
			if (!$options['no_transaction']) {
				$transaction->rollback();
			}
			throw $ex;
		}
	}

	/**
	 * Get amount of stocks of this upc
	 * for special purposes, please options with:
	 *	no_transaction=true 	disable transaction
	 *	location_id=id 				only get stock from that location
	 *	lotte_id=id 					only get stock from that lotte
	 * @return upcChanges and array of stocks and stockChanges have been effected, return false if error
	 */
	public function getStocks($delta=0, array $options = array()) {
		if ($delta <= 0) {
			if (YII_DEBUG) {
				throw new CHttpException(400, 'Nothing done here you b****');
			}
			return false;
		}

		if (!isset($options['no_transaction'])) {
			$options['no_transaction'] = false;
		}

		if (!$options['no_transaction']) {
			if (Yii::app()->db->getCurrentTransaction() !== null) {
				if (YII_DEBUG) {
					throw new CHttpException(400, 'Current in other transaction, please check');
				}
				return false;
			}
			$transaction = Yii::app()->db->beginTransaction();
		}

		try {
			// change upc quantity
			$upcChange = $this->changeQuantity(-$delta, array('description' => $description, 'no_transaction' => true));

			$condition = 'upc_id=:upc_id and quantity > :quantity';
			$params = array(':upc_id'=> $this->id, ':quantity' => 0);
			if (isset($options['location_id'])) {
				$condition .= ' and location_id=:location_id';
				$params[':location_id'] = $options['location_id'];
			}
			if (isset($options['lotte_id'])) {
				$condition .= ' and lotte_id=:lotte_id';
				$params[':lotte_id'] = $options['location_id'];
			}

			$stockData = Stock::model()->findAll(array(
				'with' => array('lotte', 'location'),
	      'condition' => $condition,
	      'params' => $params,
	      'order'=>'lotte.lotte_num',
    	));

    	// echo '<pre>';

    	// get stock and change stock quantity
  		$stocks = array();
  		$stockChanges = array();

    	foreach ($stockData as $value) {
    		// print_r($delta . '<br>');
    		$cur_delta = 0;
    		if ($value->quantity > $delta) {
    			$cur_delta = $delta;
    			$delta = 0;
    		} else {
    			$cur_delta = $value->quantity;
    			$delta -= $value->quantity;
    		}

    		// print_r($value->code . ' ' . $stocks->quantity . ' ' . -$cur_delta . '<br>');

    		$stockChange = $value->changeQuantity(-$cur_delta, array('description' => $description, 'no_transaction' => true));
  			array_push($stocks, $value);
  			array_push($stockChanges, $stockChange);
    		if ($delta == 0) {
    			break;
    		}
    	}

    	// echo '</pre>';
    	// die('');
    	if ($delta != 0) {
				throw new CHttpException(400, 'Out of stock!');
  		}

  		if (!$options['no_transaction']) {
				$transaction->commit();
			}
			return compact('upcChange', 'stocks', 'stockChanges');
		} catch (Exception $ex) {
			if (!$options['no_transaction']) {
				$transaction->rollback();
			}
			if (YII_DEBUG) {
				throw $ex;
			}
		}
		return false;
	}
}