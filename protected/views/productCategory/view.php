<?php
$this->breadcrumbs=array(
	'Product Categories'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List ProductCategory','url'=>array('index')),
	//array('label'=>'Create ProductCategory','url'=>array('create')),
	array('label'=>'Update ProductCategory','url'=>array('update','id'=>$model->id)),
	//array('label'=>'Delete ProductCategory','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	//array('label'=>'Manage ProductCategory','url'=>array('index')),
);
?>

<h1>View ProductCategory #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
	//	'id',
		'name',
		array(
		'name'=>'image',
		'type'=>'raw',
		'value'=>CHtml::image(Yii::app()->request->baseUrl.'/media/'.$model->image,$model->name,array('width'=>250)),
		'filter'=>''
		),
	),
)); ?>
