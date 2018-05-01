<?php
$this->breadcrumbs=array(
	'Order Addresses'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List OrderAddress','url'=>array('index')),
	array('label'=>'Manage OrderAddress','url'=>array('admin')),
);
?>

<h1>Create OrderAddress</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>