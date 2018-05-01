<?php
$this->breadcrumbs=array(
	'Products Sizes'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ProductsSizes','url'=>array('index')),
	array('label'=>'Create ProductsSizes','url'=>array('create')),
	array('label'=>'View ProductsSizes','url'=>array('view','id'=>$model->id)),
//	array('label'=>'Manage ProductsSizes','url'=>array('index')),
);
?>

<h1>Update ProductsSizes <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>