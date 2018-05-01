<?php
$this->breadcrumbs=array(
	'Products Colors',
);

$this->menu=array(
	array('label'=>'Create ProductsColors','url'=>array('create')),
	array('label'=>'Manage ProductsColors','url'=>array('admin')),
);
?>

<h1>Products Colors</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
