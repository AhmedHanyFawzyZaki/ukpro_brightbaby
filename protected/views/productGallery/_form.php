<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'product-gallery-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>	

	<?php echo $form->textFieldRow($model,'title',array('class'=>'span5','maxlength'=>250)); ?>

	<?php echo $form->textAreaRow($model,'description',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php //echo $form->textFieldRow($model,'cat_id',array('class'=>'span5')); ?>

	<?php 		
		/*echo $form->dropDownListRow($model, 'cat_id', 
		    CHtml::listData(ProductCategory::model()->findAll(),'id' , 'name'),
			    array('prompt' => 'Select a Category'
				,'ajax' => array(
				'type'=>'POST', //request type
				'url'=>CController::createUrl('ProductGallery/dynamiccities'), //url to call.
				//Style: CController::createUrl('currentController/methodToCall')
				'update'=>'#ProductGallery_product_id', //selector to update
				//'data'=>'js:javascript statement'
				//leave out the data key to pass all form values through
				)										
			)
		); */
		
	?>


	<?php echo $form->dropDownListRow($model,'product_id',Products::model()->getProducts(),array('class'=>'span5','empty'=>'( Select a product )')); ?>

	<?php echo $form->fileFieldRow($model,'image',array('class'=>'span5','maxlength'=>250)); ?>

	<?php //echo $form->textFieldRow($model,'temp1',array('class'=>'span5','maxlength'=>50)); ?>

	<?php //echo $form->textFieldRow($model,'temp2',array('class'=>'span5','maxlength'=>50)); ?>

	<?php //echo $form->textFieldRow($model,'created',array('class'=>'span5','maxlength'=>50)); ?>

	<?php //echo $form->textFieldRow($model,'update_time',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
