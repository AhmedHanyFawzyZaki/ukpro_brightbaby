<!--====================================== end row ================================================-->  
<div class="row">	
<div class="wrapper">
            <div class="span8">
            <br/>
                
                <div class="page-header">
          		<h2 class="site">Create an Order</h2>
                </div>
                 
            
            <div class="static no_bg">
                    
                    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
                        'id'=>'orders-form',
                        'enableAjaxValidation'=>false,
                        'htmlOptions'=>array('class'=>'form-horizontal'),
                    )); ?>

                    <div class="control-group">
                        <label class="control-label" for="name">Full Name</label>
                        <div class="controls">                            
                            <?php //echo $form->textField($model,'fullname',array('id'=>'name','placeholder'=>'')); ?>
                        </div>
                    </div>
                     
                    <div class="control-group">
                        <label class="control-label" for="inputEmail">Email</label>
                        <div  class="controls">                            
                            <?php echo $form->textField($model,'email',array('id'=>'inputEmail','placeholder'=>'')); ?>
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label class="control-label" for="username">User Name</label>
                        <div class="controls">                            
                            <?php echo $form->textField($model,'username',array('id'=>'username','placeholder'=>'')); ?>
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label class="control-label" for="address">Address</label>
                        <div class="controls">                            
                            <?php echo $form->textField($model,'address',array('id'=>'address','placeholder'=>'')); ?>
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label class="control-label" for="phone">Phone</label>
                        <div class="controls">                            
                            <?php echo $form->textField($model,'phone',array('id'=>'phone','placeholder'=>'')); ?>
                        </div>
                    </div>
                    
                    
                    <div class="control-group">
                    <label class="control-label" for="country">Select your Country</label>
                    <div class="controls">
                        <?php echo $form->dropDownList($model,'country_id',Countries::model()->getCountries(),array('id'=>'country')); ?>
                    </div>
                    </div>
                    
                    <div class="control-group">
                        <div class="controls">
                            
                            <?php $this->widget('bootstrap.widgets.TbButton', array(
                            'buttonType'=>'submit',
                            'type'=>'primary',
                            'label'=>$model->isNewRecord ? 'Pay Now' : 'Save',                            
                        )); ?>

                        </div>
                    </div>
                    
                    <?php $this->endWidget(); ?>
            </div> 
            
                <div class="clear"></div>            
            </div>
            <div class="span4">
            <img src="img/b2.jpg" width="100%" height="300px" class="topMargin120"/>
            </div>
</div>
</div>
<br/><br/>   
<!--====================================== end row ================================================-->  