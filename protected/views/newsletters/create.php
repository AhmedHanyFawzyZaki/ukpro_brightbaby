<?php
$this->breadcrumbs = array(
    'Newsletters' => array('index'),
    'Create',
);

$this->menu = array(
    array('label' => 'List Newsletter Subscribers', 'url' => array('index')),
//	array('label'=>'Manage Newsletters','url'=>array('index')),
);
?>

<h1>Create Newsletter Subscriber</h1>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>