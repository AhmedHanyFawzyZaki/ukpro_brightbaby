<?php
$this->breadcrumbs = array(
    'Sizes' => array('index'),
    'Manage',
);

$this->menu = array(
    array('label' => 'List Sizes', 'url' => array('index')),
    array('label' => 'Create Size', 'url' => array('create')),
);
?>

<h1>Manage Sizes</h1>

<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'sizes-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        //'id',
        'size',
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
        ),
    ),
));
?>
