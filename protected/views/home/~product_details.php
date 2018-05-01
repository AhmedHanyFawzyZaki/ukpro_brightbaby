<?php
Yii::app()->clientScript->registerScript('cars', '
if($("#carouselv_01 .cars_img").size() > 0){

    var height = $("#carouselv_01").height();
    var unit_height = $("#carouselv_01 .cars_img").first().height() + 10;
    var top = 0;
    var flag = true;
    var shown = 3;

    function move_up(){
        if(flag &&(top > ((shown * unit_height)-height))){
            flag = false;
            top -=  unit_height;
            $("#carouselv_01").animate({top:top},300,"linear",function(){
                flag = true;
            });
        }
    }
    
    function move_down(){
        if(flag &&(top < 0)){
            flag = false;
            top +=  unit_height;
            $("#carouselv_01").animate({top:top},300,"linear",function(){
                flag = true;
            });
        }
    }
    
    $("#down_ar").click(function(){
        move_up();
    });
    
    $("#top_ar").click(function(){
        move_down();
    });
    
    $("#carouselv_01 .cars_img").click(function(){
        var x = $(this).attr("src").replace("_thum", "");
        document.getElementById("view_img").src = x;
        $("#ex1").zoom();
    });
    
}
');
?>


<!--====================================== end row ================================================-->  
<div class="row">	
    <div class="wrapper">
        <div class="span2 topMargin20">
            <br/><br/>
            <div id="demo-left">
                <div id="vWrapper">
                    <div id="top_ar" style="cursor: pointer;width: 100px;text-align: center;"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/arr_top.png" /></div>
                    <div style="width: 100px;height: 429px;position: relative;overflow: hidden;">
                        <div id="carouselv_01" style="width: 100px;position: absolute;top: 0;">
                            <?php
                            foreach ($photo as $image) {
                                ?>
                                <div style="padding:5px;width: 90px;">                           
                                    <img class="cars_img" style="width: 90px;height: 133px;max-width: 90px;cursor: pointer;" alt="<?php echo trim(preg_replace('/\s\s+/', ' ',strip_tags($details->description))); ?>" src="<?= Yii::app()->request->baseUrl; ?>/gallery/<?= $image->id . '.' . 'jpg'; ?>" />
                                </div>                           
                                <?
                            }
                            ?>                                                    
                        </div>
                    </div>
                    <div id="down_ar" style="cursor: pointer;width: 100px;text-align: center;"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/arr.png" /></div>
                </div>
            </div>                        
        </div>
        <div class="span6 static no_bg">
            <div class="view_center">
                <span class='zoom' id="ex1" style="height:475px;">
                    <img src="<?= Yii::app()->request->baseUrl; ?>/media/products/<?= $details->image; ?>" id="view_img" width="300px" height="400px" alt="<?php echo trim(preg_replace('/\s\s+/', ' ',strip_tags($details->description))); ?>"/>
                </span>
                <div style="margin-top:20%;"><?= $details->description ?></div>
            </div>
        </div>
        <div class="span4 static no_bg">
            <br/><br/>
            <h1 class="site upper"><?= $details->title; ?></h1>
            <h1>&pound;<?= $details->price; ?></h1>
            <div>
                <p>Choose baby's size</p>
                <div class="select_size">                    
                    <?php if (!empty($sizes)) { ?>
                        <img src="<?= Yii::app()->request->baseUrl; ?>/images/fr.png" class="b_size_img"/>
                        <select class="b_size" name="size" id="size_">
                            <option value="">Select a Size</option>
                            <?php foreach ($sizes as $size) { ?>               
                                <?php
                                $dis = "";
                                $style = "";
                                if (ProductsSizes::get_qty($details->id, $size->sze->id) == 0) {
                                    $dis = "disabled";
                                    $style = "style='text-decoration: line-through;color:red;'";
                                }
                                ?>
                                <option <?php echo $style . " " . $dis; ?> value="<?= $size->sze->size; ?>"><?= $size->sze->size; ?></option>
                            <? } ?>
                        </select>
                        <?
                    } else {
                        echo "<span class='not-available'>No Sizes Available</span>";
                    }
                    ?>   
                </div>
            </div>
            <div>
                <p>Choose Color</p>
                <div class="select_size">
                    <?php
                    if (!empty($colors)) {
                        ?>
                        <img src="<?= Yii::app()->request->baseUrl; ?>/images/fr.png" class="b_size_img"/>
                        <select class="b_size" name="color" id="color_">
                            <?
                            foreach ($colors as $color) {
                                ?>  
                                <option value="<?= $color->clr->title; ?>"><?= $color->clr->title; ?></option>
                                <?
                            }
                            ?>

                        </select>
                        <?
                    } else {
                        echo "<span class='not-available'>No Colors Available</span>";
                    }
                    ?> 
                </div>
            </div>
            <div id="shop_cart_btn">
                <?php if (!Yii::app()->shoppingCart->itemAt($details->id)) { ?>
                    <a href="javascript:void(0)" class="add_bag" id="add_crt"></a>
                    <?php
                } else {
                    echo '<a href="' . Yii::app()->request->baseUrl . '/home/shoppingcart" class="in_bag"></a>';
                }
                ?>
            </div>
            <div class="tabbable tab_container">
                <ul class="nav nav-tabs site_tabs">
                    <li class="active">
                        <a href="#tab1" data-toggle="tab">WHY WE LOVE IT</a>
                    </li>
                    <li>
                        <a href="#tab2" data-toggle="tab">DELIVERY</a>
                    </li>
                    <li>
                        <a href="#tab3" data-toggle="tab">SIZING</a>
                    </li>
                </ul>
                <!-- //////// end tap buttons //////// -->
                <div class="tab-content bord">
                    <div class="tab-pane tab_box active" id="tab1">
                        <?= $details->love_it; ?>                                         
                    </div>
                    <div class="tab-pane tab_box" id="tab2">
                        <?= $details->delivery; ?>
                    </div>
                    <div class="tab-pane tab_box" id="tab3">
                        <?= $details->sizing; ?>
                    </div>
                </div>
            </div>

        </div>
        <div style="margin-left:20%;clear:both;">
            <div class="span5" style="border-top:1px solid #CC0000">
                <?php
                if ($similiarProducts) {
                    ?>
                    <h4 style="text-align:center;margin-top:20px;">Your baby will also look great in</h4>
                    <?php
                    foreach ($similiarProducts as $similiarProduct) {
                        ?>
                        <a href="<?= Yii::app()->request->baseUrl; ?>/home/productDetails/<?= $similiarProduct->recommedname->slug; ?>"><img src="<?= Yii::app()->request->baseUrl; ?>/media/products/<?= $similiarProduct->recommedname->image; ?>" alt="<?php echo trim(preg_replace('/\s\s+/', ' ',strip_tags($similiarProduct->recommedname->description))); ?>" style="width:120px !important; height:205px !important;" /></a>            
                        <?
                    }
                }
                ?>
            </div>
            <div class="span4" style="margin-left:8%;">
                <div class="topMargin20 full_width">
                    <strong class="site">LOOK AFTER ME</strong>
                    <p class="hint_big"><?= $details->look_after_me; ?></p>
                    <!-- AddThis Button BEGIN -->
                    <div class="addthis_toolbox addthis_default_style addthis_16x16_style">
                        <span style="float: left;line-height: 15px;margin-right: 5px;">SHARE : </span>
                        <a class="addthis_button_facebook"></a>
                        <a class="addthis_button_twitter"></a>
                        <a class="addthis_button_google_plusone_share"></a>
                        <a class="addthis_button_pinterest_share"></a>
                        <a class="addthis_button_gmail"></a>
                    </div>
                    <script type="text/javascript">var addthis_config = {"data_track_addressbar": false};</script>
                    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-526f83c15dee2150"></script>
                    <!-- AddThis Button END -->

                </div>
                <!--<div class="topMargin20 full_width">
                    <strong class="site">NEED HELP CHOOSING A BABY GROW?</strong>
                    <p class="hint_big">Contact our baby clothing experts on<br/>
                        <span class="big_red">0845 334 7894</span>
                        </p>
                        </div>-->
            </div>
        </div>
    </div>
</div>
<br/><br/>   
<!--====================================== end row ================================================-->   

<?php
Yii::app()->clientScript->registerScript('hhjh', '
    $("#add_crt").click(function(){
        var x = $("#size_").val();
        if(x != ""){
            $.ajax({
                url : "' . Yii::app()->createUrl('home/cart/' . $details->id) . '",
                type : "post",
                data : { color : $("#color_").val() , size : x },
                success : function(data){
                    if(data == "done"){
			$("#recently_added").html("<tr><td><img src=\"' . Yii::app()->request->baseUrl . '/media/products/' . Helper::getLastItemAjax($details->id)->image . '\" style=\"width:70px;height:100px;\"></td><td><h5>' . Helper::getLastItemAjax($details->id)->title . '<br>&pound;' . Helper::getLastItemAjax($details->id)->price . '</h5></td></tr>");
			var x = $("#items_count").html();                                        
			var va = parseFloat(x);                                        
			var dd = (va)+1;  
			$("#items_count").html(dd);
							
			$("#cart_item").click();
			$("#shop_cart_btn").html("<a href=\"' . Yii::app()->request->baseUrl . '/home/shoppingcart\" class=\"in_bag\"></a>");
                    }else{
                        alert(data);
                    }
                }
            });
        }else{
            
        }
    });
');
?>