<?php
$this->breadcrumbs = array(
    'Credit Logs' => array('index'),
    $model->id,
);

$this->menu = array(
    array('label' => 'List Credit Logs', 'url' => array('index')),
//    array('label' => 'Create CreditLog', 'url' => array('create')),
    array('label' => 'Update Credit Log', 'url' => array('update', 'id' => $model->id)),
    array('label' => 'Delete Credit Log', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
);
?>

<h1>View Credit Log #<?php echo $model->id; ?></h1>

<?php
$this->widget('bootstrap.widgets.TbDetailView', array(
    'data' => $model,
    'attributes' => array(
        //'id',
        'amount',
        'status' => array(
            'name' => 'status',
            'value' => $model->statusLabel->title,
        ),
        'pay_id',
        't_date',
        'user_id' => array(
            'name' => 'user_id',
            'value' => $model->user->fname,
        ),
    ),
));
?>
