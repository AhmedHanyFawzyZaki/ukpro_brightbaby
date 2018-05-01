<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'settings-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
    'type' => 'horizontal',
        ));
?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldRow($model, 'website', array('class' => 'span5', 'maxlength' => 255)); ?>
<?php echo $form->textFieldRow($model, 'email', array('class' => 'span5', 'maxlength' => 255)); ?>
<?php //echo $form->textFieldRow($model,'support_email',array('class'=>'span5','maxlength'=>255)); ?>
<?php //echo $form->textFieldRow($model,'paypal_email',array('class'=>'span5','maxlength'=>255));  ?>
<?php echo $form->textFieldRow($model, 'facebook', array('class' => 'span5', 'maxlength' => 255)); ?>


<?php echo $form->textFieldRow($model, 'google', array('class' => 'span5', 'maxlength' => 255)); ?>

<?php echo $form->textFieldRow($model, 'twitter', array('class' => 'span5', 'maxlength' => 255)); ?>

<?php echo $form->textFieldRow($model, 'pinterest', array('class' => 'span5', 'maxlength' => 255)); ?>

<?php echo $form->textFieldRow($model, 'tumblr', array('class' => 'span5', 'maxlength' => 255)); ?>

<?php echo $form->textFieldRow($model, 'customers_phone', array('class' => 'span5', 'maxlength' => 255)); ?>

<?php //echo $form->textFieldRow($model,'vat',array('class'=>'span5','maxlength'=>255)); ?>

<?php //echo $form->textFieldRow($model,'company_registration',array('class'=>'span5','maxlength'=>255)); ?>

<?php echo $form->textFieldRow($model, 'address', array('class' => 'span5', 'maxlength' => 255)); ?>

<?php echo $form->textFieldRow($model, 'pspid', array('class' => 'span5', 'maxlength' => 255)); ?>

<?php echo $form->textFieldRow($model, 'sha_password', array('class' => 'span5', 'maxlength' => 255)); ?>

<?php //echo $form->textFieldRow($model,'first_class_shipping',array('class'=>'span2','maxlength'=>255,'append'=>'&pound;')); ?>

<?php //echo $form->textFieldRow($model,'next_day_shipping',array('class'=>'span2','maxlength'=>255,'append'=>'&pound;')); ?>

<?php //echo $form->textFieldRow($model,'postage_costs',array('class'=>'span2','maxlength'=>50,'append'=>'%')); ?>
<?php //echo $form->textFieldRow($model,'first_class_shipping',array('class'=>'span2','maxlength'=>50,'append'=>'&pound;'));  ?>
<?php //echo $form->textFieldRow($model,'next_day_shipping',array('class'=>'span2','maxlength'=>50,'append'=>'&pound;')); ?>

<?php
echo $form->fileFieldRow($model, 'baby_girl_image', array('class' => 'span5', 'maxlength' => 255));

if ($model->isNewRecord != '1' and $model->baby_girl_image != '') {
    echo "<p>" . Chtml::image(Yii::app()->baseUrl . '/media/' . $model->baby_girl_image, 'image', array('width' => 200, 'style' => 'margin:0 180px 10px;')) . "</p>";
}
?>

<?php
echo $form->fileFieldRow($model, 'baby_boy_image', array('class' => 'span5', 'maxlength' => 255));

if ($model->isNewRecord != '1' and $model->baby_boy_image != '') {
    echo "<p>" . Chtml::image(Yii::app()->baseUrl . '/media/' . $model->baby_boy_image, 'image', array('width' => 200, 'style' => 'margin:0 180px 10px;')) . "</p>";
}
?>

<?php echo $form->textAreaRow($model, 'keywords'); ?>
<p style="color:red;">Please separate the meta keywords with comma (,)</p>
<?php echo $form->textAreaRow($model, 'desc'); ?>

<?php echo $form->textAreaRow($model, 'facebook_description'); ?>

<div class="form-actions">
    <?php
    $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType' => 'submit',
        'type' => 'primary',
        'label' => $model->isNewRecord ? 'Create' : 'Save',
    ));
    ?>
</div>

<?php $this->endWidget(); ?>
