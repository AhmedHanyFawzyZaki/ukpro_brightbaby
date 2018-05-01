<?php
$this->breadcrumbs=array(
	'Products'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Products','url'=>array('index')),
//	array('label'=>'Manage Products','url'=>array('index')),
    array('label' => 'Products Order', 'url' => array('order')),
);
?>

<h1>Create Products</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'gallery' => $gallery)); ?>