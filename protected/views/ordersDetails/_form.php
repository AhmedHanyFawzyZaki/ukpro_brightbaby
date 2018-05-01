<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'orders-details-form',
	'enableAjaxValidation'=>false,
	'type'=>'horizontal',
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php //echo $form->textFieldRow($model,'orders_id',array('class'=>'span5')); ?>

	 <?php
		echo " <div class=\"control-group \">
		<label for=\"UserDetails_country\" class=\"control-label\">Product Name</label>
				 <div class=\"controls\">";
		echo   $form->dropDownList($model,'pro_id',Products::model()->getProducts());
		echo "</div> </div>";
	
	  ?>
      
     <?php 
		echo "<p>". Chtml::image(Yii::app()->baseUrl.'/media/products/'.$model->productName->image ,'image',array('width'=>200)) ."</p>";
	 ?>
    
    <?php echo $form->textFieldRow($model,'color',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'size',array('class'=>'span5','maxlength'=>255)); ?>
    
    <?php echo $form->textFieldRow($model,'qty',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'price',array('class'=>'span2','maxlength'=>11,'append'=>'&pound;')); ?>

	<?php //echo $form->textFieldRow($model,'fullname',array('class'=>'span5','maxlength'=>255)); ?>

	<?php //echo $form->textFieldRow($model,'first_name',array('class'=>'span5','maxlength'=>255)); ?>

	<?php //echo $form->textFieldRow($model,'last_name',array('class'=>'span5','maxlength'=>255)); ?>

	<?php //echo $form->textFieldRow($model,'username',array('class'=>'span5','maxlength'=>255)); ?>

	<?php //echo $form->textFieldRow($model,'email',array('class'=>'span5','maxlength'=>255)); ?>

	<?php //echo $form->textFieldRow($model,'address',array('class'=>'span5','maxlength'=>255)); ?>

	<?php //echo $form->textFieldRow($model,'start_date',array('class'=>'span5','maxlength'=>255)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
