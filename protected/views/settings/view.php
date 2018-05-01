<?php
$this->breadcrumbs = array(
    'Settings' => array('index'),
    $model->id,
);

$this->menu = array(
    array('label' => 'Update Settings', 'url' => array('index', 'id' => $model->id)),
);
?>

<h1>View Settings #<?php echo $model->id; ?></h1>

<?php
$this->widget('bootstrap.widgets.TbDetailView', array(
    'data' => $model,
    'attributes' => array(
        'website',
        'google',
        'twitter',
        'pinterest',
        //	'support_email',
        'email',
        'facebook',
        //	'paypal_email',
        'tumblr',
        'customers_phone',
        //	'vat',
        //	'company_registration',
        'address',
        //	'first_class_shipping',
        //	'next_day_shipping',
        'postage_costs',
        array(
            'name' => 'baby_girl_image',
            'type' => 'raw',
            'value' => CHtml::image(Yii::app()->request->baseUrl . '/media/' . $model->baby_girl_image, 'baby girl image', array('width' => 250)),
        ),
        array(
            'name' => 'baby_boy_image',
            'type' => 'raw',
            'value' => CHtml::image(Yii::app()->request->baseUrl . '/media/' . $model->baby_boy_image, 'baby boy image', array('width' => 250)),
        ),
        'pspid',
        'sha_password',
        'facebook_description',
    ),
));
?>
