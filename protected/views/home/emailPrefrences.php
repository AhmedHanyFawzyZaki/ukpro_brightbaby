<div class="row">	
<div class="wrapper">

                <div class="page-header">
          		<h2 class="site">EMAIL PREFRENCES</h2>
                </div> 
    		
            <div class="span3 static no_bg"><!--//// content //// -->
                <ul class="profile_nav">
                        <li><a href="<?=Yii::app()->request->baseUrl;?>/home/address">ADDRESS BOOK</a></li>
                        <li><a href="<?=Yii::app()->request->baseUrl;?>/home/profile">ACCOUNT DETAILS</a></li>
                        <li><a href="<?=Yii::app()->request->baseUrl;?>/home/orders">MY ORDERS</a></li>
                        <li class="active"><a href="<?= Yii::app()->request->baseUrl ;?>/home/emailPrefrences">EMAIL PREFRENCES</a></li>
                        <li><a href="<?=Yii::app()->request->baseUrl;?>/home/credit">CREDIT NOTE</a></li>
                </ul>
           </div>
           <div class="span9"> 
                            <div class="static_block_inner">
								<p class="prefrences_email">Stay up to date with all Bright Baby’s exciting news!</p>
                                <br/><br/>
                                    <?php
                                        if(Yii::app()->user->hasFlash('emailref') )
                                        {
                                            ?>
                                            <div class="alert alert-error margin_custom">
                                                <button type="button" class="close" data-dismiss="alert">&times;</button>                                        
                                                <?php echo Yii::app()->user->getFlash('emailref'); ?>.
                                            </div>

                                            <?
                                        }
                                    ?>
                                <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
                                        'id'=>'user-form',
                                        'enableAjaxValidation'=>false,
                                        'type'=>'horizontal',
                                        'htmlOptions' => array('enctype' => 'multipart/form-data'),

                                    )); ?>
                                <table>
                                    
                                        <tr>
                                            <td>
                                            <?php
                                                    echo $form->radioButtonList($user, 'subscribe',
                                                                    array(  0 => 'Unsubscribed',
                                                                            1 => 'Subscribed'),
                                                                  
                                                                   array(
                                                        'labelOptions'=>array('style'=>'display:inline'), // add this code
                                                        'separator'=>'  ',
                                                    ));
                                                ?>
                                            </td>
                                        </tr>
                                    
                                </table>
                                <br/>
                                <button class="submit_btn" type="submit"></button>
                                <?php $this->endWidget(); ?>
                            </div> 

                                <div class="clear"></div>            
                            </div>
                            
          </div>
</div>
</div>
<br/><br/>   