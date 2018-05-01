<?php
$this->breadcrumbs = array(
    'Credit Logs' => array('index'),
    'Manage',
);

$this->menu = array(
    array('label' => 'List Credit Logs', 'url' => array('index')),
//    array('label' => 'Create CreditLog', 'url' => array('create')),
);
?>

<h1>Manage Credit Logs</h1>

<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'credit-log-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        //	'id',
        't_date',
        'pay_id',
        'user_id' => array(
            'name' => 'user_id',
            'value' => '$data->user->fname',
            'filter' => User::model()->getUsers(),
        ),
        'status' => array(// display 'author.username' using an expression
            'name' => 'status',
            'value' => '$data->statusLabel->title',
            'filter' => OrderStatus::model()->getStatus(),
        ),
        'amount' => array(
            'header' => 'Amount',
            'value' => '$data->amount',
        ),
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
        ),
    ),
));
?>
