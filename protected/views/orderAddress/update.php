<?php
$this->breadcrumbs=array(
	'Order Addresses'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List OrderAddress','url'=>array('index')),
	array('label'=>'Create OrderAddress','url'=>array('create')),
	array('label'=>'View OrderAddress','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage OrderAddress','url'=>array('admin')),
);
?>

<h1>Update OrderAddress <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>