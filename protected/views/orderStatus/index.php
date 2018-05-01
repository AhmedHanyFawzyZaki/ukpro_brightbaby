<?php
$this->breadcrumbs=array(
	'Order Statuses',
);

$this->menu=array(
	array('label'=>'Create OrderStatus','url'=>array('create')),
	array('label'=>'Manage OrderStatus','url'=>array('admin')),
);
?>

<h1>Order Statuses</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
