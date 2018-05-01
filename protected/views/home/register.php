<!--====================================== end row ================================================-->  
<div class="row">   
<div class="wrapper">
    <div id="test" class="page-header">
        <h2 class="site">Create an account with<br/>bright baby</h2>
    </div>
            <div class="span6">
            	<!--<p class="hint_big">Once you create an account with Bright Baby,<br/>you can personalise your address book and email preferences!
                    </p>-->
            <br/>
            
            <div class="static no_bg">
                   
                    <?php $form=$this->beginWidget('CActiveForm', array(
                        'id'=>'user-register-form',
                        'enableAjaxValidation'=>false,
                        'htmlOptions'=>array('class'=>'form-horizontal'),
                    ));?>
                    

                    <?php echo $form->hiddenField($model,'groups_id',array('value'=>1,'id'=>'inputPassword','placeholder'=>'')); ?>
                     <div class="control-group">                        
                        <?php echo $form->labelEx($model,'email' ,array('class'=>'control-label lab-reg')); ?>
                        <div  class="controls">                            
                            <?php echo $form->textField($model,'email',array()); ?>
                            <?php echo $form->error($model,'email' ,array('class'=>'log-error','style'=>'font-size: 13px;color:red;float: right;')); ?>
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <?php echo $form->labelEx($model,'fname' ,array('class'=>'control-label lab-reg')); ?>
                        <div class="controls">                            
                            <?php echo $form->textField($model,'fname',array()); ?>
                            <?php echo $form->error($model,'fname' ,array('class'=>'log-error','style'=>'font-size: 13px;color:red;float: right;')); ?>
                        </div>
                    </div>

                    <div class="control-group">                        
                        <?php echo $form->labelEx($model,'lname' ,array('class'=>'control-label lab-reg')); ?>
                        <div class="controls">                            
                            <?php echo $form->textField($model,'lname',array()); ?>
                            <?php echo $form->error($model,'lname' ,array('class'=>'log-error','style'=>'font-size: 13px;color:red;float: right;')); ?>
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <?php echo $form->labelEx($model,'password' ,array('class'=>'control-label lab-reg')); ?>
                        <div class="controls">                            
                            <?php echo $form->passwordField($model,'password',array()); ?>
                            <?php echo $form->error($model,'password' ,array('class'=>'log-error','style'=>'font-size: 13px;color:red;float: right;')); ?>
                        </div>
                    </div>

                    <div class="control-group">
                        <?php echo $form->labelEx($model,'password_repeat' ,array('class'=>'control-label lab-reg')); ?>
                        <div class="controls">                            
                            <?php echo $form->passwordField($model,'password_repeat',array()); ?>
                            <?php echo $form->error($model,'password_repeat' ,array('class'=>'log-error','style'=>'font-size: 13px;color:red;float: right;')); ?>
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <?php echo $form->labelEx($model,'country_id' ,array('class'=>'control-label lab-reg')); ?>
                        <div class="controls">                            
                            <?php echo $form->dropDownList($model,'country_id',Countries::model()->getCountries(),array('id'=>'tel','empty'=>'Select Country','options'=>array(227=>array('selected'=>'selected')))); ?>
                            <?php echo $form->error($model,'country_id' ,array('class'=>'log-error','style'=>'font-size: 13px;color:red;float: right;')); ?>
                        </div>
                    </div>
                    
                    <div class="control-group">
                    <div class="controls">
                    
                        <button name="yt0" type="submit" class="reg_btn"></button>
                    </div>
                    </div>
                                        
                    <div class="row buttons">
                        
                    </div>
                <?php $this->endWidget(); ?>   

            </div> 
            
                <div class="clear"></div>            
            </div>
            <div class="span6">
                <img src="<?= Yii::app()->request->baseUrl;?>/images/stay.jpg" width="100%" height="300px" class=""/>
                <?php

                        if(Yii::app()->user->hasFlash('register-success') )
                        {
                            ?>
                            <div class="alert alert-error w">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <?php echo Yii::app()->user->getFlash('register-success'); ?>.
                            </div>

                            <?
                        }

                    ?>
            </div>
            
    <div class="clear"></div>
	<p style="font-size:14px;font-weight:bold;margin-left:22px;"><span style="color:#F00;">*</span> Required Fields </p>     
</div>
</div>
<br/><br/>   
<!--====================================== end row ================================================-->  