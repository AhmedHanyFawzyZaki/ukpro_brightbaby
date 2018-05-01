<?php
$this->breadcrumbs=array(
	'Product Categories'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ProductCategory','url'=>array('index')),
//	array('label'=>'Manage ProductCategory','url'=>array('index')),
);
?>

<h1>Create ProductCategory</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>