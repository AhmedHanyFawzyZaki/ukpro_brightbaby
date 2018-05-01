<?php
$this->breadcrumbs=array(
	'Products Sizes'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List ProductsSizes','url'=>array('index')),
	array('label'=>'Create ProductsSizes','url'=>array('create')),
	array('label'=>'Update ProductsSizes','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete ProductsSizes','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
//	array('label'=>'Manage ProductsSizes','url'=>array('index')),
);
?>

<h1>View ProductsSizes #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
	//	'id',
		'product_id',
		'size',
	),
)); ?>
