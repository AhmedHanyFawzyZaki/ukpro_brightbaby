<div class="row">	
    <div class="wrapper">

        <div class="page-header">
            <h2 class="site">Account details</h2>
        </div> 

        <div class="span3 static no_bg"><!--//// content //// -->
            <ul class="profile_nav">
                <li><a href="<?= Yii::app()->request->baseUrl; ?>/home/address">ADDRESS BOOK</a></li>
                <li class="active"><a href="<?= Yii::app()->request->baseUrl; ?>/home/profile">ACCOUNT DETAILS</a></li>
                <li><a href="<?= Yii::app()->request->baseUrl; ?>/home/orders">MY ORDERS</a></li>
                <li><a href="<?= Yii::app()->request->baseUrl; ?>/home/emailPrefrences">EMAIL PREFRENCES</a></li>
                <li><a href="<?= Yii::app()->request->baseUrl; ?>/home/credit">CREDIT NOTE</a></li>
            </ul>
        </div>

        <div class="span9">                            
            <div id="pass" class="static_block_inner">
                <p class="title site">change your password</p>
                <br/>  
                <?php
                if (Yii::app()->user->hasFlash('passwordchanging')) {
                    ?>
                    <div class="mailchanging">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <?php echo Yii::app()->user->getFlash('passwordchanging'); ?>.
                    </div>

                    <?
                }
                ?>

                <?php
                $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                    'id' => 'user-form',
                    'enableAjaxValidation' => false,
                    'type' => 'horizontal',
                    'action' => $this->createUrl('home/changepassword'),
                    'htmlOptions' => array('class' => 'form-horizontal', 'enctype' => 'multipart/form-data'),
                ));
                ?>

                <table>


                    <tr>
                        <td width="200px">
                            New password
                        </td>    
                        <td>
                            <?php echo $form->passwordField($model, 'newpassword', array('id' => 'new-password')); ?>
                            <?php echo $form->error($model, 'newpassword', array('class' => 'log-error', 'style' => 'font-size: 13px;color:red;')); ?>
                        </td>
                    </tr>

                    <tr>
                        <td width="200px">
                            Confirm New password
                        </td>
                        <!--<td><input type="text" id="" placeholder="Confirm New email address ..." ></td>-->
                        <td>
                            <?php echo $form->passwordField($model, 'newpassword_repeat'/* , array('id'=>'cnew-password') */); ?>
                            <?php echo $form->error($model, 'newpassword_repeat', array('class' => 'log-error', 'style' => 'font-size: 13px;color:red;')); ?>
                        </td>
                    </tr>

                </table>
                <br/>
                <button class="submit_btn" type="submit"></button>
                <?php $this->endWidget(); ?>
            </div> 


            <div class="static_block_inner">
                <p class="title site">change your email address</p>
                <br/>
                <?php
                if (Yii::app()->user->hasFlash('mailupdated')) {
                    ?>
                    <div class="mailchanging">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <?php echo Yii::app()->user->getFlash('mailupdated'); ?>.
                    </div>

                    <?
                }
                ?>

                <?php
                $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                    'id' => 'user-form',
                    'enableAjaxValidation' => false,
                    'type' => 'horizontal',
                    'action' => $this->createUrl('home/changemail'),
                    'htmlOptions' => array('class' => 'form-horizontal', 'enctype' => 'multipart/form-data'),
                ));
                ?>


                <table>

<!--<tr>
        <td>Currnet Email</td>
    <!--<td><input type="password" id="" placeholder="Currnet password" ></td>-->
    <!--<td><?php // echo $form->textField($model,'email', array('id'=>'new-password','placeholder'=>$userData->email));  ?></td>
</tr>-->

                    <tr>
                        <td width="200px">New email address</td>
                        <!--<td><input type="password" id="" placeholder="New password ..." ></td>-->
                        <td><?php echo $form->textField($model, 'newmail', array('id' => 'new-password')); ?></td>
                    </tr>

                    <tr>
                        <td width="200px">Confirm New email address</td>
                        <!--<td><input type="password" id="" placeholder="Confirm New password ..." ></td>-->
                        <td><?php echo $form->textField($model, 'newmail_repeat', array('id' => 'cnew-password')); ?>
                            <?php echo $form->error($model, 'newmail_repeat', array('class' => 'log-error', 'style' => 'font-size: 13px;color:red;')); ?>
                        </td>
                    </tr>

                </table>
                <br/>
                <button class="submit_btn" type="submit"></button>
                <?php $this->endWidget(); ?> 
            </div> 


            <div id="name" class="static_block_inner">
                <p class="title site">change your name</p>
                <br/>
                <?php
                if (Yii::app()->user->hasFlash('fullnamechange')) {
                    ?>
                    <div class="mailchanging">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <?php echo Yii::app()->user->getFlash('fullnamechange'); ?>.
                    </div>

                    <?
                }
                ?>
                <?php
                $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                    'id' => 'user-form',
                    'enableAjaxValidation' => false,
                    'type' => 'horizontal',
                    'action' => $this->createUrl('home/changename'),
                    'htmlOptions' => array('class' => 'form-horizontal', 'enctype' => 'multipart/form-data'),
                ));
                ?>

                <table>     
                    <tr>                                           	    
                        <td width="200px">Current First name : <?= $userData->fname; ?></td>
                        <td><?php echo $form->textField($newname, 'new_firstname', array('id' => 'cnew-password')); ?></td>
                    </tr>                                            

                    <tr>
                        <!--<td>New Fullname <input type="text" id="" placeholder="New First name ..." ></td>-->
                        <td width="200px">Current Last Name : <?= $userData->lname; ?></td>
                        <td><?php echo $form->textField($newname, 'new_lastname', array('id' => 'cnew-password')); ?></td>
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