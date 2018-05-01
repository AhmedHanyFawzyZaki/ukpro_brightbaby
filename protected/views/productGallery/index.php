<?php
$this->breadcrumbs=array(
	'Product Galleries'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List ProductGallery','url'=>array('index')),
	array('label'=>'Create ProductGallery','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('product-gallery-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Product Galleries</h1>

<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php //$this->renderPartial('_search',array(
	//'model'=>$model,
//)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'product-gallery-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		'title',
		'description',
		'cat_id',
		'product_id',
		'image',
		
		/*
		'temp1',
		'temp2',
		'created',
		'update_time',
		*/
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
