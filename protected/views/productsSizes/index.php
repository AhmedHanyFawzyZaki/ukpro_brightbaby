<?php
$this->breadcrumbs = array(
    'Products Sizes' => array('index'),
    'Manage',
);

$this->menu = array(
    array('label' => 'List Products Sizes', 'url' => array('index')),
    array('label' => 'Create Product Size', 'url' => array('create')),
);
?>

<h1>Manage Products Sizes</h1>



<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'products-sizes-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        //	'id',
        'product_id',
        'size',
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
        ),
    ),
));
?>
