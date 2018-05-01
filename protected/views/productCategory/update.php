<?php
$this->breadcrumbs=array(
	'Product Categories'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ProductCategory','url'=>array('index')),
	//array('label'=>'Create ProductCategory','url'=>array('create')),
	array('label'=>'View ProductCategory','url'=>array('view','id'=>$model->id)),
//	array('label'=>'Manage ProductCategory','url'=>array('index')),
);
?>

<h1>Update ProductCategory <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>