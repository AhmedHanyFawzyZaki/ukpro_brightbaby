<div class="row">	
    <div class="wrapper">



        <div class="span3 static no_bg"><!--//// content //// -->
            <ul class="profile_nav">
                <li><a href="<?= Yii::app()->request->baseUrl; ?>/home/address">ADDRESS BOOK</a></li>
                <li><a href="<?= Yii::app()->request->baseUrl; ?>/home/profile">ACCOUNT DETAILS</a></li>                        
                <li class="active"><a href="<?= Yii::app()->request->baseUrl; ?>/home/orders">MY ORDERS</a></li>
                <li><a href="<?= Yii::app()->request->baseUrl; ?>/home/emailPrefrences">EMAIL PREFRENCES</a></li>
                <li><a href="<?= Yii::app()->request->baseUrl; ?>/home/credit">CREDIT NOTE</a></li>
            </ul>
        </div>
        <div class="span9"> 
            <div class="page-header">
                <p class="site account_a">Order number : <?= $orderdata->id; ?></p>
                <p class="site account_a">Order Date : <?php
                    $orderdata->order_date = strtotime($orderdata->order_date);
                    echo date('d M Y h:i ', $orderdata->order_date);
                    ?></p>
            </div> 

            <div class="static_block_inner no_bg">
                <table class="table" style="width:100%;">
                    <thead>
                        <tr>
                            <th>ITEM</th>
                            <th style="width: 200px;">Description</th>
                            <th>COLOR</th>
                            <th>Size</th>
                            <th>QUANTITY</th>
                            <th>Unit Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($orderdetails != '') {
                            foreach ($orderdetails as $order) {
                                ?>                                                                  
                                <tr>
                                    <td>
                                        <img src="<?= Yii::app()->request->baseUrl; ?>/media/products/<?= $order->productName->image; ?>" class="cart_img" style="height: auto !important;width: 90px;" alt="" title=""/>
                                    </td>
                                    <td><?= $order->productName->description; ?></td>
                                    <td>
                                        <?php
                                        if ($order->color) {
                                            echo $order->color;
                                        } else {
                                            
                                        }
                                        ?>
                                    </td>
                                    <td><?= $order->size; ?></td>
                                    <td><?= $order->qty; ?></td>
                                    <td><?= '&pound;' . $order->productName->price; ?></td>
                                </tr>
                                <?
                            }
                        }
                        ?>
                    </tbody>
                </table>  

            </div>
            <div class="cartblock">                                
                <span class="price-t">SUB TOTAL : </span><span id="sub_price2" class="price-value">
                    <?php
                    foreach ($orderdetails as $order) {
                        $subtotal += $order->price * $order->qty;
                    }
                    echo '&pound' . $subtotal;
                    ;
                    ?>
                </span><br/>
                <?php if ($orderdata->postage_val) { ?>
                    <span class="price-t">Postage cost : </span><span id="sub_price2" class="price-value">&pound;<?= $orderdata->postage_val; ?></span><br/>   
                <?php } ?>

                <?php if ($orderdata->discount_val) { ?>
                    <span class="price-t">Discount : </span><span id="sub_price2" class="price-value"><?php echo "&pound;".round(($orderdata->discount_val * $subtotal) / 100, 2); ?></span><br/>
                <?php } ?>
                <hr/>
                <span class="price-t">TOTAL : </span><span class="price-value"><?= '&pound;' . $orderdata->price; ?></span><br/>  
                <a href="<?= Yii::app()->request->baseUrl; ?>/home/orders" class='site'>
                    <img src="<?= Yii::app()->request->baseUrl; ?>/images/back.png"/></a> 
            </div> 


            <div class="clear"></div>            
        </div>

    </div>
</div>
</div>
<br/><br/> 