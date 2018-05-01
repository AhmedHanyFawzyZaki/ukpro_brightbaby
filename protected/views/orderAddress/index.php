<?php
$this->breadcrumbs=array(
	'Order Addresses'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List OrderAddress','url'=>array('index')),
	array('label'=>'Create OrderAddress','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('order-address-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Order Addresses</h1>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'order-address-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
	//	'id',
		'first_name',
		'last_name',
		'email',
		'company',
		'address',
		/*
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
		*/
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
