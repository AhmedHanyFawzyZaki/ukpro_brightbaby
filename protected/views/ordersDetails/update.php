<?php
$this->breadcrumbs=array(
	'Orders Details'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List OrdersDetails','url'=>array('index')),
	array('label'=>'Create OrdersDetails','url'=>array('create')),
	array('label'=>'View OrdersDetails','url'=>array('view','id'=>$model->id)),
);
?>

<h1>Update OrdersDetails <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>