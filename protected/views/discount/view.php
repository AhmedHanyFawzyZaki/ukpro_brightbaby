<?php
$this->breadcrumbs=array(
	'Discounts'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Discount','url'=>array('index')),
	array('label'=>'Create Discount','url'=>array('create')),
	array('label'=>'Update Discount','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Discount','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h1>View Discount #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'code',
		'percentage',
		'total_num',
		'used_num',
/*
		'temp1',
		'temp2',
*/
	),
)); ?>
