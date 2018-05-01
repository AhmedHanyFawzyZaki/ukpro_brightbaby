<?php
$this->breadcrumbs=array(
	'Colors'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Colors','url'=>array('index')),
	array('label'=>'Create Colors','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('colors-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Colors</h1>


<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'colors-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
	//	'id',
		'title',
		'color'=>array(
			'name'=>'color',
			'type'=>'raw',
		  	'value'=>'Helper::displayColor($data->color)',
			),
	//	'temp1',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
