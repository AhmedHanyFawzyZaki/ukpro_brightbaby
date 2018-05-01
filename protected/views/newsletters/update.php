<?php
$this->breadcrumbs = array(
    'Newsletters' => array('index'),
    $model->id => array('view', 'id' => $model->id),
    'Update',
);

$this->menu = array(
    array('label' => 'List Newsletter Subscribers', 'url' => array('index')),
    array('label' => 'Create Newsletter Subscriber', 'url' => array('create')),
    array('label' => 'View Newsletter Subscriber', 'url' => array('view', 'id' => $model->id)),
//	array('label'=>'Manage Newsletters','url'=>array('index')),
);
?>

<h1>Update Newsletter Subscriber : <?php echo $model->email; ?></h1>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>