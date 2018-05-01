<?php
$this->breadcrumbs=array(
	'Products Colors'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ProductsColors','url'=>array('index')),
//	array('label'=>'Manage ProductsColors','url'=>array('admin')),
);
?>

<h1>Create ProductsColors</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>