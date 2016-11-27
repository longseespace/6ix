<?php

/**
 * This is the model class for table "cart".
 *
 * The followings are the available columns in table 'cart':
 * @property string $id
 * @property string $user_id
 * @property string $session_id
 * @property string $order_code
 * @property integer $price
 * @property integer $real_price
 * @property integer $cod_fee
 * @property integer $discount
 * @property string $expire
 * @property string $ship_fullname
 * @property string $ship_email
 * @property integer $ship_gender
 * @property string $ship_address
 * @property string $ship_mobile
 * @property string $ship_city
 * @property string $bill_fullname
 * @property string $bill_email
 * @property integer $bill_gender
 * @property string $bill_address
 * @property string $bill_mobile
 * @property string $bill_city
 * @property integer $bank_id
 * @property string $payment_method
 * @property string $payment_id
 * @property string $note
 * @property integer $status
 * @property string $create_time
 * @property string $modifie_time
 *
 * The followings are the available model relations:
 * @property User $user
 * @property CartCoupon[] $cartCoupons
 * @property CartUpc[] $cartUpcs
 */
class Cart extends Model
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Cart the static model class
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
		return 'cart';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('price, real_price, cod_fee, discount, ship_gender, bill_gender, bank_id, status', 'numerical', 'integerOnly'=>true),
			array('user_id', 'length', 'max'=>11),
			array('session_id, ship_fullname, ship_email, bill_fullname, bill_email', 'length', 'max'=>255),
			array('order_code, ship_mobile, ship_city, bill_mobile, bill_city, payment_method', 'length', 'max'=>31),
			array('payment_id', 'length', 'max'=>63),
			array('expire, ship_address, bill_address, note, create_time, modifie_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, session_id, order_code, price, real_price, cod_fee, discount, expire, ship_fullname, ship_email, ship_gender, ship_address, ship_mobile, ship_city, bill_fullname, bill_email, bill_gender, bill_address, bill_mobile, bill_city, bank_id, payment_method, payment_id, note, status, create_time, modifie_time', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
			'cartCoupons' => array(self::HAS_MANY, 'CartCoupon', 'cart_id'),
			'cartUpcs' => array(self::HAS_MANY, 'CartUpc', 'cart_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'User',
			'session_id' => 'Session',
			'order_code' => 'Order Code',
			'price' => 'Price',
			'real_price' => 'Real Price',
			'cod_fee' => 'Cod Fee',
			'discount' => 'Discount',
			'expire' => 'Expire',
			'ship_fullname' => 'Ship Fullname',
			'ship_email' => 'Ship Email',
			'ship_gender' => 'Ship Gender',
			'ship_address' => 'Ship Address',
			'ship_mobile' => 'Ship Mobile',
			'ship_city' => 'Ship City',
			'bill_fullname' => 'Bill Fullname',
			'bill_email' => 'Bill Email',
			'bill_gender' => 'Bill Gender',
			'bill_address' => 'Bill Address',
			'bill_mobile' => 'Bill Mobile',
			'bill_city' => 'Bill City',
			'bank_id' => 'Bank',
			'payment_method' => 'Payment Method',
			'payment_id' => 'Payment',
			'note' => 'Note',
			'status' => 'Status',
			'create_time' => 'Create Time',
			'modifie_time' => 'Modifie Time',
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
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('session_id',$this->session_id,true);
		$criteria->compare('order_code',$this->order_code,true);
		$criteria->compare('price',$this->price);
		$criteria->compare('real_price',$this->real_price);
		$criteria->compare('cod_fee',$this->cod_fee);
		$criteria->compare('discount',$this->discount);
		$criteria->compare('expire',$this->expire,true);
		$criteria->compare('ship_fullname',$this->ship_fullname,true);
		$criteria->compare('ship_email',$this->ship_email,true);
		$criteria->compare('ship_gender',$this->ship_gender);
		$criteria->compare('ship_address',$this->ship_address,true);
		$criteria->compare('ship_mobile',$this->ship_mobile,true);
		$criteria->compare('ship_city',$this->ship_city,true);
		$criteria->compare('bill_fullname',$this->bill_fullname,true);
		$criteria->compare('bill_email',$this->bill_email,true);
		$criteria->compare('bill_gender',$this->bill_gender);
		$criteria->compare('bill_address',$this->bill_address,true);
		$criteria->compare('bill_mobile',$this->bill_mobile,true);
		$criteria->compare('bill_city',$this->bill_city,true);
		$criteria->compare('bank_id',$this->bank_id);
		$criteria->compare('payment_method',$this->payment_method,true);
		$criteria->compare('payment_id',$this->payment_id,true);
		$criteria->compare('note',$this->note,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('modifie_time',$this->modifie_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}