<!--====================================== end row ================================================-->   
<div class="row">	
    <div class="wrapper">


        <div class="span12" style="margin-top:-12px;"> 
            <img src="<?= Yii::app()->request->baseUrl; ?>/media/<?= $category_img ?>" width="980" height="345" alt="" style="width:980px !important;height:345px !important;"/>
        </div>
    </div>
</div> 
<!--====================================== end row ================================================-->  
<div class="row">	
    <div class="wrapper">    

        <div class="span3 static no_bg topMargin10"><!--//// content //// -->                
            <? //$current_url=Yii::app()->request->requestUri;?>
            <!--<label class="<? //if($current_url==Yii::app()->request->baseUrl.'/home/babygrows'){echo 'checkbox active';}else{echo 'checkbox';} ?>">BABY GROWS<input type="checkbox" <? //if($current_url==Yii::app()->request->baseUrl.'/home/babygrows'){echo "checked";}else{echo "";} ?>></label>
            <label class="checkbox">BABY Girl<input type="checkbox" disabled></label>
            <label class="checkbox">BABY BOY<input type="checkbox" disabled></label>                
            <label class="checkbox">UNISEX<input  type="checkbox" disabled></label>-->
            <label class="checkbox">0-3 MONTHS<input name="babygrows_sizes[]" onchange="filtering(this);" value="1" type="checkbox"></label>
            <label class="checkbox">3-6 MONTHS<input name="babygrows_sizes[]" onchange="filtering(this);" value="2" type="checkbox"></label>
            <label class="checkbox">6-9 MONTHS<input name="babygrows_sizes[]" onchange="filtering(this);" value="3" type="checkbox"></label>
            <label class="checkbox">9-12 MONTHS<input name="babygrows_sizes[]" onchange="filtering(this);" value="4" type="checkbox"></label>

            <?php
            /* echo CHtml::checkBoxList($model,'sizes',
              CHtml::listData(Sizes::model()->findAll(), 'id', 'size'),
              array(//'prompt' => 'Select a Category',
              'separator'=>'',
              'ajax' => array(
              'type'=>'POST', //request type
              'url'=>CController::createUrl('home/filtering'), //url to call.
              //Style: CController::createUrl('currentController/methodToCall')
              'update'=>'#test', //selector to update
              //'data'=>'js:javascript statement'
              //leave out the data key to pass all form values through
              )
              )); */
            ?>
            <!--<label for="page_id">Page</label>-->


        </div>

        <div class="span9" > 
            <ul class="thumbnails left20 topMargin20"  id="test">
                <?php foreach ($products as $product) { ?>
                    <li class="span3 xnew">
                        <div class="thumbnail txtcenter">
                            <a href="<?= Yii::app()->request->baseUrl; ?>/home/productDetails/<?= $product->slug; ?>"><img src='<?= Yii::app()->request->baseUrl; ?>/media/products/<?= $product->image; ?>' alt=""></a>
                            <div class="clear"></div> 
                            <a class="title-link" href="<?= Yii::app()->request->baseUrl; ?>/home/productDetails/<?= $product->slug; ?>"><?= $product->title; ?></a>
                            <br/>
                            <span class="site"><?= "&pound;" . $product->price; ?></span>                                
                            <br/>                
                        </div>
                    </li>
                <? } ?>                        
            </ul>
        </div>

    </div>
</div>
<br/><br/>   
<!--====================================== end row ================================================-->  



<script>

                function filtering()
                {
                    var checkedValue = [];
                    var inputElements = document.getElementsByName('babygrows_sizes[]');
                    for (var i = 0; i < inputElements.length; i++) {
                        if (inputElements[i].checked) {
                            checkedValue[i] = inputElements[i].value;
                        }
                    }

                    $.ajax({
                        url: "<?= Yii::app()->request->baseUrl; ?>/home/Filtering?checkedValue=" + checkedValue + "&cat_id=4",
                        type: 'GET',
                        success: function(data) {

                            var test = document.getElementById('test');
                            test.innerHTML = data;
                        }
                    });
                }

</script>