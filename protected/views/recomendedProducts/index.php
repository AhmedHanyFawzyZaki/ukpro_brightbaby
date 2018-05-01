<?php
$this->breadcrumbs=array(
	'Recomended Products'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List RecomendedProducts','url'=>array('index')),
	array('label'=>'Create RecomendedProducts','url'=>array('create','pro_id'=>Yii::app()->user->getState('productID'))),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('recomended-products-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Recomended Products</h1>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'recomended-products-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
	//	'id',
		'product_id'=>array(
			'name'=>'product_id',
			'value'=>'$data->prodname->title',
		),
		'recomended_id'=>array(
			'name'=>'recomended_id',
			'value'=>'$data->recommedname->title',
		),
		'sort',
	//	'temp1',
		
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
