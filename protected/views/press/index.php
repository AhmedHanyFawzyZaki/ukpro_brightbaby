<?php
$this->breadcrumbs=array(
	'Presses'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Press','url'=>array('index')),
	array('label'=>'Create Press','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('press-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Presses</h1>


<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'press-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
	//	'id',
		'new',
		'description',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
