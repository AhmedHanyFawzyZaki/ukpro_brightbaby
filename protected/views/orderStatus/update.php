<?php
$this->breadcrumbs=array(
	'Order Statuses'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List OrderStatus','url'=>array('index')),
	array('label'=>'Create OrderStatus','url'=>array('create')),
	array('label'=>'View OrderStatus','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage OrderStatus','url'=>array('admin')),
);
?>

<h1>Update OrderStatus <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>