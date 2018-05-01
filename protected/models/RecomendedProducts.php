<?php

/**
 * This is the model class for table "recomended_products".
 *
 * The followings are the available columns in table 'recomended_products':
 * @property integer $id
 * @property integer $product_id
 * @property integer $recomended_id
 * @property integer $sort
 * @property integer $temp1
 */
class RecomendedProducts extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return RecomendedProducts the static model class
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
		return 'recomended_products';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('product_id, recomended_id, sort, temp1', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, product_id, recomended_id, sort, temp1', 'safe', 'on'=>'search'),
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
			'prodname'=>array(self::BELONGS_TO,'Products','product_id'),
			'recommedname'=>array(self::BELONGS_TO,'Products','recomended_id'),
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
			'recomended_id' => 'Recomended',
			'sort' => 'Sort',
			'temp1' => 'Temp1',
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
		$criteria->compare('product_id',$this->product_id);
		$criteria->compare('recomended_id',$this->recomended_id);
		$criteria->compare('sort',$this->sort);
		$criteria->compare('temp1',$this->temp1);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function getRecommnededProducts()
	{
		$criteria= new CDbCriteria;
		$criteria->select='t.*';
		$criteria->condition='id='.Yii::app()->user->getState('productID');
		$pro = Products::model()->find($criteria);


		$criteria1= new CDbCriteria;
		$criteria1->select='t.*';
		//$criteria1->condition='cat_id='.$pro->cat_id;
		$criteria1->condition='cat_id like '.'"%'.$pro->cat_id.'%"';
		$criteria1->addCondition('id !='.$pro->id);

		//'cat_id like "%4%"';
		//$products=Products::model()->findAll($criteria1);

		return CHtml::listData(Products::model()->findAll($criteria1),'id','title');
	}
}