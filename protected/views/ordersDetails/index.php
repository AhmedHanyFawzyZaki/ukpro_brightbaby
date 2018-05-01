<?php
$this->breadcrumbs = array(
    'Orders Details' => array('index'),
    'Manage',
);

$this->menu = array(
    array('label' => 'List Orders Details', 'url' => array('index')),
    array('label' => 'Create Orders Detail', 'url' => array('create')),
);
?>

<h1>Manage Orders Details</h1>


<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'orders-details-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'qty',
        'pro_id' => array(
            'name' => 'pro_id',
            'value' => '$data->productName->title',
        ),
        'size',
        'color',
        'price',
        array(
            'header' => 'image',
            'type' => 'html',
            'value' => '(!empty($data->productName->image))?CHtml::image(Yii::app()->request->baseUrl."/media/products/".$data->productName->image,"",array("style"=>"width:100px;height:75px;")):"no image"',
        ),
        //'fullname',
        /*
          'username',
          'email',
          'address',
          'start_date',
         */
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
        ),
    ),
));
?>
