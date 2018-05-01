<div class="row">
    <div class="wrapper">
        <div class="span12">
            <br/>
            <div class="page-header">
                <h2 class="site">Payment Confrimation</h2>
                <!--<p>Need help? Call<span class="site">&nbsp;0800 044 5700</span>&nbsp;|&nbsp;
                <a href="" class="site">Email customer care</a>&nbsp;|&nbsp;
                <a href="" class="site">Packaging options</a>&nbsp;|&nbsp;
                <a href="" class="site">Shipping information</a>&nbsp;|&nbsp;
                <a href="" class="site">Return policy</a>
            </p>-->
            </div>

            <div class="progres_par">
                <ul>
                    <li >Sign in<br/><img src="<?= Yii::app()->request->baseUrl; ?>/images/fr.png"/></li>
                    <li>Shipping<br/><img src="<?= Yii::app()->request->baseUrl; ?>/images/fr.png"/></li>
                    <li>Payment<br/><img src="<?= Yii::app()->request->baseUrl; ?>/images/fr.png"/></li>
                    <li class="active">Confirmation<br/><img src="<?= Yii::app()->request->baseUrl; ?>/images/fr.png"/></li>
                </ul>
                <div style="left:315px;" class="hr"></div>
            </div>

            <div class="span9 static no_bg">
                <span class='txt width650px topMargin20'>
                    <div class="page-header" style="border:0 !important">
                        <!--<h3 class="betting-tips score" style="width: 250px ! important;"><span>Payment Confirmation</span></h3>-->
                        <div class="clearfix"></div>
                        <div class="row-fluid">
                            <div class="span12 box2">

                                <div class="msg" id="msg">
                                <?php
                                //echo  $link_url;
								?>
                                <form action="https://payments.epdq.co.uk/ncol/prod/orderstandard.asp?" method="get" >
                                <input type="text" name="PSPID" value="<?= Yii::app()->params['pspid']?>">
                                 <input type="text" name="ORDERID" value="<?=  $model->id?>">
                                  <input type="text" name="AMOUNT" value="100">
                                   <input type="text" name="CURRENCY" value="GBP">
                                    <input type="text" name="LANGUAGE" value="en_US">
                      <input type="text" name="ACCEPTURL" value="<?= urlencode(Yii::app()->request->getBaseUrl(true) . '/home/confirm')?>">
                      <input type="text" name="DECLINEURL" value="<?= urlencode(Yii::app()->request->getBaseUrl(true) . '/home/cancel')?>">
                                 <input type="text" name="SHASIGN" value="<?=  $HashDigest?>">
                                    
                                
                                
                                <button type="submit">click me</button>
								</form>
                                    <a href="<?php echo $link_url;?>" target="_blank">here</a><br>
                                    <a href="https://payments.epdq.co.uk/ncol/prod/orderstandard.asp?PSPID=epdq1038724&ORDERID=200&AMOUNT=4250&CURRENCY=GBP&LANGUAGE=en_US&ACCEPTURL=http%3A%2F%2F192.168.1.200%2Fprojects%2Fteam-a%2FBrightBaby%2Fhome%2Fconfirm&DECLINEURL=http%3A%2F%2F192.168.1.200%2Fprojects%2Fteam-a%2FBrightBaby%2Fhome%2Fdecline&EXCEPTIONURL=http%3A%2F%2F192.168.1.200%2Fprojects%2Fteam-a%2FBrightBaby%2Fhome%2Fexception&CANCELURL=http%3A%2F%2F192.168.1.200%2Fprojects%2Fteam-a%2FBrightBaby%2Fhome%2Fcancel&SHASIGN=8c0d6fea609db2fe3ba19f4d3904ebaf22254817" target="_blank">here2</a>
									<br>
                                    <a href="https://payments.epdq.co.uk/ncol/prod/orderstandard.asp?PSPID=epdq1038724&ORDERID=200&AMOUNT=4250&CURRENCY=GBP&LANGUAGE=en_US&ACCEPTURL=http%3A%2F%2F192.168.1.200%2Fprojects%2Fteam-a%2FBrightBaby%2Fhome%2Fconfirm&DECLINEURL=http%3A%2F%2F192.168.1.200%2Fprojects%2Fteam-a%2FBrightBaby%2Fhome%2Fdecline&EXCEPTIONURL=http%3A%2F%2F192.168.1.200%2Fprojects%2Fteam-a%2FBrightBaby%2Fhome%2Fexception&CANCELURL=http%3A%2F%2F192.168.1.200%2Fprojects%2Fteam-a%2FBrightBaby%2Fhome%2Fcancel&SHASIGN=8c0d6fea609db2fe3ba19f4d3904ebaf22254817" target="_blank">here3</a>

                                </div>

                            </div>


                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>

