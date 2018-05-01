<div class="row">	
<div class="wrapper">

                <div class="page-header">
          		<h2 class="site">My Orders</h2>
                </div> 
    		
            <div class="span3 static no_bg"><!--//// content //// -->
                <ul class="profile_nav">
                        <li><a href="<?=Yii::app()->request->baseUrl;?>/home/address">ADDRESS BOOK</a></li>
                        <li><a href="<?=Yii::app()->request->baseUrl;?>/home/profile">ACCOUNT DETAILS</a></li>
                        <li class="active"><a href="<?=Yii::app()->request->baseUrl;?>/home/orders">MY ORDERS</a></li>
                        <li><a href="<?= Yii::app()->request->baseUrl ;?>/home/emailPrefrences">EMAIL PREFRENCES</a></li>
                        <li><a href="<?=Yii::app()->request->baseUrl;?>/home/credit">CREDIT NOTE</a></li>
                </ul>
           </div>
           <div class="span9"> 

                            <div class="static_block_inner no_bg">
                              <?php if($orders){ ?>
                                      <table class="table cart_tb" style="width:100%;">
                                        <thead>
                                            <tr>
                                              <th>DATE</th>
                                              <th>ORDER NUMBER</th>
                                              <th>STATUS</th>
                                              <th>Price</th>
                                              <th></th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                        <?php                                            
                                            foreach ($orders as $order) { ?>
                                                <tr>

                                                    <td><?php $order->order_date = strtotime($order->order_date) ; echo date('d M Y h:i ',$order->order_date);?></td>
                                                    <td><?= $order->id ;?></td>
                                                    <td><?= Helper::orderStatus($order->status) ;?></td>
                                                    <td><?= '&pound;'.$order->price ;?></td>
                                                    <td><a href="<?= Yii::app()->request->baseUrl ;?>/home/order/<?= $order->id ;?>" class="site">Details</a></td>
                                                </tr>
                                        <? } ?>
                                                                                
                                        </tbody>
                                        </table>  
                              <? }else{echo "<div id='removed_message' class='alert alert-danger'>You have not made an order yet.                                  
                                        <a href='". Yii::app()->request->baseUrl."/home/babygrows'>
                                          <img src='". Yii::app()->request->baseUrl."/images/shop.png'/>
                                        </a>
                                      </div>";} ?>
                            </div> 

                                <div class="clear"></div>            
                            </div>
                            
          </div>
</div>
</div>
<br/><br/>   