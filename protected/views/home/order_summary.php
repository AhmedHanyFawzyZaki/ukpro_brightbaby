<?php
$dis_value = '0';
if (Yii::app()->session['discount_value']) {
    $dis_value = number_format((Yii::app()->shoppingCart->getCost() * Yii::app()->session['discount_value']) / 100, 2);
}
?>
<?php
Yii::app()->clientScript->registerScript('calc', "
var shp_price = parseFloat('" . Yii::app()->shoppingCart->getCost() . "');
var disc = parseFloat('" . $dis_value . "');
var op_price = " . $shippingAndBilling->ShippingUserCountry->first_option_price . "
function calc(){
        if($('input:radio[name=postage_options]').size() > 0){
            op_price = $('input:radio[name=postage_options]:checked').val();
        }
	$('#postage_value').html('&pound;'+op_price);
	$.ajax({
		url : '" . Yii::app()->request->baseUrl . "/home/calculate',	
		type : 'POST',
		data : {cartprice:shp_price,discount:disc,op:op_price},
		success : function(data){
			$('#option_total').html(data);
		}
	});
}
$('input[name=postage_options]').change(function(){
	calc();	
});
calc();
$('#show_options').click(function(){
	$('#options_radio').toggle();	
});
");
?>
<div class="row">	
    <div class="wrapper">

        <?php
        if ($action == 4) {
            $msg = 'Oops that code is not valid.';
        }
        if ($action == 5) {
            $msg = 'This Discount code is no longer available';
        }
        if ($action == 6) {
            $msg = $discount->percentage . '% discount applied';
        }
        ?>





        <div class="page-header">
            <h2 class="site">Order Summary  <?php echo Yii::app()->session['discount_value']; ?></h2>
    <!--<p>Need help? Call<span class="site">&nbsp;0800 044 5700</span>&nbsp;|&nbsp;
    <a href="" class="site">Email customer care</a>&nbsp;|&nbsp;
    <a href="" class="site">Packaging options</a>&nbsp;|&nbsp;
    <a href="" class="site">Shipping information</a>&nbsp;|&nbsp;
    <a href="" class="site">Return policy</a>
    </p>-->
        </div> 

        <div class="progres_par">
            <ul>
                <? $current_url = Yii::app()->request->requestUri; ?>
                <li class="left0px">Sign in<br/><img src="<?= Yii::app()->request->baseUrl; ?>/images/fr.png"/></li>
                <li >Shipping<br/><img src="<?= Yii::app()->request->baseUrl; ?>/images/fr.png"/></li>
                <li class="<?
                if ($current_url == Yii::app()->request->baseUrl . '/index.php/home/orderdetails' || $current_url == Yii::app()->request->baseUrl . '/home/orderdetails?action=discount') {
                    echo 'active';
                } else {
                    echo '';
                }
                ?>">Payment<br/><img src="<?= Yii::app()->request->baseUrl; ?>/images/fr.png"/></li>
                <li>Confirmation<br/><img src="<?= Yii::app()->request->baseUrl; ?>/images/fr.png"/></li>
            </ul>
            <div class="hr"></div>
        </div>
        <div class="clear"></div>
        <?php if ($msg != '') { ?>
            <div id="removed_message" class="alert alert-danger">                    
                <div class="msg" id="msg">
                    <?php echo $msg; ?>
                </div>
            </div>
        <? } ?>


        <div class="span12"> 
            <!--<div class="page-header">
            <p class="site account_a">Order number : 12452</p>
            <p class="site account_a">Order Date : 22 JUN 2013 22:45</p>
            </div> -->

            <div class="static_block no_bg">
                <table class="table address_tb" style="width:100%;">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Description</th>
                            <th>COLOR</th>
                            <th>Size</th>
                            <th>Qty</th>
                            <th>Unit Price</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($cart as $item) {
                            ?>
                            <tr>
                                <td>
                                    <span style="color:#663399;font-size:14px;font-weight:bold;"><?= $item->title ?></span><br>
                                    <img src="<?= Yii::app()->request->baseUrl; ?>/media/products/<?= $item->image; ?>" class="cart_img" style="height: auto !important;width: 90px;" alt="" title=""/>
                                </td>
                                <td><?= $item->description; ?></td>
                                <td>
                                    <?
                                    if ($_SESSION['pro_color_' . $item->id] == '0' || $_SESSION['pro_color_' . $item->id] == '') {
                                        echo 'Colorless';
                                    } else {
                                        echo $_SESSION['pro_color_' . $item->id];
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?
                                    if ($_SESSION['pro_size_' . $item->id] == '0' || $_SESSION['pro_size_' . $item->id] == '') {
                                        echo 'N/A';
                                    } else {
                                        echo $_SESSION['pro_size_' . $item->id];
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?= $item->getQuantity(); ?>
                                </td>                                                        
                                <td>
                                    <?= '&pound;' . $item->price; ?>
                                </td>
                                <td>
                                    <?= '&pound;' . ($item->price * $item->getQuantity()) ?>
                                </td>
                            </tr>                                                                                                
                        <? } ?>                                                    
                    </tbody>
                </table>
                <table class="table address_tb" style="width:100%;">
                    <thead>
                    </thead>
                    <tbody>
                        <tr>
                            <td >


                                <!--<div class="form_ordr">
                                <span>gift card or promotional code</span>
                                    <form class="form-inline">
                                    <input type="text" placeholder="">
                                    <button type="submit" class="submit_order"></button>
                                    </form>
                                 </div> -->

                                <div class="form_ordr">
                                    <span>Gift Card or Promotional Code</span>
                                    <form class="form-inline" action="<?php echo Yii::app()->request->baseUrl; ?>/home/orderdetails?action=discount" method="post">                                                                                        
                                        <input style="margin-top: 13px;" name="discount_code" value="<?php echo $_POST['discount_code'] ?>"/>                                            
                                        <!--<input style="width: 180px;" type="submit" class="submit_order" name="">-->
                                        <button type="submit" class="submit_order pull-right"></button>
                                    </form>
                                </div>


                                <!--<a href="">How to redeem a gift card</a>-->
                            </td>
                        </tr>
                    </tbody>
                </table> 

                <br/>  





                <table class="table address_tb">
                    <thead>
                        <tr>
                            <th width="50%">Shipping address</th>
                            <th width="50%">Billing address</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php if ($shippingAndBilling != '') { ?>
                                <td>
                                    <ul class="p_s_address">
                                        <li><?= $shippingAndBilling->getTitleValue($shippingAndBilling->s_title); ?> <?= $shippingAndBilling->s_fname; ?> <?= $shippingAndBilling->s_lname; ?></li>
                                        <li><?= $shippingAndBilling->s_address; ?></li>
                                        <li><?= $shippingAndBilling->s_zipcode; ?></li>
                                        <li><?= $shippingAndBilling->s_city; ?></li>
                                        <li><?= $shippingAndBilling->ShippingUserCountry->name; ?></li>

                                        <li><?= $shippingAndBilling->s_phone_day; ?></li>
                                        <li><?= $shippingAndBilling->s_phone_evening; ?></li>

                                    </ul>
                                </td>
                                <td>
                                    <ul class="p_s_address">
                                        <li><?= $shippingAndBilling->getTitleValue($shippingAndBilling->b_title); ?> <?= $shippingAndBilling->b_fname; ?> <?= $shippingAndBilling->b_lname; ?></li>
                                        <li><?= $shippingAndBilling->b_address; ?></li>
                                        <li><?= $shippingAndBilling->b_zipcode; ?></li>
                                        <li><?= $shippingAndBilling->b_city; ?></li>
                                        <li><?= $shippingAndBilling->BillingUserCountry->name; ?></li>

                                        <li><?= $shippingAndBilling->b_phone_day; ?></li>
                                        <li><?= $shippingAndBilling->b_phone_evening; ?></li>
                                    </ul>
                                </td>
                            <? } ?>
                        </tr>
                    </tbody>
                </table>                   

            </div> 
            <div id="options_radio" style="display:none; width:535px; margin-left:8px;" class="static_block_inner usercountry">
                <?php if ($shippingAndBilling->ShippingUserCountry->class == 'uk') { ?>
                    <p><b>SHIPPING TO THE UK</b></p>

                    <label>1st Class signed: &pound;4.50 (2 working days)
                        <input type="radio" name="postage_options" checked='checked'
                               value="<?php echo $shippingAndBilling->ShippingUserCountry->first_option_price; ?>" />
                    </label>

                    <label>Next Day Guaranteed - orders must be placed by 12pm: &pound;6.95 (next day)
                        <input type="radio" name="postage_options" style="margin-left:9px;"
                               value="<?php echo $shippingAndBilling->ShippingUserCountry->second_option_price; ?>" />
                    </label>

                <?php } ?>
            </div>    

            <div class="cartblock">

<!--<a class="site_link_left site" href="<?= Yii::app()->request->baseUrl; ?>/home/"></a>-->
                <?php
                $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'orders-form',
                    'action' => Yii::app()->createUrl('/home/checkout'),
                    'enableClientValidation' => true,
                    'clientOptions' => array(
                        'validateOnSubmit' => true,
                    ),
                    'htmlOptions' => array(
                        'style' => 'margin:0',
                    ),
                ));
                ?>
                <?php echo $form->hiddenField($model, 'discount_id', array('value' => $discount->id)); ?>
                <?php echo $form->hiddenField($model, 'user_id', array('value' => Yii::app()->user->id)); ?>
                <?php //echo $form->hiddenField($model,'price' ,array('value'=>Yii::app()->user->getState('total')));?>
                <?php //echo $form->hiddenField($model,'discount_value' ,array('value'=>$dis_value)  );  ?>
                <?php echo $form->hiddenField($model, 'order_status', array('value' => '1')); ?>

                <?php //echo $form->hiddenField($model,'city' ,array('value'=>$userDetailsData->city)); ?>
                <?php echo $form->hiddenField($model, 'country_id', array('value' => $userDetailsData->country_id)); ?>
                <?php //echo $form->hiddenField($model,'zipcode' ,array('value'=>$userDetailsData->zipcode)); ?>
                <?php //echo $form->hiddenField($model,'phone' ,array('value'=>$userDetailsData->phone_no)); ?>
                <?php //echo $form->hiddenField($model,'address' ,array('value'=>$userDetailsData->address)); ?>
                <?php //echo $form->hiddenField($model,'email' ,array('value'=>$user->email)); ?>
                <?php //echo $form->hiddenField($model,'first_name' ,array('value'=>$user->fname));   ?>
                <?php //echo $form->hiddenField($model,'last_name' ,array('value'=>$user->lname));  ?>


 <!--<a href="<?= Yii::app()->request->baseUrl; ?>/home/checkout" class="add-bt pull-right topMargin5 bot">Add to Bag</a>-->


                <span class="price-t">SUB TOTAL : </span><span class="price-value"><?php echo '&pound;' . Yii::app()->shoppingCart->getCost(); ?></span>
                <div class="clear"></div>
                <span class="price-t">
                    <?php if ($shippingAndBilling->ShippingUserCountry->class == 'uk') { ?><span id="show_options" class="postage">( show postage options )</span><?php } ?>POSTAGE : </span>
                <span class="price-value" id="postage_value"><?= '&pound;' . $shippingAndBilling->ShippingUserCountry->first_option_price; ?></span><br/>  
                <hr/>
                <?php if (Yii::app()->session['discount_value']) { ?>
                    <span class="price-t">Discount:<span>                                   
                            <span class="price-value"><?php echo '&pound;' . number_format((Yii::app()->shoppingCart->getCost() * Yii::app()->session['discount_value']) / 100, 2); ?></span>

                        <? } ?>
                        <div class="clear"></div>
                        <span class="price-t">TOTAL : </span><span class="price-value" id="option_total"><?php
                            $subtotal = (Yii::app()->shoppingCart->getCost() + $shippingAndBilling->ShippingUserCountry->first_option_price) - $dis_value;
                            Yii::app()->user->setState('total', $subtotal);
                            echo '&pound;' . $subtotal;
                            ?></span><br/>
                        <?php echo CHtml::submitButton('', array('class' => 'site_link_left_order site', 'style' => 'width: 182px;')); ?>
                        <?php $this->endWidget(); ?>
                        </div>  

                        <div class="clear"></div>            
                        </div>

                        </div>
                        </div>
                        </div>
                        <br/><br/>