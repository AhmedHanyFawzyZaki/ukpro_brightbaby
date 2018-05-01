<?php
$this->breadcrumbs = array(
    'Credit Logs' => array('index'),
    $model->id => array('view', 'id' => $model->id),
    'Update',
);

$this->menu = array(
    array('label' => 'List Credit Logs', 'url' => array('index')),
//    array('label' => 'Create CreditLog', 'url' => array('create')),
    array('label' => 'View Credit Log', 'url' => array('view', 'id' => $model->id)),
);
?>

<h1>Update Credit Log #<?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>