<?php

/**
 * This is the model class for table "credit_log".
 *
 * The followings are the available columns in table 'credit_log':
 * @property integer $id
 * @property string $amount
 * @property string $status
 * @property string $t_date
 * @property integer $user_id
 */
class CreditLog extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return CreditLog the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'credit_log';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('user_id', 'numerical', 'integerOnly' => true),
            array('amount, status, t_date, pay_id', 'length', 'max' => 255),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, amount, status, t_date, user_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'user' => array(self::BELONGS_TO, 'User', 'user_id'),
            'statusLabel' => array(self::BELONGS_TO, 'OrderStatus', 'status'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'amount' => 'Amount',
            'status' => 'Status',
            't_date' => 'Transaction Date',
            'user_id' => 'User',
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

        $criteria->compare('id', $this->id);
        $criteria->compare('amount', $this->amount, true);
        $criteria->compare('status', $this->status, true);
        $criteria->compare('t_date', $this->t_date, true);
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('pay_id', $this->pay_id);
        $criteria->order = "id DESC";

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public static function ListStatus() {
        return CHtml::listData(array(
                    array('id' => '', 'title' => 'Filter'),
                    array('id' => 'Completed', 'title' => 'Completed'),
                    array('id' => 'Pending', 'title' => 'Pending'),
                        ), 'id', 'title');
    }

}