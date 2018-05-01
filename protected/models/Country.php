<?php

/**
 * This is the model class for table "country".
 *
 * The followings are the available columns in table 'country':
 * @property integer $id
 * @property string $title
 * @property string $code
 * @property string $order
 * @property integer $temp1
 * @property integer $temp2
 */
class Country extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Country the static model class
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
		return 'country';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, code', 'required'),
			array('temp1, temp2', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>100),
			array('code', 'length', 'max'=>4),
			array('order', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, code, order, temp1, temp2', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Title',
			'code' => 'Code',
			'order' => 'Order',
			'temp1' => 'Temp1',
			'temp2' => 'Temp2',
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('order',$this->order,true);
		$criteria->compare('temp1',$this->temp1);
		$criteria->compare('temp2',$this->temp2);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function getCountries()
	{
		return CHtml::listData(Country::model()->findAll(array('order'=>'title ASC')),'id','title');
	}

}