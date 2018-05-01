<?php
$this->breadcrumbs=array(
	'Order Statuses'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List OrderStatus','url'=>array('index')),
	array('label'=>'Manage OrderStatus','url'=>array('admin')),
);
?>

<h1>Create OrderStatus</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>