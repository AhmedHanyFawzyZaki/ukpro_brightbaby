<?php
/* @var $this SiteController */

$this->pageTitle='Emak '.Yii::app()->user->username.' Profile';
?>



<div class="content">
<div class="emak-academy">



<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'user-form',
	'enableAjaxValidation'=>true,
	'type'=>'horizontal',
'htmlOptions' => array('enctype' => 'multipart/form-data'),

)); ?>

    <fieldset>
    <legend>Profile Details</legend>
    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($user); ?>


	<?php echo $form->errorSummary($user); ?>

	<?php echo $form->textFieldRow($user,'username',array('class'=>'span5','maxlength'=>50)); ?>

	<?php echo $form->textFieldRow($user,'email',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->passwordFieldRow($user,'password',array('class'=>'span5','maxlength'=>90)); ?>

	<?php echo $form->textFieldRow($user,'fname',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($user,'lname',array('class'=>'span5','maxlength'=>255)); ?>

	<?php 
	   
	   echo " <div class=\"hex \"> <div class=\"controls\">";
       echo 	CHtml::image(Yii::app()->request->baseUrl.'/media/members/'.$user->image,'image',array('width'=>200));
      
	 
	   echo "</div></div>";
	   
	   
	    echo $form->fileFieldRow($user,'image');
?>
   
   
  <?php echo $form->textAreaRow($user,'details',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>
 
 
 
    <?php echo $form->hiddenField($user_details,'lng',array('class'=>'span5','maxlength'=>255)); ?>

    <?php echo $form->hiddenField($user_details,'lat',array('class'=>'span5','maxlength'=>255,'id'=>'Location_longitude')); ?>
 
 
 <?php
   	echo " <div class=\"control-group \"> 
	<label for=\"UserDetails_city\" class=\"control-label\">Country</label>
			 <div class=\"controls\">"; 
    echo   $form->dropDownList($user_details,'country_id',Country::model()->getCountries());
    echo "</div> </div>";
  
  ?>
    
    <?php echo $form->textFieldRow($user_details,'city',array('class'=>'span5','maxlength'=>90)); ?>

   <?php echo $form->textFieldRow($user_details,'state',array('class'=>'span5','maxlength'=>90)); ?>

    <?php echo $form->textFieldRow($user_details,'county',array('class'=>'span5','maxlength'=>90)); ?>

    <?php echo $form->textFieldRow($user_details,'address',array('class'=>'span5','maxlength'=>255)); ?>

    <?php echo $form->textFieldRow($user_details,'address2',array('class'=>'span5','maxlength'=>255)); ?>

    <?php echo $form->textFieldRow($user_details,'zipcode',array('class'=>'span5','maxlength'=>50)); ?>
      
    

    
    <?php echo $form->textFieldRow($user_details,'phone_no',array('class'=>'span5','maxlength'=>255)); ?>

     

	<?php echo $form->checkboxRow($user_details,'remote_trainig'); ?>

    
    <?php
   	echo " <div class=\"control-group \"> 
	<label for=\"UserDetails_city\" class=\"control-label\">Available Range </label>
			 <div class=\"controls\">"; 
    echo   $form->dropDownList($user_details,'available_range',Range::model()->getlistRange());
    echo "</div> </div>";
  
  ?>


    <?php echo $form->textFieldRow($user_details,'fax_no',array('class'=>'span5','maxlength'=>255)); ?>




 
 
 
 
 
 
   
    <div class="row buttons">
        <?php echo CHtml::submitButton($user->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn-large btn-danger btn-hex')); ?>
    </div>

<?php $this->endWidget(); ?>
    
    
    
   
    </fieldset>
   


    </div>
   


    </div>

    
</div>
</div>