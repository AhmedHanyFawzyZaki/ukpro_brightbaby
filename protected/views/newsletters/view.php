<?php
$this->breadcrumbs = array(
    'Newsletters' => array('index'),
    $model->id,
);

$this->menu = array(
    array('label' => 'List Newsletter Subscribers', 'url' => array('index')),
    array('label' => 'Create Newsletter Subscriber', 'url' => array('create')),
    array('label' => 'Update Newsletter Subscriber', 'url' => array('update', 'id' => $model->id)),
    array('label' => 'Delete Newsletter Subscriber', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
//	array('label'=>'Manage Newsletters','url'=>array('index')),
);
?>

<h1>View Newsletter Subscriber : <?php echo $model->email; ?></h1>

<?php
$this->widget('bootstrap.widgets.TbDetailView', array(
    'data' => $model,
    'attributes' => array(
        'email',
    ),
));
?>
