<?php
$this->breadcrumbs=array(
	'Newsletter Messages'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List NewsletterMessage','url'=>array('index')),
	array('label'=>'Create NewsletterMessage','url'=>array('create')),
	array('label'=>'View NewsletterMessage','url'=>array('view','id'=>$model->id)),
);
?>

<h1>Update NewsletterMessage <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>