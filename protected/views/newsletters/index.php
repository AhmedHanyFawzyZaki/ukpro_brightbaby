<?php
$this->breadcrumbs = array(
    'Newsletters' => array('index'),
    'Manage',
);

$this->menu = array(
    array('label' => 'List Newsletter Subscribers', 'url' => array('index')),
    array('label' => 'Create Newsletter Subscriber', 'url' => array('create')),
);
?>

<h1>Manage Newsletter Subscribers</h1>


<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'newsletters-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        //'id',
        'email',
        //	'temp1',
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
        ),
    ),
));
?>
