<?php
$this->breadcrumbs=array(
	'Shippings'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Shipping','url'=>array('index')),
	array('label'=>'Create Shipping','url'=>array('create')),
	array('label'=>'Update Shipping','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Shipping','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	//array('label'=>'Manage Shipping','url'=>array('admin')),
);
?>

<h1>View Shipping #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
	//	'id',
		'question',
		'answer',
	),
)); ?>
