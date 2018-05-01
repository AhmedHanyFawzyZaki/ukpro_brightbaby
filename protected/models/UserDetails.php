<?php

/**
 * This is the model class for table "user_details".
 *
 * The followings are the available columns in table 'user_details':
 * @property integer $id
 * @property integer $user_id
 * @property integer $company_id
 * @property string $state
 * @property string $county
 * @property string $address
 * @property string $address2
 * @property string $zipcode
 * @property string $lng
 * @property string $lat
 * @property integer $zoom
 * @property string $created
 * @property string $last_login
 * @property string $available_range
 * @property string $phone_no
 * @property string $fax_no
 * @property string $hear_from
 * @property integer $remote_trainig
 * @property integer $accept_leads
 * @property string $country_id
 * @property string $city
 * @property integer $phone_type
 *
 * The followings are the available model relations:
 * @property User[] $users
 * @property PhoneType $phoneType
 */
class UserDetails extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UserDetails the static model class
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
		return 'user_details';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id', 'numerical', 'integerOnly'=>true),
			array('state, county, country_id, city', 'length', 'max'=>90),
			array('address, address2,phone_no,', 'length', 'max'=>255),
			array('zipcode', 'length', 'max'=>50),

			array('s_fname,s_lname,s_country_id,s_address,s_city,s_zipcode,s_title','required','message'=>'Please fill in your {attribute}.','on'=>'editshipping'),
			//array('b_fname,b_lname,b_country_id,b_address,b_city,b_zipcode,b_title','required','message'=>'Please fill in your {attribute}.','on'=>'editbilling'),

			array('created, last_login,s_title,s_address,s_address2,s_country_id,s_city,s_fname,s_lname,s_zipcode,s_phone_day,s_phone_evening,b_title,b_address,b_address2,b_country_id,b_city,b_fname,b_lname,b_zipcode,b_phone_day,b_phone_evening', 'safe'),

			array('s_fname,s_lname,s_country_id,s_address,s_city,s_zipcode,s_title,b_fname,b_lname,b_country_id,b_address,b_city,b_zipcode,b_title','required','message'=>'Please fill in your {attribute}.'),
			/*array('b_fname,b_lname,b_country_id,b_address,b_city,b_zipcode,b_title','required','message'=>'Please fill in your {attribute}.','on'=>'billing'),*/
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, company_id, state,,s_title,s_address,s_address2,s_country_id,s_city,s_fname,s_lname,s_zipcode,s_phone_day,s_phone_evening,b_title,b_address,b_address2,b_country_id,b_city,b_fname,b_lname,b_zipcode,b_phone_day,b_phone_evening, county, address, address2, zipcode, created, last_login, available_range, phone_no, country_id, city', 'safe', 'on'=>'search'),
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
			//'users' => array(self::HAS_MANY, 'User', 'user_details_id'),						
			'UserCountry' => array(self::BELONGS_TO, 'Countries', 'country_id'),
			'ShippingUserCountry' => array(self::BELONGS_TO, 'Countries', 's_country_id'),
			'BillingUserCountry' => array(self::BELONGS_TO, 'Countries', 'b_country_id'),
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),

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
			'company_id' => 'Company',
			'state' => 'State',
			'county' => 'County',
			'address' => 'Address 1',
			'address2' => 'Address 2',
			'zipcode' => 'Zipcode',
			'lng' => 'Long',
			'lat' => 'Lat',
			'zoom' => 'Zoom',
			'created' => 'Created',
			'last_login' => 'Last Login',
			'available_range' => 'Available Range',
			'phone_no' => 'Phone No',
			'fax_no' => 'Fax No',
			'hear_from' => 'Hear From',
			'remote_trainig' => 'Remote Trainig',
			'accept_leads' => 'Accept Leads',
			'country_id' => 'Country',
			'city' => 'City',
			'phone_type' => 'Phone Type',
			's_title'=>' Title',
			's_address'=>'1st Line Of Address',
			's_address2'=>'2nd Line Of Address',
			's_country_id'=>' Country',
			's_city'=>'City/Town',
			's_fname'=>' First Name',
			's_lname'=>' Last Name',
			's_zipcode'=>'Postal Code/Zipcode',
			's_phone_day'=>'Phone Day',
			's_phone_evening'=>'Mobile',
			'b_title'=>' Title',
			'b_address'=>'1st Line Of Address',
			'b_address2'=>'2nd Line Of Address',
			'b_country_id'=>' Country',
			'b_city'=>'City/Town',
			'b_fname'=>' First Name',
			'b_lname'=>' Last Name',
			'b_zipcode'=>'Postal Code/Zipcode',
			'b_phone_day'=>'Phone Day',
			'b_phone_evening'=>'Mobile',
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
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('company_id',$this->company_id);
		$criteria->compare('state',$this->state,true);
		$criteria->compare('county',$this->county,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('address2',$this->address2,true);
		$criteria->compare('zipcode',$this->zipcode,true);
		$criteria->compare('lng',$this->lng,true);
		$criteria->compare('lat',$this->lat,true);
		$criteria->compare('zoom',$this->zoom);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('last_login',$this->last_login,true);
		$criteria->compare('available_range',$this->available_range,true);
		$criteria->compare('phone_no',$this->phone_no,true);
		$criteria->compare('fax_no',$this->fax_no,true);
		$criteria->compare('hear_from',$this->hear_from,true);
		$criteria->compare('remote_trainig',$this->remote_trainig);
		$criteria->compare('accept_leads',$this->accept_leads);
		$criteria->compare('country_id',$this->country_id,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('phone_type',$this->phone_type);

		$criteria->compare('s_title',$this->s_title);
		$criteria->compare('s_address',$this->s_address);
		$criteria->compare('s_address2',$this->s_address2);
		$criteria->compare('s_country_id',$this->s_country_id);
		$criteria->compare('s_city',$this->s_city);
		$criteria->compare('s_fname',$this->s_fname);
		$criteria->compare('s_lname',$this->s_lname);
		$criteria->compare('s_zipcode',$this->s_zipcode);
		$criteria->compare('s_phone_day',$this->s_phone_day);
		$criteria->compare('s_phone_evening',$this->s_phone_evening);
		$criteria->compare('b_title',$this->b_title);
		$criteria->compare('b_address',$this->b_address);
		$criteria->compare('b_address2',$this->b_address2);
		$criteria->compare('b_country_id',$this->b_country_id);
		$criteria->compare('b_city',$this->b_city);
		$criteria->compare('b_fname',$this->b_fname);
		$criteria->compare('b_lname',$this->b_lname);
		$criteria->compare('b_zipcode',$this->b_zipcode);
		$criteria->compare('b_phone_day',$this->b_phone_day);
		$criteria->compare('b_phone_evening',$this->b_phone_evening);		


		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function  getTitleValue($value)
	 {
	 	if($value==1){
	 		return 'Mr';
	 	}elseif($value==2){
	 		return 'Mrs';
	 	}elseif($value==3){
	 		return 'Miss';
	 	}else{
	 		return 'Dr';	
	 	}

	 }

	 
}