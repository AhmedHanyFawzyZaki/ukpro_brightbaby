<?php
$this->breadcrumbs=array(
	'Order Statuses'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List OrderStatus','url'=>array('index')),
	array('label'=>'Create OrderStatus','url'=>array('create')),
	array('label'=>'Update OrderStatus','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete OrderStatus','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage OrderStatus','url'=>array('admin')),
);
?>

<h1>View OrderStatus #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
	),
)); ?>
