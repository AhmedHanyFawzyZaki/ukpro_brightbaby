<div class="row">  
    <div class="wrapper">

        <div class="page-header">
            <h2 class="site">CREDIT NOTE</h2>
        </div>

        <div class="span3 static no_bg"><!--//// content //// -->
            <ul class="profile_nav">
                <li><a href="<?= Yii::app()->request->baseUrl; ?>/home/address">ADDRESS BOOK</a></li>
                <li><a href="<?= Yii::app()->request->baseUrl; ?>/home/profile">ACCOUNT DETAILS</a></li>
                <li><a href="<?= Yii::app()->request->baseUrl; ?>/home/orders">MY ORDERS</a></li>
                <li><a href="<?= Yii::app()->request->baseUrl; ?>/home/emailPrefrences">EMAIL PREFRENCES</a></li>
                <li class="active"><a href="<?= Yii::app()->request->baseUrl; ?>/home/credit">CREDIT NOTE</a></li>


            </ul>
        </div>
        <div class="span9">

            <div class="static_block_inner">
                <p class="title site">your credit &nbsp;(&pound; <? if($userData->user_credit==''){echo '0';}else{echo $userData->user_credit;} ?>)</p>
                <br/>  
                <?php
                if (Yii::app()->user->hasFlash('credit')) {
                    ?>
                    <div class="mailchanging">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <?php echo Yii::app()->user->getFlash('credit'); ?>.
                    </div>

                    <?
                }
                ?>
                <form method="post" action="https://payments.epdq.co.uk/ncol/prod/orderstandard.asp" id="form1" name='form1' hashed="no">
                    <!-- general parameters -->
                    <input type="hidden" name="PSPID" value="<?php echo Yii::app()->params['pspid'] ?>">
                    <input type="hidden" name="ORDERID" value="<?php echo Yii::app()->user->id ."-". time(); ?>">
                    <table>

                        <tr>
                            <td width="200px">
                                Add Credit (&pound;1=1)
                            </td>    
                            <td>
                                <input type="text" id="amount_val" name="amount_val" required="required" />
                            </td>
                        </tr>
    
                    </table>
                    <input type="hidden" name="CURRENCY" value="GBP">
                    <input type="hidden" name="LANGUAGE" value="en_US">
                    <input type="hidden" id="amount" name="AMOUNT" value="">
                    <input type="hidden" name="CN" value="">
                    <input type="hidden" name="EMAIL" value="">
                    <input type="hidden" name="OWNERZIP" value="">
                    <input type="hidden" name="OWNERADDRESS" value="">
                    <input type="hidden" name="OWNERCTY" value="">
                    <input type="hidden" name="OWNERTOWN" value="">
                    <input type="hidden" name="OWNERTELNO" value="">
                    <!-- check before the payment: see Security: Check before the payment -->
                    <input type="hidden" name="SHASIGN" value="">
                    <!-- layout information: see Look and feel of the payment page -->
                    <input type="hidden" name="TITLE" value="BrightBaby">
                    <input type="hidden" name="BGCOLOR" value="">
                    <input type="hidden" name="TXTCOLOR" value="">
                    <input type="hidden" name="TBLBGCOLOR" value="">
                    <input type="hidden" name="TBLTXTCOLOR" value="">
                    <input type="hidden" name="BUTTONBGCOLOR" value="">
                    <input type="hidden" name="BUTTONTXTCOLOR" value="">
                    <input type="hidden" name="LOGO" value="">
                    <input type="hidden" name="FONTTYPE" value="">
                    <!-- post payment redirection: see Transaction feedback to the customer -->
                    <input type="hidden" name="ACCEPTURL" value="<?php echo Yii::app()->request->getBaseUrl(true).'/home/credit';?>">
                    <input type="hidden" name="DECLINEURL" value="<?php echo Yii::app()->request->getBaseUrl(true).'/home/decline';?>">
                    <input type="hidden" name="EXCEPTIONURL" value="<?php echo Yii::app()->request->getBaseUrl(true).'/home/exception';?>">
                    <input type="hidden" name="CANCELURL" value="<?php echo Yii::app()->request->getBaseUrl(true).'/home/cancel';?>">
                    <button class="submit_btn" id="add_credit" type="submit"></button>
                </form>
            </div>

            <div class="clear"></div>            
        </div>

    </div>
</div>
</div>
<br/><br/>   


<?php
Yii::app()->clientScript->registerScript('check_credit','
    $("#add_credit").click(function(){
        var x = parseFloat($("#amount_val").val());
        if(!isNaN(x) && isFinite(x)){
            $("#amount").val(100 * x);
            if($("#form1").attr("hashed") == "done"){
                return true;
            }else{
                get_hash();
                return false;
            }
        }else{
            alert("you must enter a valid number");
            return false;
        }
    });
    
    $("#form1").submit(function(){
        var x = parseFloat($("#amount_val").val());
        if(!isNaN(x) && isFinite(x)){
            $("#amount").val(100 * x);
            if($("#form1").attr("hashed") == "done"){
                return true;
            }else{
                get_hash();
                return false;
            }
            
        }else{
            alert("you must enter a valid number");
            return false;
        }
    });
    
    $("#amount_val").on("input",function(){
        $("#form1").attr("hashed","no");
    });
    
    function get_hash(){
        var am = $("input[name=AMOUNT]").val();
        var cur = $("input[name=CURRENCY]").val();
        var lan = $("input[name=LANGUAGE]").val();
        var order = $("input[name=ORDERID]").val();
        $.ajax({
            url : "'.Yii::app()->request->baseUrl.'/home/get_hash",
            type : "post",
            data : {amount : am, currency : cur, language : lan, order_id : order},
            success : function(data){
                $("input[name=SHASIGN]").val(data);
                $("#form1").attr("hashed","done");
                $("#form1").submit();
            }
        });
    }
');
?>