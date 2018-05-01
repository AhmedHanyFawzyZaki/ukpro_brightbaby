<?php
$this->breadcrumbs=array(
'Newsletter Messages'=>array('index'),
'Manage',
);

$this->menu=array(
array('label'=>'List NewsletterMessage','url'=>array('index')),
array('label'=>'Create NewsletterMessage','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('newsletter-message-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Newsletter Messages</h1>


<?php $this->widget('bootstrap.widgets.TbGridView',array(
'id'=>'newsletter-message-grid',
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(

	'subject',

	'date_sent',
		/*'start_flag',

	   'end_flag',
	   'temp1',
	   'temp2',
	*/
	array(
		'class'=>'bootstrap.widgets.TbButtonColumn',
		'template'=>'{view}{delete}',
	),
),
)); ?>
