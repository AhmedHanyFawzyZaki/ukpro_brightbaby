<?php
$this->breadcrumbs=array(
	'Discounts'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Discount','url'=>array('index')),
);
?>

<h1>Create Discount</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>