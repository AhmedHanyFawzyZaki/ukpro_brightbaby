<?php
$this->breadcrumbs=array(
	'Recomended Products'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List RecomendedProducts','url'=>array('index')),
//	array('label'=>'Manage RecomendedProducts','url'=>array('admin')),
);
?>

<h1>Create RecomendedProducts</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>