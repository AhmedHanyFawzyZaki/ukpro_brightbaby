<?php
$this->breadcrumbs=array(
	'Countries'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Countries','url'=>array('index')),
	array('label'=>'Create Countries','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('countries-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Countries</h1>


<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'countries-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
	//	'id',
		'name',
		array(
			'name'=>'first_option_price',
			'filter'=>'',
		),
		array(
			'name'=>'second_option_price',
			'filter'=>'',
		),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
