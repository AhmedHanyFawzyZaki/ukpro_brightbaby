<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'recomended-products-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->hiddenField($model,'product_id',array('value'=>Yii::app()->user->getState('productID'),'class'=>'span5')); ?>

	<?php echo $form->dropDownListRow($model,'recomended_id',RecomendedProducts::model()->getRecommnededProducts(),array('class'=>'span5','empty'=>'(Select Product)')); ?>

	<?php echo $form->textFieldRow($model,'sort',array('class'=>'span2')); ?>

	<?php //echo $form->textFieldRow($model,'temp1',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
