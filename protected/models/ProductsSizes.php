<?php

/**
 * This is the model class for table "products_sizes".
 *
 * The followings are the available columns in table 'products_sizes':
 * @property integer $id
 * @property integer $product_id
 * @property string $size
 */
class ProductsSizes extends CActiveRecord {

    public $sizes;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return ProductsSizes the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'products_sizes';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('product_id, qty', 'numerical', 'integerOnly' => true),
            array('size', 'length', 'max' => 50),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, product_id, size', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'sze' => array(self::BELONGS_TO, 'Sizes', 'size'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'product_id' => 'Product',
            'size' => 'Size',
            'qty' => "Quantity"
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
        $criteria->compare('product_id', $this->product_id);
        $criteria->compare('size', $this->size, true);
        $criteria->compare('qty', $this->qty, true);

        $criteria->order = "id DESC";

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public static function DelAll($product_id) {
        $criteria = new CDbCriteria;
        //$criteria->addCondition('product_id',$product_id);
        $criteria->condition = 'product_id=' . $product_id;
        ProductsSizes::model()->deleteAll($criteria);
    }

    public static function get_qty($product_id = 0, $size_id = 0) {
        $qty = 0;
        $flag = false;
        $criteria = new CDbCriteria;
        if($product_id){
            $criteria->condition = 'product_id = '.$product_id;
            $flag = true;
        }
        if($size_id && $flag){
            $criteria->addCondition('size = '.$size_id);
        }
        
        if($flag){
            $qts = ProductsSizes::model()->findAll($criteria);
            if($qts){
                foreach ($qts as $q){
                    $qty += $q->qty;
                }
            }
        }
        
        return $qty;
    }

}