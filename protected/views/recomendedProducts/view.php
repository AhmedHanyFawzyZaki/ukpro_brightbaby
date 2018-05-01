<?php
$this->breadcrumbs=array(
	'Recomended Products'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List RecomendedProducts','url'=>array('index')),
	array('label'=>'Create RecomendedProducts','url'=>array('create')),
	array('label'=>'Update RecomendedProducts','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete RecomendedProducts','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	//array('label'=>'Manage RecomendedProducts','url'=>array('admin')),
);
?>

<h1>View RecomendedProducts #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
	//	'id',
		'product_id'=>array(
			'name'=>'product_id',
			'value'=>$model->prodname->title,
			),
		'recomended_id'=>array(
			'name'=>'recomended_id',
			'value'=>$model->recommedname->title,
			),
		'sort',
	//	'temp1',
	),
)); ?>
