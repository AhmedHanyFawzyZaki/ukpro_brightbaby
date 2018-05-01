<!--====================================== end row ================================================-->  
<div class="row menu2 gradient">	
    <div class="wrapper">
        <div class="span12">

            <?php echo CHtml::link('', 'http://' . Helper::yiiparam('facebook'), array('target' => '_blank', 'class' => 's f')); ?>

            <?php echo CHtml::link('', 'http://' . Helper::yiiparam('twitter'), array('target' => '_blank', 'class' => 's tw')); ?>

            <?php echo CHtml::link('', 'http://' . Helper::yiiparam('pinterest'), array('target' => '_blank', 'class' => 's p')); ?>

            <?php echo CHtml::link('', 'http://' . Helper::yiiparam('tumblr'), array('target' => '_blank', 'class' => 's te')); ?>
        </div>
    </div>
</div> 
<br/><br/>  





<!--====================================== end row ================================================-->  

<div class="row">   
    <div class="wrapper sub_links">

        <div class="span4 footer1">
            <ul>
                <li><h3>CUSTOMER CARE</h3>
                <li><a href="<?= Yii::app()->request->baseUrl; ?>/<?= Helper::DrawPageLink(5); ?>">Contact Us</a></li>
                <li><a href="<?= Yii::app()->request->baseUrl; ?>/<?= Helper::DrawPageLink(4); ?> ">Shipping Information</a></li>
                <li><a href="<?= Yii::app()->request->baseUrl; ?>/<?= Helper::DrawPageLink(8); ?>">Returns & Exchanges</a></li>
                <li><a href="<?= Yii::app()->request->baseUrl; ?>/<?= Helper::DrawPageLink(11); ?>">Payment Security</a></li>
                <!--<li><a href="<?= Yii::app()->request->baseUrl; ?>/<?= Helper::DrawPageLink(12); ?>">Gift Cards</a></li>-->
                <li><a href="<?= Yii::app()->request->baseUrl; ?>/home/faq">FAQ</a></li>
            </ul>
        </div>

        <div class="span3 footer2">
            <ul>
                <li><h3>ABOUT US</h3></li>
                <li><a href="<?= Yii::app()->request->baseUrl; ?>/<?= Helper::DrawPageLink(7); ?>">The Company</a></li>
                <!--<li><a href="<?= Yii::app()->request->baseUrl; ?>/home/press">Press</a></li>-->
                <li><a href="<?= Yii::app()->request->baseUrl; ?>/<?= Helper::DrawPageLink(10); ?>">Careers</a></li>
                <!--<li><a href="<?= Yii::app()->request->baseUrl; ?>/<?= Helper::DrawPageLink(9); ?>">Affiliates</a></li>-->
                <li><a href="<?= Yii::app()->request->baseUrl; ?>/<?= Helper::DrawPageLink(2); ?>">Policy</a></li>
                <li><a href="<?= Yii::app()->request->baseUrl; ?>/<?= Helper::DrawPageLink(3); ?>">Terms & Conditions</a></li>
            </ul>
        </div>

        <div class="span5">
            <ul>
                <li>
                    <h3>
                        DON'T MISS OUT
                    </h3>
                <li class="">
                    Join the Bright Baby world to be the first to receive the latest updates and exciting news.
                </li>               
                <li>                    
                    <form name="User" action="<?= Yii::app()->request->baseUrl; ?>/home/register" method="post">
                        <input type="text" id="newsletter_mail" class="soft_input" name="mail" placeholder="write your email ..."/>
                </li>
                <li>

                    <input type="submit" class="sign_up" value=" " style="width:316px;height:87px;">
                    </form>
                    <?php /* echo  CHtml::ajaxLink("<span class='sign_up'></span>",Yii::app()->createUrl('home/addnewmail' ),
                      array( // ajaxOptions
                      'type' => 'POST',
                      'beforeSend' => "function( request )
                      {
                      // Set up any pre-sending stuff like initializing progress indicators

                      var email = document.getElementById('newsletter_mail').value;
                      }",
                      'success' => "function( data )
                      {
                      // handle return data
                      if(data==1){
                      var message = document.getElementById('success');
                      message.innerHTML = 'THIS EMAIL ADDRESS IS ALREADY SIGNED-UP';
                      message.style.color = '#A020F0';
                      }else if(data==2){
                      //var message = document.getElementById('success');
                      //message.innerHTML = 'THANK YOU FOR JOINING OUR<br/> BRIGHT BABY WORLD';
                      //message.style.color = '#A020F0';
                      window.location='".Yii::app()->request->baseUrl."/home/register';

                      }else if(data==3){
                      var message = document.getElementById('success');
                      message.innerHTML = 'OOPS!your email address is incorrect';
                      message.style.color = '#A020F0';
                      }else{
                      var message = document.getElementById('success');
                      message.innerHTML = 'Please enter your email first !';
                      }
                      }",
                      //'data' => array('test'=>"js: document.getElementById('newsletter_mail').value ")
                      'data'=>array('email'=>'js:$("#newsletter_mail").val()'),
                      ),
                      array( //htmlOptions
                      'href' => Yii::app()->createUrl( 'home/addnewmail' ),
                      )
                      ); */
                    ?>
                </li>
                <li>                                        
                    <div id="success" style="width: 300px; color:#A020F0;"></div>
                </li>
            </ul>
        </div>




    </div>
</div> 
<br/><br/>  
<!--====================================== end row ================================================-->  
<div class="row">   
    <div class="wrapper">
        <div class="span12 footer">
            <ul>
                <li><img src="<?= Yii::app()->request->baseUrl; ?>/images/sub_logo.png" width="28" height="27" alt="" /></li>
                <li class="copy">Copyright <a href="<?= Yii::app()->request->baseUrl; ?>/index.php">Bright-Baby</a> <?php echo date("Y"); ?></li>
            </ul>

            <ul class="f_links">     
                <li><?= Helper::yiiparam('address'); ?></li>
               <!-- <li><b>Company Registration: </b><?= Helper::yiiparam('company_registration'); ?></li>
                <li><b>VAT: </b><?= Helper::yiiparam('vat'); ?></li>-->
            </ul>
        </div>
    </div>
</div> 



<script>
    $(document).ready(function() {
        $('#myCarousel').carousel({
            interval: 5000
        })
    });
</script>

<script>
    $(document).ready(function() {
        $('#change_btn').click(function() {
            $('#change_div').toggle('slow');
        });
    });
</script>

<script src="<?= Yii::app()->request->baseUrl; ?>/js/jsCarousel-2.0.0.js" type="text/javascript"></script>

<script src='<?= Yii::app()->request->baseUrl; ?>/js/jquery.zoom.js'></script>
<!--<script type="text/javascript">
    $(document).ready(function() {
        $('#carouselv').jsCarousel({onthumbnailclick: function(src) {
                var x = src.replace("_thum", "")
                document.getElementById("view_img").src = x;
                $('#ex1').zoom();
            }, circular: true, masked: false, itemstodisplay: 3, orientation: 'v'})
    });
</script>-->
<!--============== zoom =====================================-->

<script>
    $(document).ready(function() {
        $('#ex1').zoom();
    });
</script>

<script>
    $(document).ready(function() {
        $('#shipping_btn').click(function() {
            $('#shipping_form').toggle('slow');
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#pilling_btn').click(function() {
            $('#pilling_form').toggle('slow');
        });
    });
</script>



</body>
</html>
