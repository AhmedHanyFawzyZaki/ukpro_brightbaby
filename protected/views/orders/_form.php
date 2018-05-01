<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'orders-form',
    'enableAjaxValidation' => false,
        ));
?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldRow($model, 'price', array('class' => 'span5', 'maxlength' => 255, 'append' => '&pound;')); ?>

<?php echo $form->dropDownListRow($model, 'user_id', User::model()->getUsers(), array('class' => 'span5', 'maxlength' => 255, 'empty' => '(Select User)')); ?>

<?php echo $form->textFieldRow($model, 'email', array('class' => 'span5', 'maxlength' => 255)); ?>

<?php
echo " <div class=\"control-group \">
	<label for=\"UserDetails_country\" class=\"control-label\">Status</label>
			 <div class=\"controls\">";
echo $form->dropDownList($model, 'status', OrderStatus::model()->getStatus(), array('empty' => '(Select Status)'));
echo "</div> </div>";
?>

<?php echo $form->textFieldRow($model, 'order_date', array('class' => 'span5', 'maxlength' => 255, 'readonly' => 'readonly')); ?>

<?php echo $form->textFieldRow($model, 'pay_id', array('class' => 'span5', 'maxlength' => 255, 'readonly' => 'readonly')); ?>

<?php //echo $form->textFieldRow($model,'payer_id',array('class'=>'span5'));  ?>

<?php echo $form->textFieldRow($model, 'discount_id', array('class' => 'span5', 'maxlength' => 50)); ?>

<?php echo $form->textFieldRow($model, 's_title', array('class' => 'span5', 'maxlength' => 255)); ?>

<?php echo $form->textFieldRow($model, 's_address', array('class' => 'span5', 'maxlength' => 255)); ?>

<?php echo $form->textFieldRow($model, 's_address2', array('class' => 'span5', 'maxlength' => 255)); ?>

<?php echo $form->textFieldRow($model, 's_fname', array('class' => 'span5', 'maxlength' => 255)); ?>

<?php echo $form->textFieldRow($model, 's_lname', array('class' => 'span5', 'maxlength' => 255)); ?>

<?php echo $form->textFieldRow($model, 's_zipcode', array('class' => 'span5', 'maxlength' => 50)); ?>

<?php echo $form->textFieldRow($model, 's_city', array('class' => 'span5', 'maxlength' => 255)); ?>

<?php
echo " <div class=\"control-group \">
	<label for=\"UserDetails_country\" class=\"control-label\">Country</label>
			 <div class=\"controls\">";
echo $form->dropDownList($model, 's_country_id', Countries::model()->getCountries(), array('empty' => '(Select Country)'));
echo "</div> </div>";
?>

<?php echo $form->textFieldRow($model, 's_phone_evening', array('class' => 'span5', 'maxlength' => 255)); ?>

<?php echo $form->textFieldRow($model, 's_phone_day', array('class' => 'span5', 'maxlength' => 255)); ?>

<?php echo $form->textFieldRow($model, 'b_title', array('class' => 'span5', 'maxlength' => 255)); ?>

<?php echo $form->textFieldRow($model, 'b_address', array('class' => 'span5', 'maxlength' => 255)); ?>

<?php echo $form->textFieldRow($model, 'b_address2', array('class' => 'span5', 'maxlength' => 255)); ?>

<?php
echo " <div class=\"control-group \">
	<label for=\"UserDetails_country\" class=\"control-label\">Country</label>
			 <div class=\"controls\">";
echo $form->dropDownList($model, 'b_country_id', Countries::model()->getCountries(), array('empty' => '(Select Country)'));
echo "</div> </div>";
?>

<?php echo $form->textFieldRow($model, 'b_fname', array('class' => 'span5', 'maxlength' => 255)); ?>

<?php echo $form->textFieldRow($model, 'b_lname', array('class' => 'span5', 'maxlength' => 255)); ?>

<?php echo $form->textFieldRow($model, 'b_zipcode', array('class' => 'span5', 'maxlength' => 255)); ?>

<?php echo $form->textFieldRow($model, 'b_city', array('class' => 'span5', 'maxlength' => 255)); ?>

<?php echo $form->textFieldRow($model, 'b_phone_day', array('class' => 'span5', 'maxlength' => 255)); ?>

<?php echo $form->textFieldRow($model, 'b_phone_evening', array('class' => 'span5', 'maxlength' => 255)); ?>

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
