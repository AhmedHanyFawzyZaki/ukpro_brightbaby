<?php
$this->breadcrumbs=array(
	'Product Galleries'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ProductGallery','url'=>array('index')),
	array('label'=>'Manage ProductGallery','url'=>array('index')),
);
?>

<h1>Create Gallery</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>