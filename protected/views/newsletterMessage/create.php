<?php
$this->breadcrumbs=array(
	'Newsletter Messages'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List NewsletterMessage','url'=>array('index')),
	array('label'=>'Manage NewsletterMessage','url'=>array('admin')),
);
?>

<h1>Create NewsletterMessage</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>