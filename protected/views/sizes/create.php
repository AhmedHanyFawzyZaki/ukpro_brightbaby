<?php
$this->breadcrumbs = array(
    'Sizes' => array('index'),
    'Create',
);

$this->menu = array(
    array('label' => 'List Sizes', 'url' => array('index')),
//	array('label'=>'Manage Sizes','url'=>array('index')),
);
?>

<h1>Create Sizes</h1>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>