<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'product-gallery-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>


	<?php echo $form->textFieldRow($addGallery,'title',array('class'=>'span5','maxlength'=>250)); ?>
	<?php echo $form->fileFieldRow($addGallery,'image',array('class'=>'span5','maxlength'=>250)); ?>
	<?php echo $form->hiddenField($addGallery,'product_id',array('value'=>$id,'class'=>'span5')); ?>


<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
		'buttonType'=>'submit',
		'type'=>'primary',
		'label'=>'Add',
	)); ?>
</div>

<?php $this->endWidget(); ?>