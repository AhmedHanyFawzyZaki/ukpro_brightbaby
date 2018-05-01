<div class="view">



	<b><?php echo CHtml::encode($data->getAttributeLabel('header')); ?>:</b>
	<?php echo CHtml::encode($data->header); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('subheader')); ?>:</b>
	<?php echo CHtml::encode($data->subheader); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('details')); ?>:</b>
	<?php echo CHtml::encode($data->details); ?>
	<br />

	<b>


	 <?php 	echo 	CHtml::image(Yii::app()->request->baseUrl.'/media/banner/'.$data->image,'image',array('width'=>200)); ?>
	</b>
	<br />


</div>