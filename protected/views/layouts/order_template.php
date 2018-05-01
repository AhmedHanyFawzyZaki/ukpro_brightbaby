<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>New customer profile notification</title>
    </head>


    <body>
        <table width="720" border="0" cellpadding="0" cellspacing="0">
            <tr>
                <td colspan="4" bgcolor="#fff" style="width: 720px;">
                    <img src="<?php echo Yii::app()->request->getBaseUrl(true); ?>/email-template/images/logo.png" width="720" border="0" align="middle" />
                </td>
            </tr>
            <tr bgcolor="#cc0000" style="height: 5px;">
                <td colspan="4" bgcolor="#ff6363" style="height: 5px;">&nbsp;</td>
            </tr>
            <tr bgcolor="#cc0000" style="text-decoration:none; color:#fff; height:25px;">
                <td colspan="4" style="border:none; text-align:center; text-decoration:none; color:#fff;">
                    <div style="list-style:none; margin-top:0px;font-size: 15px;">
                        <a style="flot:left; color:#fff; font-weight:bold; text-decoration:none;" href="<?php echo Yii::app()->request->getBaseUrl(true); ?>/home/babygrows">BABY GROWS</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a style="flot:left; color:#fff; font-weight:bold; text-decoration:none;" href="<?php echo Yii::app()->request->getBaseUrl(true); ?>/home/babygirl">BABY GIRL</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a style="flot:left; color:#fff; font-weight:bold; text-decoration:none;" href="<?php echo Yii::app()->request->getBaseUrl(true); ?>/home/babyboy">BABY BOY</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a style="flot:left; color:#fff; font-weight:bold; text-decoration:none;" href="<?php echo Yii::app()->request->getBaseUrl(true); ?>/home/unisex">UNISEX</a>
                    </div>
                </td>
            </tr>

            <tr style="height: 5px;">
                <td colspan="4" bgcolor="#ff6363" style="height: 5px;">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="4" bgcolor="#fff" height="10">&nbsp;</td>
            </tr>
        </table>









        <table width="720" border="0" cellpadding="0" cellspacing="0" style="font-size: 16px;font-family: Arial, Helvetica, sans-serif;">
            <tr>
                <td style="text-align: center;color: #663399;font-size: 28px;text-transform: uppercase;"><span style="border-bottom: 1px solid #FF0000;display: block;width: 450px;margin: 0 auto;">your order is confirmed</span></td>
            </tr>
            <tr>
                <td style="text-align: center;height: 15px;"></td>
            </tr>
            <tr>
                <td style="text-align: center;">Thank you for shopping at Bright Baby</td>
            </tr>
            <tr>
                <td style="text-align: center;">Your order will be with you shortly!</td>
            </tr>
            <tr>
                <td style="text-align: center;height: 20px;"></td>
            </tr>
        </table>


        <?php
        $order_details = OrdersDetails::model()->findAllByAttributes(array("orders_id" => $content->id));
        ?>
        <table width="720" border="0" cellpadding="0" cellspacing="0" style="font-size: 14px;font-family: Arial, Helvetica, sans-serif;">
            <tr>
                <td style="width: 30px;height: 30px;"></td>
                <td style="width: 200px;">PRODUCT NAME</td>
                <td style="width: 130px;">COLOR</td>
                <td style="width: 130px;">SIZE</td>
                <td style="width: 100px;">QTY</td>
                <td style="width: 100px;">PRICE</td>
                <td style="width: 30px;"></td>
            </tr>
            <?php $sum = 0; ?>
            <?php foreach ($order_details as $ord) { ?>
                <tr style="background: #E6E0EC;">
                    <td style="padding: 5px 0;"></td>
                    <td valign="top" style="padding: 5px 0;font-family: georgia,serif;font-style: italic;"><span style="margin: 0 15px 0 0;display: block;"><?= strip_tags($ord->productName->title); ?></span></td>
                    <td valign="top" style="padding: 5px 0;"><?= $ord->color; ?></td>
                    <td valign="top" style="padding: 5px 0;"><?= $ord->size; ?></td>
                    <td valign="top" style="padding: 5px 0;"><?= $ord->qty; ?></td>
                    <td valign="top" style="padding: 5px 0;"><?= '&pound;' . $ord->price; ?></td>
                    <td style="padding: 5px 0;"></td>
                </tr>
                <?php $sum += $ord->qty * $ord->price; ?>
            <?php } ?>
            <?php if ($content->postage_val) { ?>
                <tr>
                    <td style="padding: 5px 0;"></td>
                    <td style="padding: 5px 0;"></td>
                    <td style="padding: 5px 0;"></td>
                    <td style="padding: 5px 0;"></td>
                    <td style="padding: 5px 0;"></td>
                    <td style="padding: 5px 0;">Postage: &pound;<?php echo $content->postage_val; ?></td>
                    <td style="padding: 5px 0;"></td>
                </tr>
            <?php } ?>
            <?php if ($content->discount_val) { ?>
                <tr>
                    <td style="padding: 5px 0;"></td>
                    <td style="padding: 5px 0;"></td>
                    <td style="padding: 5px 0;"></td>
                    <td style="padding: 5px 0;"></td>
                    <td style="padding: 5px 0;"></td>
                    <td style="padding: 5px 0;">Discount: &pound;<?php echo round(($content->discount_val * $sum) / 100, 2); ?></td>
                    <td style="padding: 5px 0;"></td>
                </tr>
            <?php } ?>
            <tr>
                <td style="padding: 5px 0;"></td>
                <td style="padding: 5px 0;"></td>
                <td style="padding: 5px 0;"></td>
                <td style="padding: 5px 0;"></td>
                <td style="padding: 5px 0;"></td>
                <td style="padding: 5px 0;">Total: &pound;<?php echo $content->price; ?></td>
                <td style="padding: 5px 0;"></td>
            </tr>
        </table>

        <table width="720" border="0" cellpadding="0" cellspacing="0" style="font-size: 14px;font-family: Arial, Helvetica, sans-serif;">
            <tr>
                <td style="width: 30px;height: 30px;"></td>
                <td style="width: 300px;">Billing Address</td>
                <td style="width: 30px;"></td>
                <td style="width: 30px;"></td>
                <td style="width: 180px;">Shipping Address</td>
            </tr>
            <tr>
                <td style="width: 30px;padding: 5px 0 2px 0;background: #E6E0EC;"></td>
                <td style="width: 305px;background: #E6E0EC;padding: 5px 0 2px 0;"><?php echo $content->b_address; ?></td>
                <td style="width: 50px;padding: 5px 0 2px 0;"></td>
                <td style="width: 30px;background: #E6E0EC;padding: 5px 0 2px 0;"></td>
                <td style="width: 305px;background: #E6E0EC;padding: 5px 0 2px 0;"><?php echo $content->s_address; ?></td>
            </tr>
            <tr>
                <td style="width: 30px;padding: 5px 0 2px 0;background: #E6E0EC;"></td>
                <td style="width: 305px;background: #E6E0EC;padding: 5px 0 2px 0;"><?php echo $content->b_city; ?></td>
                <td style="width: 50px;padding: 5px 0 2px 0;"></td>
                <td style="width: 30px;background: #E6E0EC;padding: 5px 0 2px 0;"></td>
                <td style="width: 305px;background: #E6E0EC;padding: 5px 0 2px 0;"><?php echo $content->s_city; ?></td>
            </tr>
            <tr>
                <td style="width: 30px;padding: 5px 0 2px 0;background: #E6E0EC;"></td>
                <td style="width: 305px;background: #E6E0EC;padding: 5px 0 2px 0;"><?php echo $content->BillingUserCountry->name; ?></td>
                <td style="width: 50px;padding: 5px 0 2px 0;"></td>
                <td style="width: 30px;background: #E6E0EC;padding: 5px 0 2px 0;"></td>
                <td style="width: 305px;background: #E6E0EC;padding: 5px 0 2px 0;"><?php echo $content->ShippingUserCountry->name; ?></td>
            </tr>
            <tr>
                <td valign="middle" style="width: 30px;padding: 5px 0 2px 0;background: #E6E0EC;"></td>
                <td valign="middle" style="width: 305px;background: #E6E0EC;padding: 5px 0 2px 0;"><?php echo $content->b_zipcode; ?></td>
                <td valign="middle" style="width: 50px;padding: 5px 0 2px 0;"></td>
                <td valign="middle" style="width: 30px;background: #E6E0EC;padding: 5px 0 2px 0;"></td>
                <td valign="middle" style="width: 305px;background: #E6E0EC;padding: 5px 0 2px 0;"><?php echo $content->s_zipcode; ?></td>
            </tr>
            <tr>
                <td style="width: 30px;height: 35px;"></td>
                <td style="width: 305px;"></td>
                <td style="width: 50px;"></td>
                <td style="width: 30px;"></td>
                <td style="width: 305px;color: #663399;text-align: right;">order number: <?php echo $content->id; ?></td>
            </tr>
        </table>

        <table width="720" border="0" cellpadding="0" cellspacing="0" style="font-size: 16px;font-family: Arial, Helvetica, sans-serif;">
            <tr>
                <td style="text-align: center;height: 15px;"></td>
            </tr>
            <tr>
                <td style="text-align: center;"><img style="width: 65px;" src="<?php echo Yii::app()->request->getBaseUrl(true); ?>/email-template/img/img1.png" alt="" /></td>
            </tr>
            <tr>
                <td style="text-align: center;">Any changes to be made with your order?</td>
            </tr>
            <tr>
                <td style="text-align: center;">Just call the Bright Baby team and we will sort it for you!</td>
            </tr>
            <tr>
                <td style="text-align: center;">0208 8621 5830</td>
            </tr>
            <tr>
                <td style="text-align: center;">info@bright-baby.com</td>
            </tr>
            <tr>
                <td style="text-align: center;height: 20px;"></td>
            </tr>
        </table>











        <?php $sett = Settings::model()->findByPk(1); ?>
        <table class="footer" width="720" border="0" cellpadding="0" cellspacing="0" style="margin-top: 20px;">
            <tr>
                <td width="268">
                    <img src="<?php echo Yii::app()->request->getBaseUrl(true); ?>/email-template/images/left.jpg" border="0" align="middle"/>
                </td>
                <td width="44">
                    <a href="<?php echo $sett->facebook; ?>"><img src="<?php echo Yii::app()->request->getBaseUrl(true); ?>/email-template/images/social1.jpg" border="0" align="middle"/></a>
                </td>
                <td width="4">
                    <img src="<?php echo Yii::app()->request->getBaseUrl(true); ?>/email-template/images/space1.jpg" border="0" align="middle"/>
                </td>
                <td width="44">
                    <a href="<?php echo $sett->twitter; ?>"><img src="<?php echo Yii::app()->request->getBaseUrl(true); ?>/email-template/images/social2.jpg" border="0" align="middle"/></a>
                </td>
                <td width="4">
                    <img src="<?php echo Yii::app()->request->getBaseUrl(true); ?>/email-template/images/space2.jpg" border="0" align="middle"/>
                </td>
                <td width="44">
                    <a href="<?php echo $sett->pinterest; ?>"><img src="<?php echo Yii::app()->request->getBaseUrl(true); ?>/email-template/images/social3.jpg" border="0" align="middle"/></a>
                </td>
                <td width="4">
                    <img src="<?php echo Yii::app()->request->getBaseUrl(true); ?>/email-template/images/space3.jpg" border="0" align="middle"/>
                </td>
                <td width="44">
                    <a href="<?php echo $sett->tumblr; ?>"><img src="<?php echo Yii::app()->request->getBaseUrl(true); ?>/email-template/images/social4.jpg" border="0" align="middle"/></a>
                </td>
                <td width="264">
                    <img src="<?php echo Yii::app()->request->getBaseUrl(true); ?>/email-template/images/right.jpg" border="0" align="middle"/>
                </td>
            </tr>
            <tr>
                <td colspan="9"><img src="<?php echo Yii::app()->request->getBaseUrl(true); ?>/email-template/images/Untitled-1_11.jpg" width="720" height="42" /></td>
            </tr>
            <tr>
                <td colspan="9" align="center" ><span class="" style="text-align:center; display:block; font-family:Arial, Helvetica, sans-serif; font-size:16px; width:100%">This email was sent to <?php echo $content->email; ?></span></td>
            </tr>
            <tr>
                <td colspan="9" align="center" ><span class="" style="text-align:center; display:block; font-family:Arial, Helvetica, sans-serif; font-size:14px; width:100%">To ensure that our messages arrive ( and don't go to junk or bulk email folders)<br />please add info@bright-baby.com to your address book.</span></td>
            </tr>
            <tr>
                <td style="height:10px;" colspan="9"></td>
            </tr>
            <tr>
                <td style="height:10px;" colspan="9"></td>
            </tr>
            <tr>
                <td colspan="9" align="center" ><span class="" style="text-align:center;display:block; font-family:Arial, Helvetica, sans-serif; font-size:14px; width:100%">Company registered address:</span></td>
            </tr>
            <tr>
                <td colspan="9" align="center" ><span class="" style="text-align:center;display:block; font-family:Arial, Helvetica, sans-serif; font-size:14px; width:100%">BRIGHT BABY LTD</span></td>
            </tr>
            <tr>
                <td colspan="9" align="center" ><span class="" style="text-align:center;display:block; font-family:Arial, Helvetica, sans-serif; font-size:14px; width:100%">Registered Office :  <?php echo $sett->address; ?><br />VAT Registration Number is <?php echo $sett->vat; ?>. Company Registered in London number <?php echo $sett->company_registration; ?></span></td>
            </tr>
            <tr>
                <td style="height:10px;" colspan="9"></td>
            </tr>
            <tr>
                <td colspan="9" align="center" ><span class="" style="text-align:center;display:block; font-family:Arial, Helvetica, sans-serif; font-size:14px; width:100%">&copy; 2014 BRIGHT-BABY.com</span></td>
            </tr>
        </table>
    </body>
</html>