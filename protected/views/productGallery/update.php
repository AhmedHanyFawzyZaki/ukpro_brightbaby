<?php
$this->breadcrumbs=array(
	'Product Galleries'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ProductGallery','url'=>array('index')),
	array('label'=>'Create ProductGallery','url'=>array('create')),
	array('label'=>'View ProductGallery','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage ProductGallery','url'=>array('index')),
);
?>

<h1>Update ProductGallery <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>