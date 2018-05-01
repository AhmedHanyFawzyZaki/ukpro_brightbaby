<?php
$this->breadcrumbs = array(
    'Orders' => array('index'),
    'Create',
);

$this->menu = array(
    array('label' => 'List Orders', 'url' => array('index')),
    array('label' => 'Manage Order', 'url' => array('index')),
);
?>

<h1>Create Order</h1>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>