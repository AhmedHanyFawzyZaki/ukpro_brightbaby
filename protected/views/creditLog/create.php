<?php
$this->breadcrumbs=array(
	'Credit Logs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CreditLog','url'=>array('index')),

);
?>

<h1>Create CreditLog</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>