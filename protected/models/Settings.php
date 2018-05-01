<?php

/**
 * This is the model class for table "settings".
 *
 * The followings are the available columns in table 'settings':
 * @property integer $id
 * @property string $website
 * @property string $google
 * @property string $twitter
 * @property string $pinterest
 * @property string $support_email
 * @property string $email
 * @property string $facebook
 * @property string $paypal_email
 */
class Settings extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Settings the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'settings';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('website, google, vat, company_registration, address, twitter, tumblr, customers_phone,pinterest, support_email, email, facebook, paypal_email, pspid, sha_password', 'length', 'max' => 255),
            array('tumblr, customers_phone,first_class_shipping,next_day_shipping,postage_costs,desc,keywords, facebook_description', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('baby_girl_image,baby_boy_image', 'file', 'types' => 'jpg, gif, png', 'allowEmpty' => true),
            array('id, website, google, twitter, tumblr, vat, first_class_shipping, postage_costs, next_day_shipping company_registration, address, customers_phone, pinterest, support_email, email, facebook, paypal_email', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'website' => 'Website url',
            'google' => 'Google account',
            'twitter' => 'Twitter account',
            'pinterest' => 'Pinterest ',
            'support_email' => 'Support Email',
            'email' => 'Main Email',
            'facebook' => 'Facebook account',
            'paypal_email' => 'Paypal Email',
            'tumblr' => 'Instagram',
            'customers_phone' => 'Customer Phone',
            'vat' => 'Vat',
            'company_registration' => 'Company Registration',
            'address' => 'Address',
            'first_class_shipping' => '1st Class Signed For by Royal Mail',
            'next_day_shipping' => 'Next Day delivery by Royal Mail',
            'postage_costs' => 'Postage Costs Percenatge',
            'baby_girl_image' => 'Baby girl image',
            'baby_boy_image' => 'Baby boy image',
            'desc' => 'Meta Description',
            'keywords' => 'Meta Keywords',
            'pspid' => 'PSPID',
            'sha_password' => 'Sha Password',
            'facebook_description' => 'Description for facebook share',
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
        $criteria->compare('website', $this->website, true);
        $criteria->compare('google', $this->google, true);
        $criteria->compare('twitter', $this->twitter, true);
        $criteria->compare('pinterest', $this->pinterest, true);
        $criteria->compare('support_email', $this->support_email, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('facebook', $this->facebook, true);
        $criteria->compare('paypal_email', $this->paypal_email, true);
        $criteria->compare('tumblr', $this->tumblr, true);
        $criteria->compare('customers_phone', $this->customers_phone, true);
        $criteria->compare('vat', $this->vat, true);
        $criteria->compare('address', $this->address, true);
        $criteria->compare('company_registration', $this->company_registration, true);
        $criteria->compare('first_class_shipping', $this->first_class_shipping, true);
        $criteria->compare('next_day_shipping', $this->next_day_shipping, true);
        $criteria->compare('postage_costs', $this->postage_costs, true);



        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}