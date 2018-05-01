<?php
$this->breadcrumbs=array(
	'Shippings'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Shipping','url'=>array('index')),
	array('label'=>'Create Shipping','url'=>array('create')),
	array('label'=>'View Shipping','url'=>array('view','id'=>$model->id)),
	//array('label'=>'Manage Shipping','url'=>array('admin')),
);
?>

<h1>Update Shipping <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>