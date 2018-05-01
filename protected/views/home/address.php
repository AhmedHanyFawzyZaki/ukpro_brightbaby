<?
if (isset($_REQUEST['s'])) {
    echo '
            <script>
                    $(document).ready(function(){        
                 //   $("#shipping_form").show();  
                    window.location.hash = "#shipping_message";          
                });
            </script>
        ';
}
?>

<?
if (isset($_REQUEST['b'])) {
    echo '
            <script>
                    $(document).ready(function(){                            
               //     $("#pilling_form").show();  
                    window.location.hash = "#shipping_message";  
                });
            </script>
        ';
}
?>

<div class="row">	
    <div class="wrapper">

        <div class="page-header">
            <h2 class="site">Address book</h2>
        </div> 

        <div class="span3 static no_bg"><!--//// content //// -->
            <ul class="profile_nav">
                <li class="active"><a href="<?= Yii::app()->request->baseUrl; ?>/home/address">ADDRESS BOOK</a></li>
                <li><a href="<?= Yii::app()->request->baseUrl; ?>/home/profile">ACCOUNT DETAILS</a></li>
                <li><a href="<?= Yii::app()->request->baseUrl; ?>/home/orders">MY ORDERS</a></li>
                <li><a href="<?= Yii::app()->request->baseUrl; ?>/home/emailPrefrences">EMAIL PREFRENCES</a></li>
                <li><a href="<?= Yii::app()->request->baseUrl; ?>/home/credit">CREDIT NOTE</a></li>
            </ul>
        </div>
        <div class="span9 static no_bg"> 
            <span class='txt width650px topMargin20'>
                <div id="shipping_message" class="page-header back_box_full">
                    <?php
                    if (Yii::app()->user->hasFlash('s_save')) {
                        ?>
                        <div class="mailchanging">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <?php echo Yii::app()->user->getFlash('s_save'); ?>.
                        </div>

                        <?
                    }
                    ?>
                    <label class="site account_a">Shipping Address</label>
                    <?php if ($userData->s_address != '') { ?>
                        <ul>                            
                            <li><b><?= $userData->s_address; ?></b></li>
                            <li><br></li>
                            <li><?= $userData->getTitleValue($userData->s_title); ?> <?= $userData->s_fname; ?> <?= $userData->s_lname; ?></li>
                            <li><?= $userData->s_address; ?></li>
                            <li><?= $userData->s_city; ?></li>
                            <li><?= $userData->s_zipcode; ?></li>
                            <li><?= $userData->ShippingUserCountry->name; ?></li>
                            <li>Tel:<?= $userData->s_phone_day; ?></li>
                            <li></li>                                                                                                
                        </ul>

                    <? } ?>

                    <button class="btn btn-link site" id="shipping_btn">Edit Shipping Address </button>

                    <br/>                            

                    <?php
                    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                        'id' => 'user-form',
                        //  'action'=>$this->createUrl('home/editshippingaddress'),
                        'enableAjaxValidation' => true,
                        'htmlOptions' => array('enctype' => 'multipart/form-data', 'class' => 'form-horizontal', 'id' => 'shipping_form'),
                    ));
                    ?>


                    <?php echo $form->hiddenField($userData, 'set', array('value' => 'shipping_address')); ?>
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
                            <?php echo $form->textField($userData, 's_fname', array('placeholder' => '')); ?>
                            <?php echo $form->error($userData, 's_fname', array('class' => 'log-error', 'style' => 'font-size: 13px;color:red;')); ?>
                        </div>
                    </div>

                    <div class="control-group">
                        <?php echo $form->labelEx($userData, 's_lname', array('class' => 'control-label')); ?>
                        <div class="controls">                                        
                            <?php echo $form->textField($userData, 's_lname', array('id' => 'lname', 'placeholder' => '')); ?>
                            <?php echo $form->error($userData, 's_lname', array('class' => 'log-error', 'style' => 'font-size: 13px;color:red;')); ?>
                        </div>
                    </div>


                    <div class="control-group">
                        <?php echo $form->labelEx($userData, 's_country_id', array('class' => 'control-label')); ?>
                        <div class="controls">
                            <?php echo $form->dropDownList($userData, 's_country_id', Countries::model()->getCountries(), array('id' => 'country', 'empty' => '(Select Country)')); ?>
                            <?php echo $form->error($userData, 's_country_id', array('class' => 'log-error', 'style' => 'font-size: 13px;color:red;')); ?>
                        </div>
                    </div>                                


                    <div class="control-group">                                    
                        <?php echo $form->labelEx($userData, 's_address', array('class' => 'control-label')); ?>
                        <div class="controls">        							     
                            <?php echo $form->textField($userData, 's_address', array('placeholder' => '')); ?>
                            <?php echo $form->error($userData, 's_address', array('class' => 'log-error', 'style' => 'font-size: 13px;color:red;')); ?>
                        </div>
                    </div>

                    <div class="control-group">
                        <?php echo $form->labelEx($userData, 's_address2', array('class' => 'control-label')); ?>
                        <div class="controls">                                       
                            <?php echo $form->textField($userData, 's_address2', array('placeholder' => '')); ?>
                            <?php echo $form->error($userData, 's_address2', array('class' => 'log-error', 'style' => 'font-size: 13px;color:red;')); ?>
                        </div>
                    </div>

                    <div class="control-group">
                        <?php echo $form->labelEx($userData, 's_city', array('class' => 'control-label')); ?>
                        <div class="controls">
                            <?php echo $form->textField($userData, 's_city', array('placeholder' => '')); ?>  
                            <?php echo $form->error($userData, 's_city', array('class' => 'log-error', 'style' => 'font-size: 13px;color:red;')); ?>                         
                        </div>
                    </div>


                    <div class="control-group">
                        <?php echo $form->labelEx($userData, 's_zipcode', array('class' => 'control-label')); ?>                                    
                        <div class="controls">        							     
                            <?php echo $form->textField($userData, 's_zipcode', array('placeholder' => '')); ?>     
                            <?php echo $form->error($userData, 's_zipcode', array('class' => 'log-error', 'style' => 'font-size: 13px;color:red;')); ?>                       
                        </div>
                    </div>


                    <div class="control-group">
                        <?php echo $form->labelEx($userData, 's_phone_day', array('class' => 'control-label')); ?>   
                        <div class="controls">        							     
                            <?php echo $form->textField($userData, 's_phone_day', array('placeholder' => '')); ?>
                            <?php echo $form->error($userData, 's_phone_day', array('class' => 'log-error', 'style' => 'font-size: 13px;color:red;')); ?>  
                        </div>
                    </div>

                    <div class="control-group">
                        <?php echo $form->labelEx($userData, 's_phone_evening', array('class' => 'control-label')); ?>   
                        <div class="controls">        							     
                            <?php echo $form->textField($userData, 's_phone_evening', array('placeholder' => '')); ?>         
                            <?php echo $form->error($userData, 's_phone_evening', array('class' => 'log-error', 'style' => 'font-size: 13px;color:red;')); ?>
                        </div>
                    </div>

                    <div class="control-group">
                        <div class="controls">
                            <button class="submit_btn" type="submit"></button>
                        </div>
                    </div>

                    <?php $this->endWidget(); ?>   

                </div>

                <div id="billing_message" class="page-header back_box_full">
                    <?php
                    if (Yii::app()->user->hasFlash('b_save')) {
                        ?>
                        <div class="mailchanging">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <?php echo Yii::app()->user->getFlash('b_save'); ?>.
                        </div>

                        <?
                    }
                    ?>
                    <label class="site account_a">Billing Address</label>
                    <?php if ($userData->b_address != '') { ?>
                        <ul>                            
                            <li><b><?= $userData->b_address; ?></b></li>
                            <li><br></li>
                            <li><?= $userData->getTitleValue($userData->b_title); ?> <?= $userData->b_fname; ?> <?= $userData->b_lname; ?></li>
                            <li><?= $userData->b_address; ?></li>
                            <li><?= $userData->b_city; ?></li>
                            <li><?= $userData->b_zipcode; ?></li>
                            <li><?= $userData->BillingUserCountry->name; ?></li>
                            <li>Tel:<?= $userData->b_phone_day; ?></li>
                            <li></li>                                                                                                
                        </ul>

                    <? } ?>

                    <button class="btn btn-link site" id="pilling_btn">Edit Billing Address </button>                    
                    <br/>                            

                    <?php
                    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                        'id' => 'user-form',
                        //     'action'=>$this->createUrl('home/editbillingaddress'),
                        'enableAjaxValidation' => true,
                        'type' => 'horizontal',
                        'htmlOptions' => array('enctype' => 'multipart/form-data', 'class' => 'form-horizontal', 'id' => 'pilling_form'),
                    ));
                    ?>

                    <?php echo $form->hiddenField($userData, 'set', array('value' => 'billing_address')); ?>
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
                            <?php echo $form->textField($userData, 'b_fname', array('id' => 'fname', 'placeholder' => 'write your first name ...')); ?>
                            <?php echo $form->error($userData, 'b_fname', array('class' => 'log-error', 'style' => 'font-size: 13px;color:red;')); ?>
                        </div>
                    </div>

                    <div class="control-group">
                        <?php echo $form->labelEx($userData, 'b_lname', array('class' => 'control-label')); ?>  
                        <div class="controls">
                            <?php echo $form->textField($userData, 'b_lname', array('id' => 'lname', 'placeholder' => '')); ?>
                            <?php echo $form->error($userData, 'b_lname', array('class' => 'log-error', 'style' => 'font-size: 13px;color:red;')); ?>
                        </div>
                    </div>


                    <div class="control-group">
                        <?php echo $form->labelEx($userData, 'b_country_id', array('class' => 'control-label')); ?>  
                        <div class="controls">
                            <?php echo $form->dropDownList($userData, 'b_country_id', Countries::model()->getCountries(), array('id' => 'country', 'empty' => '(Select Country)')); ?>
                            <?php echo $form->error($userData, 'b_country_id', array('class' => 'log-error', 'style' => 'font-size: 13px;color:red;')); ?>
                        </div>
                    </div>


                    <div class="control-group">
                        <?php echo $form->labelEx($userData, 'b_address', array('class' => 'control-label')); ?>
                        <div class="controls">
                            <?php echo $form->textField($userData, 'b_address', array('placeholder' => '')); ?>
                            <?php echo $form->error($userData, 'b_address', array('class' => 'log-error', 'style' => 'font-size: 13px;color:red;')); ?>
                        </div>
                    </div>


                    <div class="control-group">
                        <?php echo $form->labelEx($userData, 'b_address2', array('class' => 'control-label')); ?>
                        <div class="controls">
                            <?php echo $form->textField($userData, 'b_address2', array('placeholder' => '')); ?>
                            <?php echo $form->error($userData, 'b_address2', array('class' => 'log-error', 'style' => 'font-size: 13px;color:red;')); ?>
                        </div>
                    </div>

                    <div class="control-group">
                        <?php echo $form->labelEx($userData, 'b_city', array('class' => 'control-label')); ?>
                        <div class="controls">
                            <?php echo $form->textField($userData, 'b_city', array('placeholder' => '')); ?> 
                            <?php echo $form->error($userData, 'b_city', array('class' => 'log-error', 'style' => 'font-size: 13px;color:red;')); ?>                          
                        </div>
                    </div>

                    <div class="control-group">
                        <?php echo $form->labelEx($userData, 'b_zipcode', array('class' => 'control-label')); ?>
                        <div class="controls">
                            <?php echo $form->textField($userData, 'b_zipcode', array('placeholder' => '')); ?>        
                            <?php echo $form->error($userData, 'b_zipcode', array('class' => 'log-error', 'style' => 'font-size: 13px;color:red;')); ?>                       
                        </div>
                    </div>


                    <div class="control-group">
                        <?php echo $form->labelEx($userData, 'b_phone_day', array('class' => 'control-label')); ?>
                        <div class="controls">    							     
                            <?php echo $form->textField($userData, 'b_phone_day', array('placeholder' => '')); ?>   
                            <?php echo $form->error($userData, 'b_phone_day', array('class' => 'log-error', 'style' => 'font-size: 13px;color:red;')); ?>                          
                        </div>
                    </div>

                    <div class="control-group">
                        <?php echo $form->labelEx($userData, 'b_phone_evening', array('class' => 'control-label')); ?>
                        <div class="controls">    							                         
                            <?php echo $form->textField($userData, 'b_phone_evening', array('placeholder' => '')); ?>    
                            <?php echo $form->error($userData, 'b_phone_evening', array('class' => 'log-error', 'style' => 'font-size: 13px;color:red;')); ?> 
                        </div>
                    </div>

                    <div class="control-group">
                        <div class="controls">
                            <button class="submit_btn" type="submit"></button>
                        </div>
                    </div>

                    <?php $this->endWidget(); ?>   

                </div>
            </span>
            <div class="clear"></div>
        </div>
    </div>
</div>
</div>
<br/><br/>