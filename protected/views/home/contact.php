<?php
/* @var $this SiteController */
/* @var $model ContactForm */
/* @var $form CActiveForm */

$this->pageTitle = Yii::app()->name . ' - Contact Us';
$this->breadcrumbs = array(
    'Contact',
);
?>

<!--====================================== end row ================================================-->  
<div class="row">	
    <div class="wrapper">
        <div class="span12"> 
            <div class="static no_bg">
                <div class="page-header">
                    <h2><?= $page->title; ?></h2>
                    <p class="site"><?= $page->intro; ?></p>
                </div> 
                <span class='txt topMargin20'>
                    <ul>
                        <li>You can telephone us on <span class="site">0113 855 5555</span></li>
                        <li>You can even email us at <span class="site">info@bright-baby.com<?//= Yii::app()->params['adminEmail'] ;?></span></li>
                        <li>You can even send message :</li>
                    </ul> 
                    <br/>  

                    <?php
                    $form = $this->beginWidget('CActiveForm', array(
                        'id' => 'contact-form',
                        'enableClientValidation' => true,
                        'clientOptions' => array(
                            'validateOnSubmit' => true,
                        ),
                        'htmlOptions' => array('class' => 'form-horizontal'),
                    ));
                    ?>

                    <?php if (Yii::app()->user->hasFlash('contact')) { ?>
                        <div class="flash-success">
                            <?php echo Yii::app()->user->getFlash('contact'); ?>
                        </div>
                        <? }?>

                        <?php echo $form->errorSummary($model); ?>


                        <div class="control-group">
                            <label class="control-label" for="name">UserName</label>
                            <div class="controls">
                                <?php echo $form->textField($model, 'username', array('id' => 'name', 'placeholder' => '')); ?>
                                <?php echo $form->error($model, 'username'); ?>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="email">E-mail</label>
                            <div class="controls">
                                <?php echo $form->textField($model, 'email', array('id' => 'email', 'placeholder' => '')); ?>
                                <?php echo $form->error($model, 'email'); ?>
                            </div>
                        </div>


                        <div class="control-group">
                            <label class="control-label" for="subject">Subject</label>
                            <div class="controls">
                                <?php echo $form->textField($model, 'subject', array('id' => 'subject', 'placeholder' => '')); ?>
                                <?php echo $form->error($model, 'subject'); ?>
                            </div>
                        </div>


                        <div class="control-group">
                            <label class="control-label" for="body">Details</label>
                            <div class="controls">
                                <?php echo $form->textArea($model, 'details', array('class' => 'txtarea', 'rows' => 4, 'id' => 'body', 'placeholder' => '')); ?>
                                <?php echo $form->error($model, 'details'); ?>
                            </div>
                        </div>



                        <div class="control-group">
                            <div class="controls">
                                <?php
                                $this->widget('bootstrap.widgets.TbButton', array(
                                    'buttonType' => 'submit',
                                    'type' => 'primary',
                                    'label' => 'Send',
                                    'htmlOptions' => array('class' => 'gradient'),
                                ));
                                ?>
                            </div>
                        </div>


                        <?php $this->endWidget(); ?>

                </span> 
            </div> 
            <div class="clear"></div>            
        </div>
    </div>
</div>
</div>
<br/><br/>   
<!--====================================== end row ================================================-->  