<?php
$this->breadcrumbs=array(
	'Countries'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Countries','url'=>array('index')),
	array('label'=>'Create Countries','url'=>array('create')),
	array('label'=>'Update Countries','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Countries','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	//array('label'=>'Manage Countries','url'=>array('admin')),
);
?>

<h1>View Countries #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'first_option_price',
		'second_option_price',
	),
)); ?>
