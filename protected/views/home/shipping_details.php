<div class="row">	
    <div class="wrapper">

        <div class="page-header">
            <h2 class="site">Shipping Details</h2>
        </div> 

        <div class="progres_par">
            <ul>
                <? $current_url = Yii::app()->request->requestUri; ?>
                <li class="left0px">Sign in<br/><img src="<?= Yii::app()->request->baseUrl; ?>/images/fr.png"/></li>
                <li class="<?
                if ($current_url == Yii::app()->request->baseUrl . '/index.php/home/shippingdetails' || $current_url == Yii::app()->request->baseUrl . '/home/shippingdetails') {
                    echo 'active';
                } else {
                    echo '';
                }
                ?>">Shipping<br/><img src="<?= Yii::app()->request->baseUrl; ?>/images/fr.png"/></li>
                <li>Payment<br/><img src="<?= Yii::app()->request->baseUrl; ?>/images/fr.png"/></li>
                <li>Confirmation<br/><img src="<?= Yii::app()->request->baseUrl; ?>/images/fr.png"/></li>
            </ul>
            <div class="hr"></div>
        </div>

        <div class="span9 static no_bg"> 
            <span class='txt width650px' style="width:815px;">
                <div class="page-header no_border">

                    <div class="control-group">                                
                        <label class="control-label" style="color:#640092;font-weight:bold;">SHIPPING ADDRESS</label>
                    </div>


                    <?php
                    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                        'id' => 'shipping-form',
                        'enableAjaxValidation' => true,
                        'type' => 'horizontal',
                        'htmlOptions' => array('enctype' => 'multipart/form-data', 'class' => 'form-horizontal'),
                    ));
                    ?>

                    <p style="font-size:12px;"><span style='color:#F00;'>*</span> Required Fields</p>
                    <div class="control-group">                                    
                        <?php echo $form->labelEx($userData, 's_title', array('class' => 'control-label')); ?>
                        <div class="controls">
                            <?php echo $form->dropDownList($userData, 's_title', array('1' => 'Mr', '2' => 'Mrs', '3' => 'Miss', '4' => 'Dr'), array('maxlength' => 255, 'empty' => '(Select Title)')); ?>
                            <?php echo $form->error($userData, 's_title', array('class' => 'log-error', 'style' => 'font-size: 13px;color:red;')); ?>
                        </div>
                    </div>

                    <div class="control-group">                                    
                        <?php echo $form->labelEx($userData, 's_fname', array('class' => 'control-label')); ?>
                        <div class="controls">                                        
                            <?php echo $form->textField($userData, 's_fname', array()); ?>
                            <?php echo $form->error($userData, 's_fname', array('class' => 'log-error', 'style' => 'font-size: 13px;color:red;')); ?>
                        </div>
                    </div>

                    <div class="control-group">
                        <?php echo $form->labelEx($userData, 's_lname', array('class' => 'control-label')); ?>                                    
                        <div class="controls">                                        
                            <?php echo $form->textField($userData, 's_lname', array()); ?>
                            <?php echo $form->error($userData, 's_lname', array('class' => 'log-error', 'style' => 'font-size: 13px;color:red;')); ?>
                        </div>
                    </div>

                    <div class="control-group">
                        <?php
                        $er = "";
                        if ($email_error) {
                            $er = "error";
                        }
                        ?>
                        <label class="control-label <?php echo $er; ?> required">Email<span class="required">*</span></label>                                  
                        <div class="controls">                                        
                            <input name="email" type="text" value="<?php echo Yii::app()->user->getState("email"); ?>" />
                            <span class="log-error" style="font-size: 13px;color:red;"><?php echo $email_error; ?></span>
                        </div>
                    </div>


                    <div class="control-group">
                        <?php echo $form->labelEx($userData, 's_country_id', array('class' => 'control-label')); ?>    
                        <div class="controls">
                            <?php echo $form->dropDownList($userData, 's_country_id', Countries::model()->getCountries(), array('empty' => '(Select Country)')); ?>
                            <?php echo $form->error($userData, 's_country_id', array('class' => 'log-error', 'style' => 'font-size: 13px;color:red;')); ?>
                        </div>
                    </div>                                


                    <div class="control-group">                                    
                        <?php echo $form->labelEx($userData, 's_address', array('class' => 'control-label')); ?>
                        <div class="controls">        							     
                            <?php echo $form->textField($userData, 's_address', array()); ?>
                            <?php echo $form->error($userData, 's_address', array('class' => 'log-error', 'style' => 'font-size: 13px;color:red;')); ?>
                            <p class="aside_msg">if shipping to a work address, please include the company name.</p>
                        </div>
                    </div>

                    <div class="control-group">
                        <?php echo $form->labelEx($userData, 's_address2', array('class' => 'control-label')); ?>
                        <div class="controls">                                       
                            <?php echo $form->textField($userData, 's_address2', array()); ?>
                            <?php echo $form->error($userData, 's_address2', array('class' => 'log-error', 'style' => 'font-size: 13px;color:red;')); ?>                                           
                        </div>
                    </div>

                    <div class="control-group">
                        <?php echo $form->labelEx($userData, 's_city', array('class' => 'control-label')); ?>
                        <div class="controls">
                            <?php echo $form->textField($userData, 's_city', array()); ?> 
                            <?php echo $form->error($userData, 's_city', array('class' => 'log-error', 'style' => 'font-size: 13px;color:red;')); ?>                          
                        </div>
                    </div>


                    <div class="control-group">
                        <?php echo $form->labelEx($userData, 's_zipcode', array('class' => 'control-label')); ?>
                        <div class="controls">        							     
                            <?php echo $form->textField($userData, 's_zipcode', array()); ?>
                            <?php echo $form->error($userData, 's_zipcode', array('class' => 'log-error', 'style' => 'font-size: 13px;color:red')); ?>                         
                        </div>
                    </div>


                    <div class="control-group">
                        <?php echo $form->labelEx($userData, 's_phone_day', array('class' => 'control-label')); ?>
                        <div class="controls">        							     
                            <?php echo $form->textField($userData, 's_phone_day', array()); ?>
                            <?php echo $form->error($userData, 's_phone_day', array('class' => 'log-error', 'style' => 'font-size: 13px;color:red')); ?>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="phone-evening">Mobile</label>
                        <div class="controls">        							     
                            <?php echo $form->textField($userData, 's_phone_evening', array()); ?>
                        </div>
                    </div>

                    <!---------------------------------------Billing------------------------------------------->
                    <div style="clear:both;"></div>
                    <div style="clear:both; background:#E9E0EF;color:#663399;height:38px;width:784px">
                        <?php echo CHtml::label('ENTER SEPARATE BILLING ADDRESS', 'billing', array('id' => 'fax', 'style' => 'width:280px;float:left;margin-left:40px;margin-top:8px;')); ?>
                        <?= CHtml::radioButton('billing', false, array('style' => 'float:left;margin-top:12px;', 'value' => '1', 'id' => 'bllng', 'onchange' => 'javascript:$("#billing_data").show()')); ?>
                        <?php echo CHtml::label('USE SHIPPING ADDRESS AS BILLING ADDRESS', 'billing', array('id' => 'fax2', 'style' => 'float:left;margin-left:40px;width:361px;margin-top:8px;')); ?>
                        <?= CHtml::radioButton('billing', true, array('value' => '0', 'id' => 'bllng2', 'onchange' => 'javascript:$("#billing_data").hide()', 'style' => 'float:left;margin-top:12px;')); ?>

                    </div>
                    <div style="clear:both;"><br></div>
                    <div id="billing_data" style="display:none;">
                        <div class="control-group">                                
                            <label class="control-label" style="color:#640092;font-weight:bold;">BILLING ADDRESS</label>
                        </div>
                        <div class="control-group">                                
                            <?php echo $form->labelEx($userData, 'b_title', array('class' => 'control-label')); ?>
                            <div class="controls">
                                <?php echo $form->dropDownList($userData, 'b_title', array('1' => 'Mr', '2' => 'Mrs', '3' => 'Miss', '4' => 'Dr'), array('maxlength' => 255, 'empty' => '(Select Title)')); ?>
                                <?php echo $form->error($userData, 'b_title', array('class' => 'log-error', 'style' => 'font-size: 13px;color:red;')); ?>
                            </div>
                        </div>

                        <div class="control-group">                                
                            <?php echo $form->labelEx($userData, 'b_fname', array('class' => 'control-label')); ?>
                            <div class="controls">
                                <?php echo $form->textField($userData, 'b_fname', array()); ?>
                                <?php echo $form->error($userData, 'b_fname', array('class' => 'log-error', 'style' => 'font-size: 13px;color:red;')); ?>
                            </div>
                        </div>

                        <div class="control-group">                                
                            <?php echo $form->labelEx($userData, 'b_lname', array('class' => 'control-label')); ?>
                            <div class="controls">
                                <?php echo $form->textField($userData, 'b_lname', array()); ?>
                                <?php echo $form->error($userData, 'b_lname', array('class' => 'log-error', 'style' => 'font-size: 13px;color:red;')); ?>
                            </div>
                        </div>


                        <div class="control-group">
                            <?php echo $form->labelEx($userData, 'b_country_id', array('class' => 'control-label')); ?>
                            <div class="controls">
                                <?php echo $form->dropDownList($userData, 'b_country_id', Countries::model()->getCountries(), array('empty' => '(Select Country)')); ?>
                                <?php echo $form->error($userData, 'b_country_id', array('class' => 'log-error', 'style' => 'font-size: 13px;color:red;')); ?>
                            </div>
                        </div>


                        <div class="control-group">
                            <?php echo $form->labelEx($userData, 'b_address', array('class' => 'control-label')); ?>
                            <div class="controls">
                                <?php echo $form->textField($userData, 'b_address', array()); ?>
                                <?php echo $form->error($userData, 'b_address', array('class' => 'log-error', 'style' => 'font-size: 13px;color:red;')); ?>
                            </div>
                        </div>


                        <div class="control-group">
                            <?php echo $form->labelEx($userData, 'b_address2', array('class' => 'control-label')); ?>
                            <div class="controls">
                                <?php echo $form->textField($userData, 'b_address2', array()); ?>
                                <?php echo $form->error($userData, 'b_address2', array('class' => 'log-error', 'style' => 'font-size: 13px;color:red;')); ?>
                            </div>
                        </div>

                        <div class="control-group">
                            <?php echo $form->labelEx($userData, 'b_city', array('class' => 'control-label')); ?>
                            <div class="controls">
                                <?php echo $form->textField($userData, 'b_city', array()); ?>   
                                <?php echo $form->error($userData, 'b_city', array('class' => 'log-error', 'style' => 'font-size: 13px;color:red;')); ?>                        
                            </div>
                        </div>

                        <div class="control-group">
                            <?php echo $form->labelEx($userData, 'b_zipcode', array('class' => 'control-label')); ?>
                            <div class="controls">
                                <?php echo $form->textField($userData, 'b_zipcode', array()); ?>    
                                <?php echo $form->error($userData, 'b_zipcode', array('class' => 'log-error', 'style' => 'font-size: 13px;color:red;')); ?>                        
                            </div>
                        </div>


                        <div class="control-group">
                            <?php echo $form->labelEx($userData, 'b_phone_day', array('class' => 'control-label')); ?>
                            <div class="controls">                                   
                                <?php echo $form->textField($userData, 'b_phone_day', array()); ?>
                                <?php echo $form->error($userData, 'b_phone_day', array('class' => 'log-error', 'style' => 'font-size: 13px;color:red;')); ?>                             
                            </div>
                        </div>

                        <div class="control-group">
                            <?php echo $form->labelEx($userData, 'b_phone_evening', array('class' => 'control-label')); ?>
                            <div class="controls">                                                       
                                <?php echo $form->textField($userData, 'b_phone_evening', array()); ?>  
                                <?php echo $form->error($userData, 'b_phone_evening', array('class' => 'log-error', 'style' => 'font-size: 13px;color:red;')); ?> 

                            </div>

                        </div>

                    </div>  
                    <p>Please ensure that your billing address matches the address held by your card issurer.</p>                          
                </div>

                <div style="clear:both;">

                </div>

                <div class="control-group">
                    <div class="controls">

                        <button style="float: right;" class="site_link_left" type="submit"></button>
                    </div>
                </div>                       

                <?php $this->endWidget(); ?> 

        </div>                    
    </div>
</div>
</div>
</div>