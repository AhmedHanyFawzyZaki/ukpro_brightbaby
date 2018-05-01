<?php
$this->breadcrumbs=array(
	'Order Addresses'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List OrderAddress','url'=>array('index')),
	array('label'=>'Create OrderAddress','url'=>array('create')),
	array('label'=>'Update OrderAddress','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete OrderAddress','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage OrderAddress','url'=>array('admin')),
);
?>

<h1>View OrderAddress #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'first_name',
		'last_name',
		'email',
		'company',
		'address',
		'address2',
		'city',
		'state',
		'post_code',
		'country_id',
		'phone',
		'fax',
		'order_id',
		'user_id',
		'flag',
		'phone_day',
		'phone_evening',
	),
)); ?>
