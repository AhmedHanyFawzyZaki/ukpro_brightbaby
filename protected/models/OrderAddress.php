<?php

/**
 * This is the model class for table "order_address".
 *
 * The followings are the available columns in table 'order_address':
 * @property integer $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $company
 * @property string $address
 * @property string $address2
 * @property string $city
 * @property string $state
 * @property string $post_code
 * @property integer $country_id
 * @property string $phone
 * @property string $fax
 * @property integer $order_id
 * @property integer $user_id
 * @property integer $flag
 * @property string $phone_day
 * @property string $phone_evening
 *
 * The followings are the available model relations:
 * @property User $user
 * @property Orders $order
 */
class OrderAddress extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return OrderAddress the static model class
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
		return 'order_address';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('country_id, order_id, user_id, flag', 'numerical', 'integerOnly'=>true),
			array('first_name, last_name, email, company, address, address2, city, state, post_code, phone, fax', 'length', 'max'=>255),
			array('phone_day, phone_evening', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, first_name, last_name, email, company, address, address2, city, state, post_code, country_id, phone, fax, order_id, user_id, flag, phone_day, phone_evening', 'safe', 'on'=>'search'),
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
			'order' => array(self::BELONGS_TO, 'Orders', 'order_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'first_name' => 'First Name',
			'last_name' => 'Last Name',
			'email' => 'Email',
			'company' => 'Company',
			'address' => 'Address',
			'address2' => 'Address2',
			'city' => 'City',
			'state' => 'State',
			'post_code' => 'Post Code',
			'country_id' => 'Country',
			'phone' => 'Phone',
			'fax' => 'Fax',
			'order_id' => 'Order',
			'user_id' => 'User',
			'flag' => 'Flag',
			'phone_day' => 'Phone Day',
			'phone_evening' => 'Phone Evening',
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
		$criteria->compare('first_name',$this->first_name,true);
		$criteria->compare('last_name',$this->last_name,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('company',$this->company,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('address2',$this->address2,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('state',$this->state,true);
		$criteria->compare('post_code',$this->post_code,true);
		$criteria->compare('country_id',$this->country_id);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('fax',$this->fax,true);
		$criteria->compare('order_id',$this->order_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('flag',$this->flag);
		$criteria->compare('phone_day',$this->phone_day,true);
		$criteria->compare('phone_evening',$this->phone_evening,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}