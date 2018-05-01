<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'newsletter-message-form',
    'enableAjaxValidation' => false,
    'type' => 'horizontal',
        ));
?>

<script>
    $(document).ready(function() {
        $("#ckbCheckAll").click(function() {
            //$(".Xall").attr('checked', this.checked);
            $(".listMEM").prop('checked', true)

        });

        $("#ckbunCheckAll").click(function() {
            //$(".Xall").attr('checked', this.checked);
            $(".listMEM").prop('checked', false)

        });
    });
</script>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

<?php //echo $form->textFieldRow($model,'users_id',array('class'=>'span5','maxlength'=>255)); ?>

<?php
echo " <div class=\"control-group \">
	<label for=\"filter_id\" class=\"control-label\" style=\"color:red\">Filter</label>
			 <div class=\"controls\">";
echo $form->dropDownList($model, 'filter', array('0' => 'All users', '1' => 'Subscribed users')
        , array(
    'prompt' => 'Select Filter',
    'ajax' => array(
        'type' => 'POST',
        'url' => Yii::app()->createUrl('User/get_filter_users'),
        'data' => array('filter' => 'js:this.value'),
        'success' => 'function( data )
                    {
						document.getElementById("user_selection").innerHTML=data;
                    }'
    ))
);
echo "</div> </div>";
?>

<div class="control-group">
    <label class="control-label"> Selection </label>
    <div class="controls">
        <a href="javascript:void(0)" id="ckbCheckAll" class="btn btn-primary btn-large ">Check all</a>
        <a href="javascript:void(0)" id="ckbunCheckAll" class="btn btn-large">Uncheck all</a>
    </div>
</div>

<div class="control-group">
    <label class="control-label"> Subscribers </label>
    <div class="controls" id="user_selection">
        <?php
        //echo $form->checkBoxList($model, 'user_selection',Newsletters::model()->getsubscribers(), array('multiple'=>true,'class'=>'listMEM'));
        echo $form->checkBoxList($model, 'user_selection', User::model()->getsubscribers(), array('multiple' => true, 'class' => 'listMEM'));
        ?>
    </div>
</div>
<div style="clear: both;"></div>
<?php echo $form->textFieldRow($model, 'subject', array('class' => 'span5', 'maxlength' => 255)); ?>

<?php //echo $form->textAreaRow($model,'message',array('class'=>'span5','maxlength'=>255)); ?>

<!--<label class="control-label"> Message </label>-->
<?php /*
  $this->widget('application.extensions.eckeditor.ECKEditor', array(
  'model'=>$model,
  'attribute'=>'message',
  )); */
?>

<?php //echo $form->textFieldRow($model,'date_sent',array('class'=>'span5','maxlength'=>255));  ?>

<?php //echo $form->textFieldRow($model,'start_flag',array('class'=>'span5'));  ?>

<?php //echo $form->textFieldRow($model,'end_flag',array('class'=>'span5'));  ?>

<?php //echo $form->textFieldRow($model,'temp1',array('class'=>'span5'));  ?>

<?php //echo $form->textFieldRow($model,'temp2',array('class'=>'span5'));  ?>

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
