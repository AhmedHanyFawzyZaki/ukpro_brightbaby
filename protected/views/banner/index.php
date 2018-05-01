<?php
$this->breadcrumbs=array(
	'Banners'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Banner','url'=>array('index')),
	array('label'=>'Create Banner','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('banner-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Banners</h1>



<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'banner-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(

		'header',
		   array(
		   'name'=>'image',
		   'type'=>'html',
		   'value'=>'(!empty($data->image))?CHtml::image(Yii::app()->request->baseUrl."/media/banner/".$data->image,"",array("style"=>"width:50px;height:50px;")):"no image"',
		   ) ,
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
