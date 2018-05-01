<?php
$this->breadcrumbs = array(
    'Orders' => array('index'),
    'Manage',
);

$this->menu = array(
    array('label' => 'List Orders', 'url' => array('index')),
    array('label' => 'Create Order', 'url' => array('create')),
);
?>

<h1>Manage Orders</h1>



<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'orders-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        'id',
        'price',
        'user_id' => array(// display 'author.username' using an expression
            'name' => 'user_id',
            'value' => '$data->user->fname',
            'filter' => User::model()->getUsers(),
        ),
        'pay_id',
        'status' => array(// display 'author.username' using an expression
            'name' => 'status',
            'value' => '$data->statuss->title',
            'filter' => OrderStatus::model()->getStatus(),
        ),
        'order_date',
        array(
            'class' => 'CLinkColumn',
            'label' => 'Details...',
            'urlExpression' => 'Yii::app()->request->baseUrl."/ordersDetails/index?id=".$data->id',
            'header' => 'Details'
        ),
        /*
          'token',
          'payer_id',
          's_title',
          'discount_id',
          's_fname',
          's_lname',
          's_zipcode',
          's_city',
          's_country_id',
          's_phone_evening',
          's_phone_day',
          'b_title',
          'b_address',
          'b_address2',
          'b_country_id',
          'b_fname',
          'b_lname',
          'b_zipcode',
          'b_city',
          'b_phone_day',
          'b_phone_evening',
         */
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
        ),
    ),
));
?>
