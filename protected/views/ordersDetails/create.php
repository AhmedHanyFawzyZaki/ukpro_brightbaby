<?php
$this->breadcrumbs=array(
	'Orders Details'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List OrdersDetails','url'=>array('index')),
);
?>

<h1>Create OrdersDetails</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>