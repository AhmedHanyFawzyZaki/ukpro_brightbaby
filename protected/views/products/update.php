<?php
$this->breadcrumbs=array(
	'Products'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Products','url'=>array('index')),
	array('label'=>'Create Products','url'=>array('create')),
	array('label'=>'View Products','url'=>array('view','id'=>$model->id)),
    array('label' => 'Products Order', 'url' => array('order')),
	//array('label'=>'Manage Products','url'=>array('index')),
);
?>

<h1>Update Products <?php echo $model->title; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model,
											  'gallery'=>$gallery,
											  'arrOfColors'=>$arrOfColors,
											  'arr'=>$arr)); ?>