<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle = Yii::app()->name . ' - Login';
?>


<!--====================================== end row ================================================--> 
<div class="row">	
    <div class="wrapper">
        <div class="span12">
            <br/>


            <?php
            if (Yii::app()->user->hasFlash('ErrorMsg')) {
                ?>
                <div class="alert alert-error" style="margin-left: 0px !important;">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <?php echo Yii::app()->user->getFlash('ErrorMsg'); ?>.
                </div>

                <?
            }
            ?>
            <?php if ($flag) { ?>
                <div class="static_block">

                    <?php
                    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                        'id' => 'user-form',
                        'enableClientValidation' => true,
                        'clientOptions' => array(
                            'validateOnSubmit' => true,
                        ),
                        'htmlOptions' => array('class' => 'form logform'),
                    ));
                    ?>



                    <?php echo $form->passwordFieldRow($model, 'newpassword', array('class' => 'span6')); ?>

                    <?php echo $form->passwordFieldRow($model, 'newpassword_repeat', array('class' => 'span6')); ?>




                    <div class="buttons">
                        <button type="submit" id="change_btn" style="float: right;" class="submit_order"></button>
                    </div>
                    <span class="required">&nbsp;</span>


                    <?php $this->endWidget(); ?>



                </div>
            <?php } ?>
            <div class="clear"></div>            
        </div>
    </div>
</div>
</div>
<br/><br/>   
<!--====================================== end row ================================================-->  