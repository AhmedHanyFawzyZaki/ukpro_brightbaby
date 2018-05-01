<?php
$this->breadcrumbs=array(
	'Product Categories'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List ProductCategory','url'=>array('index')),
	//array('label'=>'Create ProductCategory','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('product-category-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Product Categories</h1>



<?php// echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php// $this->renderPartial('_search',array(
	//'model'=>$model,
//)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'product-category-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
	//	'id',
		'name',
		array(
			'name'=>'image',
			'type'=>'html',
			'value'=>'(!empty($data->image))?CHtml::image(Yii::app()->request->baseUrl."/media/".$data->image,"",array("style"=>"width:100px;height:75px;")):"no image"',
			'filter'=>''
		) ,
		
		array(
			'template'=>'{view}{update}',
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
