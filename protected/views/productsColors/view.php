<?php
$this->breadcrumbs=array(
	'Products Colors'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List ProductsColors','url'=>array('index')),
	array('label'=>'Create ProductsColors','url'=>array('create')),
	array('label'=>'Update ProductsColors','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete ProductsColors','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	//array('label'=>'Manage ProductsColors','url'=>array('admin')),
);
?>

<h1>View ProductsColors #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'product_id',
		'color_id',
		'temp1',
	),
)); ?>
