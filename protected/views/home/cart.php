

<?php
if ($action == 1) {/// package added
    $msg = '<div class="alert alert-success">Item has been added successfully</div>';
}
if ($action == 2) {/// package removed
    $msg = '<div id="removed_message" class="alert alert-danger">Item has been removed successfully</div>';
}
if ($action == 4) {
    $msg = 'Invalid Discount code.';
}
if ($action == 5) {
    $msg = 'This Discount code is no longer available';
}
if ($action == 6) {
    $msg = $discount->percentage . '% discount applied';
}
?>



<script>
    $(document).ready(function() {
        setTimeout(function() {
            $('#removed_message').hide();
        }, 5000);
    });
</script>


<!--====================================== end row ================================================-->  
<div class="row">	
    <div class="wrapper">
        <div class="span12 ">
            <br/>
            <div class="page-header">   
                <h2 class="site">Shopping Bag</h2>
            </div>     



            <div style="text-align:center;">
                <?php echo $msg; ?>
            </div>

            <?php
            $position = Yii::app()->shoppingCart->isEmpty(1);
            if ($position == 1) {
                ?>
                <div class="alert alert-danger">
                    No item in your shopping bag &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="<?php echo Yii::app()->request->baseUrl; ?>/home/babygrows">
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/continue.png"/>
                    </a>
                </div>
                <br/>
                <?
            } else {
                ?>           
                <div class="static_block no_bg">
                    <table class="table cart_tb">
                        <thead>
                            <tr>
                                <th width="20%">Product</th>
                                <th width="25%">Description</th>
                                <th width="10%">Color</th>
                                <th width="10%">Size</th>
                                <th width="5%">Qty</th>
                                <th width="10%">Unit Price</th>
                                <th width="20%" style="text-align:right;">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($cart as $item) {
                                ?>

                                <tr>
                                    <td>
                                        <a class='site' href="<?= Yii::app()->request->baseUrl; ?>/home/productDetails/<?= $item->slug; ?>"><span class="item_name"><?= $item->title; ?></span><br/>
                                            <img src="<?= Yii::app()->request->baseUrl; ?>/media/products/<?= $item->image; ?>" 
                                                 class="cart_img" style="height: auto !important;width: 90px;" alt="" title=""/></a>                    

                                    </td>
                                    <td>
                                        <?= $item->description; ?>
                                        <div id="test<?= $item->id; ?>"></div> 
                                    </td>
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
                                    <td class="cart-select">
                                        <div class="qty">
                                            <a class="previous" onClick="UpdateQuantityDown(<?= $item->id; ?>,<?= $item->price; ?>)">
                                                -</a>

                                            <input type="text" id="textb<?= $item->id; ?>" name="quantity" class="input-mini" 
                                                   style="margin-bottom: 0px !important;" value="<?= $item->getQuantity(); ?>" disabled>
                                            <a class="next" id="minus" onClick="UpdateQuantityUp(<?= $item->id; ?>,<?= $_SESSION['pro_size_id_' . $item->id] ?>,<?= $item->price; ?>)">
                                                +</a>
                                        </div>
                                    </td>
                                    <td>&pound;<?= $item->price; ?></td>
                                    <td id="sub_price<?= $item->id ?>" style="width:153px;
                                        text-align:right;">
                                        <?= '&pound;' . ($item->price * $item->getQuantity()) ?>
                                        <br/>
                                        <a href="<?php echo Yii::app()->request->baseUrl; ?>/home/Cart/<?= $item->id ?>?action=remove" 
                                           class="delete_item" style="margin-top: 115px;">Remove from bag</a>                                         
                                    </td>
                                </tr>




                            <? } ?> 

                        </tbody>
                    </table>  


                    <div class="cartblock">
                        <span class="price-t">TOTAL : </span><span id="total_price" class="price-value"><?php echo '&pound;' . Yii::app()->shoppingCart->getCost(); ?></span><br/>
                        <?php
                        if (Yii::app()->user->isGuest) {
                            ?>
                            <a class="site_link_left site" href="<?= Yii::app()->request->baseUrl; ?>/home/login?purchase=1"></a>
                        <? } else { ?>
                            <a class="site_link_left site" href="<?= Yii::app()->request->baseUrl; ?>/home/shippingdetails"></a>
                        <? } ?>
                        <a class="btn-link newContinue" href="<?= Yii::app()->request->baseUrl; ?>/home/babygrows">CONTINUE SHOPPING</a>
                    </div> 
                </div> 


            <? } ?>
            <div class="clear"></div>            
        </div>
    </div>
</div>
</div>
<br/><br/> 
<!--====================================== end row ================================================-->  


<script>

    function UpdateQuantityUp(flagid, size_id, price) {
        var x = document.getElementById('textb' + flagid).value;
        var quantity = (+x + 1);
        $.ajax({
            url: "<?= Yii::app()->request->baseUrl; ?>/home/updateCart?quantity=" + quantity + "&id=" + flagid + "&size_id=" + size_id,
            type: 'GET',
            success: function(data) {
                if (data != 0) {

                    document.getElementById('sub_price' + flagid).innerHTML = '&pound;' + (quantity * price) + '<br/><a href="<?php echo Yii::app()->request->baseUrl; ?>/home/Cart/<?= $item->id ?>?action=remove" class="delete_item">Remove from bag</a>';

                    total = parseFloat(data);//+parseFloat(cost);                
                    document.getElementById('total_price').innerHTML = '&pound;' + parseInt(total);
                    document.getElementById('textb' + flagid).value = quantity;
                } else {
                    alert('sorry  we can not supply more items from this product currently')
                }
            }
        });
    }

</script>


<script>

    function UpdateQuantityDown(flagid, price) {
        var x = document.getElementById('textb' + flagid).value;
        if (x <= 1) {
            x = 2;

            var vText = document.getElementById('test' + flagid);
            vText.className = "cart-alert";
            vText.innerHTML = '<strong>Do you want to delete this product from your shopping bag?</strong> <a href="<?php echo Yii::app()->request->baseUrl; ?>/home/Cart/<?= $item->id ?>?action=remove" >Yes</a> / <a onclick="test(' + flagid + ')">no</a>';
        }

        var quantity = document.getElementById('textb' + flagid).value = (x - 1);

        //var price = document.getElementById('actprice'+flagid).value;
        $.ajax({
            url: "<?= Yii::app()->request->baseUrl; ?>/home/updateCart?quantity=" + quantity + "&id=" + flagid,
            type: 'GET',
            success: function(data) {
                document.getElementById('sub_price' + flagid).innerHTML = '&pound;' + (quantity * price) + '<br/><a href="<?php echo Yii::app()->request->baseUrl; ?>/home/Cart/<?= $item->id ?>?action=remove" class="delete_item">Remove from bag</a>';
                //document.getElementById('sub_price2').innerHTML='&pound;'+data;
                percentage = parseFloat(<?= (Helper::yiiparam('postage_costs') / 100); ?>);
                total = parseFloat(data);//+parseFloat(cost);
                document.getElementById('total_price').innerHTML = '&pound;' + parseInt(total);
            }
        });

    }

    function test(itemID) {
        var v = document.getElementById('test' + itemID);
        v.className = "";
        v.innerHTML = '';
    }

</script>