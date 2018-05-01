<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'user-form',
	'enableAjaxValidation'=>true,
	'type'=>'horizontal',
	'htmlOptions' => array(	'enctype' => 'multipart/form-data'),

)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>


 <?php
   	echo " <div class=\"control-group \">
	<label for=\"UserDetails_city\" class=\"control-label\">User Group</label>
			 <div class=\"controls\">";
    echo   $form->dropDownList($model,'groups_id',Groups::model()->getGroups());
    echo "</div> </div>";

  ?>


	<?php //echo $form->textFieldRow($model,'username',array('class'=>'span5','maxlength'=>50)); ?>



	<?php echo $form->textFieldRow($model,'email',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->passwordFieldRow($model,'password',array('class'=>'span5','maxlength'=>90)); ?>

	<?php echo $form->textFieldRow($model,'fname',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'lname',array('class'=>'span5','maxlength'=>255)); ?>
    
    <?php echo $form->textFieldRow($model,'user_credit',array('class'=>'span5','maxlength'=>255,'append'=>'&pound;')); ?>

	<?php echo $form->dropDownListRow($model,'country_id',Countries::model()->getCountries(),array('class'=>'span5','maxlength'=>255,'empty'=>'(Select Country)')); ?>

	<?php echo $form->checkBoxRow($model,'subscribe',array('class'=>'span5','style'=>'width: 0px;')); ?>

	<?php //echo $form->fileFieldRow($model,'image');

/*
	if($model->isNewRecord != '1')
	{
		echo " <div class=\"control-group \"> <div class=\"controls\">";


		echo 	CHtml::image(Yii::app()->request->baseUrl.'/media/members/'.$model->image,'image',array('width'=>200));

		echo "</div></div>";
	}

*/

	 ?>




	<?php //echo $form->textAreaRow($model,'details',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php
/*
echo $form->dropDownListRow($model, 'groups_id',array('6' => 'Admin', '4' => 'EHR linked admin',
															 '3' => 'Company',
															 '3' => 'Company\'s Employee ',
															 '0' => 'Trainer',
															 '1'=>'Vendor'

															 ));
*/

	  //echo  "<div class=\"controls\">". $form->dropDownList($model,'groups_id',Groups::model()->getGroups())."</div>";


	?>






	<?php //echo $form->checkboxRow($model,'active'); ?>


	<h2>Shipping information</h2>
	<?php echo $form->dropDownListRow($UserData,'s_title',array('1'=>'Mr','2'=>'Mrs','3'=>'Miss','4'=>'Dr'),array('class'=>'span5','maxlength'=>255,'empty'=>'(Select Title)')); ?>
	<?php echo $form->textFieldRow($UserData,'s_fname',array('class'=>'span5','maxlength'=>255)); ?>
	<?php echo $form->textFieldRow($UserData,'s_lname',array('class'=>'span5','maxlength'=>255)); ?>
	<?php echo $form->dropDownListRow($UserData,'s_country_id',Countries::model()->getCountries(),array('class'=>'span5','maxlength'=>255,'empty'=>'(Select Country)')); ?>
	<?php echo $form->textFieldRow($UserData,'s_city',array('class'=>'span5','maxlength'=>255)); ?>
	<?php echo $form->textFieldRow($UserData,'s_zipcode',array('class'=>'span5','maxlength'=>255)); ?>
	<?php echo $form->textFieldRow($UserData,'s_phone_day',array('class'=>'span5','maxlength'=>255)); ?>
	<?php echo $form->textFieldRow($UserData,'s_phone_evening',array('class'=>'span5','maxlength'=>255)); ?>
	<?php echo $form->textFieldRow($UserData,'s_address',array('class'=>'span5','maxlength'=>255)); ?>
	<?php echo $form->textFieldRow($UserData,'s_address2',array('class'=>'span5','maxlength'=>255)); ?>


	<h2>Billing information</h2>
	<?php echo $form->dropDownListRow($UserData,'b_title',array('1'=>'Mr','2'=>'Mrs','3'=>'Miss','4'=>'Dr'),array('class'=>'span5','maxlength'=>255,'empty'=>'(Select Title)')); ?>
	<?php echo $form->textFieldRow($UserData,'b_fname',array('class'=>'span5','maxlength'=>255)); ?>
	<?php echo $form->textFieldRow($UserData,'b_lname',array('class'=>'span5','maxlength'=>255)); ?>
	<?php echo $form->dropDownListRow($UserData,'b_country_id',Countries::model()->getCountries(),array('class'=>'span5','maxlength'=>255,'empty'=>'(Select Country)')); ?>
	<?php echo $form->textFieldRow($UserData,'b_city',array('class'=>'span5','maxlength'=>255)); ?>
	<?php echo $form->textFieldRow($UserData,'b_zipcode',array('class'=>'span5','maxlength'=>255)); ?>
	<?php echo $form->textFieldRow($UserData,'b_phone_day',array('class'=>'span5','maxlength'=>255)); ?>
	<?php echo $form->textFieldRow($UserData,'b_phone_evening',array('class'=>'span5','maxlength'=>255)); ?>
	<?php echo $form->textFieldRow($UserData,'b_address',array('class'=>'span5','maxlength'=>255)); ?>
	<?php echo $form->textFieldRow($UserData,'b_address2',array('class'=>'span5','maxlength'=>255)); ?>


	<div style="clear: both;"></div>
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
