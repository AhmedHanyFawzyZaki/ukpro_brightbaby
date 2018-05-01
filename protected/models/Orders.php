<?php

/**
 * This is the model class for table "orders".
 *
 * The followings are the available columns in table 'orders':
 * @property integer $id
 * @property string $price
 * @property integer $user_id
 * @property string $email
 * @property integer $status
 * @property string $order_date
 * @property string $token
 * @property integer $payer_id
 * @property string $s_title
 * @property string $discount_id
 * @property string $s_fname
 * @property string $s_lname
 * @property string $s_zipcode
 * @property string $s_city
 * @property integer $s_country_id
 * @property string $s_phone_evening
 * @property string $s_phone_day
 * @property string $b_title
 * @property string $b_address
 * @property string $b_address2
 * @property integer $b_country_id
 * @property string $b_fname
 * @property string $b_lname
 * @property string $b_zipcode
 * @property string $b_city
 * @property string $b_phone_day
 * @property string $b_phone_evening
 *
 * The followings are the available model relations:
 * @property OrderAddress[] $orderAddresses
 * @property OrderAddressCopy[] $orderAddressCopies
 */
class Orders extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Orders the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'orders';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('user_id, status, payer_id, s_country_id, b_country_id, notif', 'numerical', 'integerOnly' => true),
            array('price, email, order_date, token, s_title, s_fname, s_lname, s_city, s_phone_evening, s_phone_day, b_title, b_address, b_address2, s_address, s_address2, b_fname, b_lname, b_zipcode, b_city, b_phone_day, b_phone_evening, pay_id', 'length', 'max' => 255),
            array('discount_id, s_zipcode', 'length', 'max' => 50),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('discount_val, postage_val', 'safe'),
            array('id, price, user_id, email, status, order_date, token, payer_id, s_title, discount_id, s_fname, s_lname, s_zipcode, s_city, s_country_id, s_phone_evening, s_phone_day, b_title, b_address, b_address2,s_address, s_address2, b_country_id, b_fname, b_lname, b_zipcode, b_city, b_phone_day, b_phone_evening', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'orderAddresses' => array(self::HAS_MANY, 'OrderAddress', 'order_id'),
            'orderAddressCopies' => array(self::HAS_MANY, 'OrderAddressCopy', 'order_id'),
            'statuss' => array(self::BELONGS_TO, 'OrderStatus', 'status'),
            'user' => array(self::BELONGS_TO, 'User', 'user_id'),
            'ShippingUserCountry' => array(self::BELONGS_TO, 'Countries', 's_country_id'),
            'BillingUserCountry' => array(self::BELONGS_TO, 'Countries', 'b_country_id'),
            'discountpercentage' => array(self::BELONGS_TO, 'Discount', 'discount_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'price' => 'Price',
            'user_id' => 'User',
            'email' => 'Email',
            'status' => 'Status',
            'order_date' => 'Order Date',
            'token' => 'Token',
            'payer_id' => 'Payer',
            's_title' => 'Shipping Title',
            'discount_id' => 'Discount',
            's_fname' => 'Shipping First Name',
            's_lname' => 'Shipping Last Name',
            's_zipcode' => 'Shipping Zipcode',
            's_city' => 'Shipping City',
            's_country_id' => 'Shipping Country',
            's_phone_evening' => 'Shipping Phone Evening',
            's_phone_day' => 'Shipping Phone Day',
            'b_title' => 'Billing Title',
            'b_address' => 'Billing Address',
            'b_address2' => 'Billing Address2',
            's_address' => 'Shipping Address',
            's_address2' => 'Shipping Address2',
            'b_country_id' => 'Billing Country',
            'b_fname' => 'Billing First Name',
            'b_lname' => 'Billing Last Name',
            'b_zipcode' => 'Billing Zipcode',
            'b_city' => 'Billing City',
            'b_phone_day' => 'Billing Phone Day',
            'b_phone_evening' => 'Billing Phone Evening',
            'pay_id' => 'Pay Id',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;
        $criteria->order = 'id DESC';

        $criteria->compare('id', $this->id);
        $criteria->compare('price', $this->price, true);
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('status', $this->status);
        $criteria->compare('order_date', $this->order_date, true);
        $criteria->compare('token', $this->token, true);
        $criteria->compare('payer_id', $this->payer_id);
        $criteria->compare('s_title', $this->s_title, true);
        $criteria->compare('discount_id', $this->discount_id, true);
        $criteria->compare('s_fname', $this->s_fname, true);
        $criteria->compare('s_lname', $this->s_lname, true);
        $criteria->compare('s_zipcode', $this->s_zipcode, true);
        $criteria->compare('s_city', $this->s_city, true);
        $criteria->compare('s_country_id', $this->s_country_id);
        $criteria->compare('s_phone_evening', $this->s_phone_evening, true);
        $criteria->compare('s_phone_day', $this->s_phone_day, true);
        $criteria->compare('b_title', $this->b_title, true);
        $criteria->compare('b_address', $this->b_address, true);
        $criteria->compare('b_address2', $this->b_address2, true);
        $criteria->compare('s_address', $this->s_address, true);
        $criteria->compare('s_address2', $this->s_address2, true);
        $criteria->compare('b_country_id', $this->b_country_id);
        $criteria->compare('b_fname', $this->b_fname, true);
        $criteria->compare('b_lname', $this->b_lname, true);
        $criteria->compare('b_zipcode', $this->b_zipcode, true);
        $criteria->compare('b_city', $this->b_city, true);
        $criteria->compare('b_phone_day', $this->b_phone_day, true);
        $criteria->compare('b_phone_evening', $this->b_phone_evening, true);
        $criteria->compare('pay_id', $this->pay_id, true);

        $criteria->order = "id DESC";

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function getTitleValue($value) {
        if ($value == 1) {
            return 'Mr';
        } elseif ($value == 2) {
            return 'Mrs';
        } elseif ($value == 3) {
            return 'Miss';
        } else {
            return 'Dr';
        }
    }

}