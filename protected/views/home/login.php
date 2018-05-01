<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle = Yii::app()->name . ' - Login';
$this->breadcrumbs = array(
    'Login',
);
?>

<?php // echo Yii::app()->user->getFlash('ErrorMsg'); ?>
<?php if (Yii::app()->user->hasFlash('ErrorMsg')) { ?>
    <div class="forgot-alert alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?php echo Yii::app()->user->getFlash('ErrorMsg'); ?>.
    </div>

<? }
?>





<!--====================================== end row ================================================-->  
<div class="row">   
    <div class="wrapper">
        <div class="span12">
            <br/>
            <div class="page-header">
                <h2 class="site">Sign In</h2>
                <!--<p>Need help? Call<span class="site">&nbsp;<?= Helper::yiiparam('customers_phone'); ?></span>&nbsp;|&nbsp;
                <a href="<?= Yii::app()->request->baseUrl; ?>/<?= Helper::DrawPageLink(5); ?>" class="site">Email customer care</a>&nbsp;|&nbsp;
                <a href="<?= Yii::app()->request->baseUrl; ?>/<?= Helper::DrawPageLink(14); ?>" class="site">Packaging options</a>&nbsp;|&nbsp;
                <a href="<?= Yii::app()->request->baseUrl; ?>/<?= Helper::DrawPageLink(4); ?>" class="site">Shipping information</a>&nbsp;|&nbsp;
                <a href="<?= Yii::app()->request->baseUrl; ?>/<?= Helper::DrawPageLink(8); ?>" class="site">Return policy</a>
                </p>-->
            </div>

            <?php if ($_REQUEST['purchase']) { ?>
                <div class="progres_par">
                    <ul>
                        <? $current_url = Yii::app()->request->requestUri; ?>
                        <li class="<?
                        if ($current_url == Yii::app()->request->baseUrl . '/home/login?purchase=1') {
                            echo 'left0px active';
                        } else {
                            echo 'left0px';
                        }
                        ?>">Sign in<br/><img src="<?= Yii::app()->request->baseUrl; ?>/images/fr.png"/></li>
                        <li>Shipping<br/><img src="<?= Yii::app()->request->baseUrl; ?>/images/fr.png"/></li>
                        <li>Payment<br/><img src="<?= Yii::app()->request->baseUrl; ?>/images/fr.png"/></li>
                        <li>Confirmation<br/><img src="<?= Yii::app()->request->baseUrl; ?>/images/fr.png"/></li>
                    </ul>
                    <div class="hr"></div>
                </div>
            <? } ?>
            <div class="static_block">
                <p class="title site">Registered Customers</p>
                <p class="note">
                    If you have already registered with BRIGHT BABY, then sign in here<br/>
                </p>
                <br/>                

                <?php
                $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'login',
                    'enableClientValidation' => true,
                    'clientOptions' => array(
                        'validateOnSubmit' => true,
                        'htmlOptions' => array('class' => 'form-horizontal'),
                    ),
                ));
                ?>

                <span class="lab-reg2">EMAIL ADDRESS</span>
                <?php echo $form->textField($model, 'username', array('value' => '', 'id' => 'inputEmail')); ?><br/><br/>
                <span class="lab-reg2">PASSWORD</span>
                <?php echo $form->passwordField($model, 'password', array('value' => '', 'placeholder' => '', 'id' => 'inputPassword')); ?>                        
                <?php echo $form->error($model, 'password', array('class' => 'log-error', 'style' => 'font-size: 13px;color:red;')); ?>
                <button name="yt0" type="submit" class="signin_btn"></button>
                <?php $this->endWidget(); ?>

            </div> 

            <div class="static_block">
                <div class="block_content">
                    <p class="title site">NOT REGISTERED? THAT'S OK</p>
                    <p class="note">If you are new to BRIGHT BABY click 'Register Now'</p>
                </div>
                <a href="<?= Yii::app()->request->baseUrl; ?>/home/register" class="register_now_left"></a>
            </div>           

            <div class="static_block">
                <div class="block_content">
                    <p class="title site">forgotten your password?</p>
                    <p class="note">If you have forgotten your password, click 'Change password' and follow instructions to the next page</p>
                </div>
                <!--<a href="<?= Yii::app()->request->baseUrl; ?>/home/changepassword" class="chang_pass_btn">CHANGE PASSWORD</a>-->
                <button type="submit" id="change_btn" class="chang_pass_btn"></button>
            </div>


            <div class="clear"></div>            
        </div>
    </div>
</div>
</div>
<br/><br/>   
<!--====================================== end row ================================================--> 
<div class="row">   
    <div class="wrapper">
        <div class="span12" id="change_div">
            <br/>

            <b class="forrget_pass_span"></b><br/><br/><br/>
            <!--<p>Need help? Call<span class="site">&nbsp;0800 044 5700</span>&nbsp;|&nbsp;
            <a href="" class="site">Email customer care</a>&nbsp;|&nbsp;
            <a href="" class="site">Packaging options</a>&nbsp;|&nbsp;
            <a href="" class="site">Shipping information</a>&nbsp;|&nbsp;
            <a href="" class="site">Return policy</a>
            </p>-->




            <div class="static_block">
                <div class="block_content" style="width:100%;">
                    <p class="title site">Registered Customers</p>
                    <p class="note">
                        Please enter your email address and click on submit<br/>
                        We will then send you an email containing a link that you can create a new password
                    </p>




                    <?php
                    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                        'id' => 'user-form',
                        'enableClientValidation' => true,
                        'htmlOptions' => array('class' => 'form-horizontal'),
                        'clientOptions' => array(
                            'validateOnSubmit' => true,
                        ),
                    ));
                    ?>
                    <label>Enter your registration email address
                        <?php echo $form->textField($forgotPassword, 'email', array('id' => 'inputEmail', 'placeholder' => '', 'class' => 'reg_customer')); ?>
                    </label>

                        <button type="submit" class="send_pass_btn" style="position:relative;float:right;"></button>

                        <?php $this->endWidget(); ?>

                </div>

            </div>




            <div class="clear"></div>            
        </div>
    </div>
</div>
</div>
<br/><br/>    
<!--====================================== end row ================================================-->  
