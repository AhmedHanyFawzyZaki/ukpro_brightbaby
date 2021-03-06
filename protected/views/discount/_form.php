<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'discount-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'code',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'percentage',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'total_num',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'used_num',array('class'=>'span5' , 'readonly'=>'readonly')); ?>

	<?php //echo $form->textFieldRow($model,'temp1',array('class'=>'span5')); ?>

	<?php //echo $form->textFieldRow($model,'temp2',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
