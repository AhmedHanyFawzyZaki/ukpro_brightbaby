<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('code')); ?>:</b>
	<?php echo CHtml::encode($data->code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('percentage')); ?>:</b>
	<?php echo CHtml::encode($data->percentage); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('total_num')); ?>:</b>
	<?php echo CHtml::encode($data->total_num); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('used_num')); ?>:</b>
	<?php echo CHtml::encode($data->used_num); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('temp1')); ?>:</b>
	<?php echo CHtml::encode($data->temp1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('temp2')); ?>:</b>
	<?php echo CHtml::encode($data->temp2); ?>
	<br />


</div>