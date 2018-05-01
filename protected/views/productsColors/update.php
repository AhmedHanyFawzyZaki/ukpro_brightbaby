<?php
$this->breadcrumbs=array(
	'Products Colors'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ProductsColors','url'=>array('index')),
	array('label'=>'Create ProductsColors','url'=>array('create')),
	array('label'=>'View ProductsColors','url'=>array('view','id'=>$model->id)),
	//array('label'=>'Manage ProductsColors','url'=>array('admin')),
);
?>

<h1>Update ProductsColors <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>