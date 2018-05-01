<?php

/**
 * This is the model class for table "products_colors".
 *
 * The followings are the available columns in table 'products_colors':
 * @property integer $id
 * @property integer $product_id
 * @property integer $color_id
 * @property string $temp1
 */
class ProductsColors extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ProductsColors the static model class
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
		return 'products_colors';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('product_id, color_id', 'numerical', 'integerOnly'=>true),
			array('temp1', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, product_id, color_id, temp1', 'safe', 'on'=>'search'),
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
			'clr'=>array(self::BELONGS_TO,'Colors','color_id'),
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
			'color_id' => 'Color',
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
		$criteria->compare('color_id',$this->color_id);
		$criteria->compare('temp1',$this->temp1,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public static function DelAll($product_id)
	{
		$criteria = new CDbCriteria;
		//$criteria->addCondition('product_id',$product_id);
		$criteria->condition='product_id='.$product_id;
		ProductsColors::model()->deleteAll($criteria);
	}
}