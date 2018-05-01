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
                                    <?
                                    if ($notif) {
                                        echo 'Thank you for your order.<br>
You paid using your Bright Baby credit note. This credit note amount will adjust<br> on your account once the order has been processed.<br><br>

You will receive a confirmation email shortly
';
                                    } else {
                                        echo 'Thank you for your order! You will receive a confirmation email shortly.';
                                    }
                                    ?>
                                </div>

                            </div>


                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>

