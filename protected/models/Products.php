<?php

/**
 * This is the model class for table "products".
 *
 * The followings are the available columns in table 'products':
 * @property integer $id
 * @property integer $cat_id
 * @property string $title
 * @property string $slug
 * @property string $description
 * @property string $image
 * @property string $price
 * @property integer $quantity
 */
class Products extends CActiveRecord implements IECartPosition {

    public $sizes;
    public $colors;
    public $categories;
    public $List_arr2;
    public $categoriesList;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Products the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'products';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('title', 'unique'),
            array('gallery_id,quantity,bg_order,us_order', 'numerical', 'integerOnly' => true),
            array('title, slug, image, cat_id', 'length', 'max' => 250),
            array('price', 'length', 'max' => 50),
            array('description, gallery_id', 'safe'),
            array('sizes,colors', 'safe', 'on' => 'create'),
            array('sizing, love_it, delivery, look_after_me', 'safe'),
            array('title,price,image,categories,sizes,colors', 'required'),
            array('categories,categoriesList,sold', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, cat_id,sizing, love_it, sold, look_after_me, delivery, title, slug, description, image, price, quantity', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'productCategory' => array(self::BELONGS_TO, 'ProductCategory', 'cat_id'),
            'productSizes' => array(self::BELONGS_TO, 'ProductsSizes', 'product_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'cat_id' => 'Product Type',
            'title' => 'Title',
            'slug' => 'Slug',
            'description' => 'Description',
            'image' => 'Image',
            'price' => 'Price',
            'quantity' => 'Quantity',
            'sizing' => 'Sizing',
            'love_it' => 'Why we love it',
            'delivery' => 'Delivery',
            'look_after_me' => 'Look afer product',
            'sold' => 'Sold Quantity',
            'categories' => 'Product Type',
            'categoriesList' => 'Product Type',
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
        $criteria->compare('cat_id', $this->cat_id);
        $criteria->compare('title', $this->title, true);
        $criteria->compare('slug', $this->slug, true);
        $criteria->compare('description', $this->description, true);
        $criteria->compare('image', $this->image, true);
        $criteria->compare('price', $this->price, true);
        $criteria->compare('quantity', $this->quantity);
        $criteria->compare('gallery_id', $this->gallery_id);

        $criteria->compare('sizing', $this->sizing);
        $criteria->compare('love_it', $this->love_it);
        $criteria->compare('delivery', $this->delivery);
        $criteria->compare('look_after_me', $this->look_after_me);
        $criteria->compare('sold', $this->sold);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function slugify($text) {
        // replace non letter or digits by -
        $text = preg_replace('~[^\\pL\d]+~u', '-', $text);

        // trim
        $text = trim($text, '-');

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // lowercase
        $text = strtolower($text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }

    public function getProducts() {
        return CHtml::listData(Products::model()->findAll(), 'id', 'title');
    }

    function getId() {
        return $this->id;
    }

    function getPrice() {
        return $this->price;
    }

    public function beforeSave() {
        $this->cat_id = implode(',', $this->categories);
        return true;
    }

    public function afterFind() {
        $this->categories = explode(',', $this->cat_id);

        foreach ($this->categories as $item) {
            $this->List_arr2[] = ProductCategory::model()->findByPk($item)->name;
        }
        $this->categoriesList = implode(',', $this->List_arr2);


        return true;
    }

}
