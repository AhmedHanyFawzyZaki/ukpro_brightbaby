<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'price',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'user_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'email',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'status',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'order_date',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'token',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'payer_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'s_title',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'discount_id',array('class'=>'span5','maxlength'=>50)); ?>

	<?php echo $form->textFieldRow($model,'s_fname',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'s_lname',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'s_zipcode',array('class'=>'span5','maxlength'=>50)); ?>

	<?php echo $form->textFieldRow($model,'s_city',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'s_country_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'s_phone_evening',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'s_phone_day',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'b_title',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'b_address',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'b_address2',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'b_country_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'b_fname',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'b_lname',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'b_zipcode',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'b_city',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'b_phone_day',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'b_phone_evening',array('class'=>'span5','maxlength'=>255)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
