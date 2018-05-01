<?php
$this->breadcrumbs = array(
    'Sizes' => array('index'),
    $model->id,
);

$this->menu = array(
    array('label' => 'List Sizes', 'url' => array('index')),
    array('label' => 'Create Size', 'url' => array('create')),
    array('label' => 'Update Size', 'url' => array('update', 'id' => $model->id)),
    array('label' => 'Delete Size', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
//	array('label'=>'Manage Sizes','url'=>array('index')),
);
?>

<h1>View Size #<?php echo $model->id; ?></h1>

<?php
$this->widget('bootstrap.widgets.TbDetailView', array(
    'data' => $model,
    'attributes' => array(
        //	'id',
        'size',
    ),
));
?>
