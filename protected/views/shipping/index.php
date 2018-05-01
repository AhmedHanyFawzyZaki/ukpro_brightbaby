<?php
$this->breadcrumbs=array(
	'Shippings'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Shipping','url'=>array('index')),
	array('label'=>'Create Shipping','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('shipping-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Shippings</h1>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'shipping-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
	//	'id',
		'question',
		'answer',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
