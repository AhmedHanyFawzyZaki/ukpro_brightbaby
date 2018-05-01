<?php
$this->breadcrumbs=array(
	'Products Sizes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ProductsSizes','url'=>array('index')),
//	array('label'=>'Manage ProductsSizes','url'=>array('index')),
);
?>

<h1>Create ProductsSizes</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>