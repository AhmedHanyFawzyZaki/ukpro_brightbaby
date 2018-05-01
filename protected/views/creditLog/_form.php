<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'credit-log-form',
    'enableAjaxValidation' => false,
    'type' => 'horizontal',
        ));
?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

<?php // echo $form->textFieldRow($model, 'amount', array('class' => 'spa2', 'maxlength' => 255, 'append' => '&pound;')); ?>

<?php echo $form->dropDownListRow($model, 'status', OrderStatus::model()->getStatus(), array('class' => 'span5', 'maxlength' => 255, 'empty' => '(Select Status)')); ?>

<?php //echo $form->textFieldRow($model,'t_date',array('class'=>'span5','maxlength'=>255));  ?>

<div class="control-group ">
    <!--<label for="CreditLog_t_date" class="control-label">Tranaction Date</label>-->
    <div class="controls">
        <?php
//        $form->widget('zii.widgets.jui.CJuiDatePicker', array(
//            'model' => $model,
//            'attribute' => 't_date',
//            'htmlOptions' => array(
//                'size' => '10', // textField size
//                'maxlength' => '10', // textField maxlength
//                'class' => 'span5',
//            ),
//            'options' => array(
//                'numberOfMonths' => 2,
//                'showButtonPanel' => true,
//            ),
//        ));
        ?>
    </div>
</div>

<?php // echo $form->dropDownListRow($model, 'user_id', User::model()->getUsers(), array('class' => 'span5', 'empty' => '(Select User)')); ?>

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
