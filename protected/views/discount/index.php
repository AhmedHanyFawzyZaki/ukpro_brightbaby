<?php
$this->breadcrumbs=array(
'Discounts'=>array('index'),
'Manage',
);

$this->menu=array(
array('label'=>'List Discount','url'=>array('index')),
array('label'=>'Create Discount','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('discount-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Discounts</h1>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
'id'=>'discount-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(
	'code',
	'percentage',
	'total_num',
	'used_num',
	array(
		'class'=>'bootstrap.widgets.TbButtonColumn',
	),
),
)); ?>
