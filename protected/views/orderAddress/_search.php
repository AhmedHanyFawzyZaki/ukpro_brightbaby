<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'first_name',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'last_name',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'email',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'company',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'address',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'address2',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'city',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'state',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'post_code',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'country_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'phone',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'fax',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'order_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'user_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'flag',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'phone_day',array('class'=>'span5','maxlength'=>50)); ?>

	<?php echo $form->textFieldRow($model,'phone_evening',array('class'=>'span5','maxlength'=>50)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
