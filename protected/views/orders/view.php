<?php
$this->breadcrumbs = array(
    'Orders' => array('index'),
    $model->id,
);

$this->menu = array(
    array('label' => 'List Orders', 'url' => array('index')),
    array('label' => 'Create Order', 'url' => array('create')),
    array('label' => 'Update Order', 'url' => array('update', 'id' => $model->id)),
    array('label' => 'Delete Order', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
//    array('label' => 'Manage Orders', 'url' => array('index')),
);
?>

<h1>View Order #<?php echo $model->id; ?></h1>

<?php
$this->widget('bootstrap.widgets.TbDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        'price',
        'user_id',
        'email',
        'status' => array('name' => 'Status', 'value' => $model->statuss->title),
        'order_date',
        'pay_id',
        'payer_id',
        'discount_id',
        's_title',
        's_address',
        's_address2',
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
    ),
));
?>
