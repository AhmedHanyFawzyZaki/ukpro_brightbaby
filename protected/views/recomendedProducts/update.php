<?php
$this->breadcrumbs=array(
	'Recomended Products'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List RecomendedProducts','url'=>array('index')),
	array('label'=>'Create RecomendedProducts','url'=>array('create')),
	array('label'=>'View RecomendedProducts','url'=>array('view','id'=>$model->id)),
// /	array('label'=>'Manage RecomendedProducts','url'=>array('admin')),
);
?>

<h1>Update RecomendedProducts <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>