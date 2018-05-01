<?php
$this->breadcrumbs=array(
	'Product Galleries'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List ProductGallery','url'=>array('index')),
	array('label'=>'Create ProductGallery','url'=>array('create')),
	array('label'=>'Update ProductGallery','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete ProductGallery','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ProductGallery','url'=>array('index')),
);
?>

<h1>View ProductGallery #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'image',
		'title',
		'description',
		'cat_id',
		'product_id',
		'temp1',
		'temp2',
		'created',
		'update_time',
	),
)); ?>
