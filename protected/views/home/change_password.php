<!--====================================== end row ================================================-->  
<div class="row">	
<div class="wrapper">
            <div class="span12">
            <br/>
                
          		<span class="gradient site_btn">Change Password</span><br/><br/><br/>
                <p>Need help? Call<span class="site">&nbsp;0800 044 5700</span>&nbsp;|&nbsp;
                <a href="" class="site">Email customer care</a>&nbsp;|&nbsp;
                <a href="" class="site">Packaging options</a>&nbsp;|&nbsp;
                <a href="" class="site">Shipping information</a>&nbsp;|&nbsp;
                <a href="" class="site">Return policy</a>
                </p>
                 
            
            <div class="static_block">
			        <p class="title">Change Password</p>
                    <p class="note">please follow these steps .</p>
                    <br/>                    
                        <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
                                'id'=>'user-form',
                                'enableAjaxValidation'=>true,
                                'type'=>'horizontal',
                                'htmlOptions' => array('class'=>'form-horizontal','enctype' => 'multipart/form-data'),
                            )); 
                        ?>
                    
                    <div class="control-group">
                        <label class="control-label" for="inputPassword">Current Password</label>
                        <div class="controls">
                            <input type="password" id="inputPassword" placeholder="">
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label class="control-label" for="new-password">New Password</label>
                        <div class="controls">                    
                            <?php echo $form->passwordField($model,'newpassword', array('id'=>'new-password','placeholder'=>'')); ?>
                        </div>
                    </div> 

                    <div class="control-group">
                        <label class="control-label" for="cnew-password">Confirm Password</label>
                        <div class="controls">                    
                            <?php echo $form->passwordField($model, 'newpassword_repeat', array('id'=>'cnew-password','placeholder'=>'')); ?>
                        </div>
                    </div>
                    
                    
                    <div class="control-group">
                    <div class="controls">                    
                        <?php $this->widget('bootstrap.widgets.TbButton', array(
                                'buttonType'=>'submit',
                                'type'=>'primary',
                                'label'=>'Save',
                                'htmlOptions'=>array('class'=>'gradient'),
                            )); 
                        ?>
                    </div>
                    </div>
                    
                <?php $this->endWidget(); ?>            
            </div> 
            
                <div class="clear"></div>            
            </div>
            </div>
</div>
</div>
<br/><br/>   
<!--====================================== end row ================================================-->