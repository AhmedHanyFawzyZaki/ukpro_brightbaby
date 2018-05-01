<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'orders_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'qty',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'pro_id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'price',array('class'=>'span5','maxlength'=>11)); ?>

	<?php echo $form->textFieldRow($model,'fullname',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'username',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'email',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'address',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'start_date',array('class'=>'span5','maxlength'=>255)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
