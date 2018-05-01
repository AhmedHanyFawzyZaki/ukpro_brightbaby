<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property string $username
 * @property string $email
 * @property string $password
 * @property string $fname
 * @property string $lname
 * @property string $image
 * @property string $details
 * @property integer $group
 * @property integer $active
 * @property integer $user_credit
 *
 * The followings are the available model relations:
 * @property UserDetails $userDetails
 */
class User extends CActiveRecord {

    public $password_repeat;
    public $verifyCode;
    public $country_id;
    public $newpassword;
    public $newpassword_repeat;
    public $newmail_repeat;
    public $new_firstname;
    public $new_lastname;
    public $newmail;
    public $s_title;
    public $s_fname;
    public $s_country_id;
    public $s_lname;
    public $s_address;
    public $s_address2;
    public $s_phone_day;
    public $s_phone_evening;
    public $s_zipcode;
    public $b_title;
    public $b_fname;
    public $b_country_id;
    public $b_lname;
    public $b_address;
    public $b_address2;
    public $b_phone_day;
    public $b_phone_evening;
    public $b_zipcode;
    public $shoppingbag_items;
    
    public $without_pass = false;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return User the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'user';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('email', 'unique', 'message' => 'This email address has already been registered.'),
            array('email', 'email', 'message' => 'OOPS! your email address is incorrect!', 'on' => 'register'),
            array('username', 'length', 'max' => 50),
            array('email, fname, full_name,lname, image', 'length', 'max' => 255),
            array('password', 'length', 'max' => 90),
            array('details, phone,groups_id,user_credit', 'safe'),
            array('email,password', 'required', 'on' => 'create ,update'),
            array('details,phone, full_name', 'safe', 'on' => 'create'),
            array('cookie_flag,subscribe', 'safe'),
            // The following rule is used by search().
            array(' username, email, full_name,password, fname, lname, image, details, groups_id, active', 'safe', 'on' => 'search'),
            //array('password, password_repeat', 'safe','on'=>'register'),
            //array('email,password,password_repeat,groups_id','required' ,'on'=>'register'),
            array('new_firstname,new_lastname', 'safe', 'on' => 'newname'),
            array('newpassword,newpassword_repeat', 'required', 'on' => 'passreset'),
            array('newpassword_repeat', 'compare', 'compareAttribute' => 'newpassword', 'message' => 'OOPS! Your passwords do not match!', 'on' => 'passreset'),
            array('newmail_repeat', 'compare', 'compareAttribute' => 'newmail', 'on' => 'mailreset'),
            array('country_id', 'safe', 'on' => 'register'),
            array('s_title,s_fname', 'required', 'on' => 'shipping'),
            array('email,password,fname,lname,password_repeat', 'required', 'on' => 'register'),
            array('country_id', 'required', 'message' => 'Please choose a country', 'on' => 'register'),
            array('shoppingbag_items,country_id,s_title,s_address,s_address2, subscribe,s_country_id,s_city,s_fname,s_lname,s_zipcode,s_phone_day,s_phone_evening,b_title,b_address,b_address2,b_country_id,b_city,b_fname,b_lname,b_zipcode,b_phone_day,b_phone_evening,cookie_flag', 'safe'),
            array('password', 'compare', 'compareAttribute' => 'password_repeat', 'message' => 'OOPS! Your passwords do not match!', 'on' => 'register'),
                //  array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements(),'on'=>'register'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'usergroup' => array(self::BELONGS_TO, 'Groups', 'groups_id'),
            'userdata' => array(self::BELONGS_TO, 'user_details', 'id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'username' => 'Username',
            'email' => 'Email',
            'password' => 'Password',
            'newpassword' => 'New Password',
            'newpassword_repeat' => 'Repeat New Password',
            'fname' => 'First Name',
            'lname' => 'Surname',
            'image' => 'Image',
            'details' => 'Details',
            'groups_id' => 'Account Type',
            'active' => 'User Status',
            'user_credit' => 'User Credit',
            'password_repeat' => 'Repeat password',
            'verifyCode' => 'Verification Code',
            'full_name' => 'Full Name',
            'country_id' => 'Country',
            's_title' => 'Shipping Title',
            's_address' => '1st Line Of Address',
            's_address2' => '2nd Line Of Address',
            's_country_id' => 'Shipping Country',
            's_city' => 'City/Town	',
            's_fname' => 'Shipping First Name',
            's_lname' => 'Shipping Last Name',
            's_zipcode' => 'Postal Code/Zipcode',
            's_phone_day' => 'Phone Day',
            's_phone_evening' => 'Shipping Phone Evrning',
            'b_title' => 'Billing Title',
            'b_address' => 'Billing First Address',
            'b_address2' => 'Billing Second Address',
            'b_country_id' => 'Billing Country',
            'b_city' => 'Billing City',
            'b_fname' => 'Billing First Name',
            'b_lname' => 'Billing Last Name',
            'b_zipcode' => 'Billing Zipcode',
            'b_phone_day' => 'Billing Phone Day',
            'b_phone_evening' => 'Billing Phone Evening',
            'subscribe' => 'Subscribe',
            'shoppingbag_items' => 'ShoppingBag Items'
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
        $criteria->compare('id', $this->id);
        $criteria->compare('username', $this->username, true);
        $criteria->compare('full_name', $this->full_name, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('password', $this->password, true);
        $criteria->compare('fname', $this->fname, true);
        $criteria->compare('lname', $this->lname, true);
        $criteria->compare('image', $this->image, true);
        $criteria->compare('details', $this->details, true);
        $criteria->compare('groups_id', $this->groups_id, true);
        $criteria->compare('cookie_flag', $this->cookie_flag, true);
        $criteria->compare('subscribe', $this->subscribe, true);
        $criteria->compare('shoppingbag_items', $this->shoppingbag_items, true);


        $criteria->compare('active', $this->active);
        //	$criteria->compare('user_credit',$this->user_credit);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function leaderSearch() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->condition = 'groups_id=4';
        $criteria->compare('username', $this->username, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('fname', $this->fname, true);
        $criteria->compare('lname', $this->lname, true);



        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    protected function beforeSave() {
        if (parent::beforeSave() && !$this->without_pass) {
            $this->password = $this->hash($this->password);
            return true;
        }
        return false;
    }

    // Authentication methods
    public function hash($value) {
        return $this->simple_encrypt($value);
    }

    public static function simple_encrypt($text, $salt = "Ukprosol") {
        return trim(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $salt, $text, MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_ECB), MCRYPT_RAND))));
    }

    function simple_decrypt($text, $salt = "Ukprosol") {
        return trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $salt, base64_decode($text), MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_ECB), MCRYPT_RAND)));
    }

    public function check($value) {
        $new_hash = $this->simple_encrypt($value);
        if ($new_hash == $this->password) {
            return true;
        }
        return false;
    }

    public static function getProfileType() {
        if (Yii::app()->user->group == 1 or Yii::app()->user->group == 0) {
            return 'member';
        } else if (Yii::app()->user->group == 6) {
            return 'dashboard';
        } else {
            return '#';
        }
    }

    public static function CheckAdmin() {
        if (( Yii::app()->user->isGuest)) {
            return false;
        } else if (Yii::app()->user->group == 6) {
            return true;
        } else {
            return false;
        }
    }

// used for multiple users level
    public static function CheckPermission($type) {
        if (( Yii::app()->user->isGuest)) {
            return false;
        }

        switch ($type) {
            case 'member':
                if (Yii::app()->user->group == 1)
                    return true;
                break;

            default:
                return false;
        } // switch
    }

    public function getUsers() {
        return CHtml::listData(User::model()->findAll(), 'id', 'fname');
    }

    public function getSubscribeValue($value) {
        if ($value == 0) {
            return 'Unsubscribed';
        } elseif ($value == 1) {
            return 'Subscribed';
        }
    }

    public function getsubscribers() {
        $criteria = new CDbCriteria;
        $criteria->select = 't.*';
        $criteria->condition = 'subscribe=1';


        return CHtml::listData(User::model()->findAll($criteria), 'id', 'email');
    }

}