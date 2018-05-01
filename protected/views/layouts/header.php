<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html  xmlns="http://www.w3.org/1999/xhtml">
    <head >
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="keywords" content="<?= Settings::model()->findByPk('1')->keywords ?>">
            <meta name="description" content="<?= Settings::model()->findByPk('1')->desc ?>">
                <title><?php echo CHtml::encode($this->pageTitle); ?></title>


                <?php Yii::app()->bootstrap->register(); ?>

                <?php if (Yii::app()->controller->action->id == "productDetails") { ?>
                    <?php if ($this->prod) { ?>
                        <meta property="og:title" content="<?php echo $this->prod->title; ?>" />
                        <meta property="og:type" content="article" />
                        <meta property="og:image" content="<?= Yii::app()->request->getBaseUrl(true); ?>/media/products/<?= $this->prod->image; ?>" />
                        <?php if ($this->prod_photos) { ?>
                            <?php foreach ($this->prod_photos as $phm) { ?>
                                <meta property="og:image" content="<?= Yii::app()->request->getBaseUrl(true); ?>/gallery/<?= $phm->id . '.' . 'jpg'; ?>" />
                            <?php } ?>
                        <?php } ?>
                        <meta property="og:url" content="<?= Yii::app()->request->getBaseUrl(true); ?>/home/productDetails/<?= $this->prod->slug; ?>" />
                        <meta property="og:description" content="<?php echo strip_tags($this->prod->description); ?>" />

                        <meta name="twitter:card" content="summary" />
                        <meta name="twitter:title" content="<?php echo $this->prod->title; ?>" />
                        <meta name="twitter:description" content="<?php echo strip_tags($this->prod->description); ?>" />
                        <meta name="twitter:image" content="<?= Yii::app()->request->getBaseUrl(true); ?>/media/products/<?= $this->prod->image; ?>" />
                        <meta name="twitter:url" content="<?= Yii::app()->request->getBaseUrl(true); ?>/home/productDetails/<?= $this->prod->slug; ?>" />
                    <?php } ?>
                <?php } else { ?>
                    <?php if (Yii::app()->params['facebook_description']) { ?>
                        <meta property="og:title" content="BrightBaby" />
                        <meta property="og:type" content="article" />
                        <?php $ba_photo = Banner::model()->find(); ?>

                        <?php if (strtolower(Yii::app()->controller->action->id) == "babygrows" || strtolower(Yii::app()->controller->action->id) == "babygirl" || strtolower(Yii::app()->controller->action->id) == "babyboy" || strtolower(Yii::app()->controller->action->id) == "unisex") { ?>
                            <meta property="og:image" content="<?= Yii::app()->request->getBaseUrl(true); ?>/media/<?= $this->cat_img; ?>" />
                        <?php } else { ?>
                            <meta property="og:image" content="<?= Yii::app()->request->getBaseUrl(true); ?>/media/banner/<?= $ba_photo->image; ?>" />
                        <?php } ?>
                        <meta property="og:url" content="<?= Yii::app()->request->getBaseUrl(true); ?>/<?= Yii::app()->request->requestUri; ?>" />
                        <meta property="og:description" content="<?php echo Yii::app()->params['facebook_description']; ?>" />

                        <meta name="twitter:card" content="summary" />
                        <meta name="twitter:title" content="BrightBaby" />
                        <meta name="twitter:description" content="<?php echo Yii::app()->params['facebook_description']; ?>" />
                        <meta name="twitter:image" content="<?= Yii::app()->request->getBaseUrl(true); ?>/images/logo.png" />
                        <meta name="twitter:url" content="<?= Yii::app()->request->getBaseUrl(true); ?>/<?= Yii::app()->request->requestUri; ?>" />
                    <?php } ?>
                <?php } ?>

<!-- <title>Bright Baby</title>-->
                <link rel="shortcut icon" href="<?= Yii::app()->request->baseUrl; ?>/images/favicon.png"> 
                    <!-- Le styles -->
                    <link href="<?= Yii::app()->request->baseUrl; ?>/css/bootstrap.css" rel="stylesheet">
                        <link href="<?= Yii::app()->request->baseUrl; ?>/css/style.css" rel="stylesheet">
                            <link href="<?= Yii::app()->request->baseUrl; ?>/css/jsCarousel-2.0.0.css" rel="stylesheet" type="text/css" />
                            <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
                            <!--[if lt IE 9]>
                              <script src="assets/js/html5shiv.js"></script>
                            <![endif]-->
                            <!--<script type="text/javascript">var switchTo5x=true;</script>
                            <script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
                            <script type="text/javascript">stLight.options({publisher: "ur-5807e402-9bd8-f7a0-7fa6-5b8cfb7afd5", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>-->
                            </head>

                            <body data-spy="scroll" data-target=".bs-docs-sidebar">  
                                <?php if (Yii::app()->controller->action->id == "productDetails") { ?>
                                    <?php if ($this->prod) { ?>
                                        <img style="position: absolute;left: -99999px;" alt="<?php echo trim(preg_replace('/\s\s+/', ' ',strip_tags($this->prod->description))); ?>" src="<?= Yii::app()->request->baseUrl; ?>/media/products/<?= $this->prod->image; ?>" />

                                        <?php
                                        if ($this->prod_photos) {
                                            foreach ($this->prod_photos as $image) {
                                                ?>                       
                                        <img style="position: absolute;left: -99999px;" alt="<?php echo trim(preg_replace('/\s\s+/', ' ',strip_tags($this->prod->description))); ?>" src="<?= Yii::app()->request->baseUrl; ?>/gallery/<?= $image->id . '.' . 'jpg'; ?>" />                  
                                                <?
                                            }
                                        }
                                        ?>  
                                    <?php } ?>
                                <?php } ?>

                                <div class="row"> 
                                    <div class="wrapper">
                                        <?php
                                        if (Yii::app()->user->getState('one') == '') {
                                            Yii::app()->user->setState('one', '1');
                                        }
                                        if (isset(Yii::app()->request->cookies['TstCookies']) && Yii::app()->user->getState('one') == '1') {
                                            $items = unserialize(Yii::app()->request->cookies['TstCookies']);
                                            if (!empty($items)) {
                                                foreach ($items as $item) {
                                                    $product = Products::model()->findByPk($item['0']);
                                                    Yii::app()->shoppingCart->put($product); //1 item with id=1, quantity=1.
                                                    Yii::app()->shoppingCart->update($product, $item['1']);
                                                    $_SESSION['pro_size_' . $item['0']] = $item['2'];
                                                    $_SESSION['pro_color_' . $item['0']] = $item['3'];
                                                    $_SESSION['pro_size_id_' . $item['0']] = $item['4'];
                                                }
                                            }
                                            Yii::app()->user->setState('one', '0');
                                        }
                                        ?>


                                        <?php if (!Yii::app()->user->getState('close') == 1) { ?>
                                            <div id="zzz" class="span12"> 
                                                <div  class="cart-alert" style="width:97%;float:left; margin: 20px 0 15px; font-size:12px;text-align:left;">
                                                    <strong>We use cookies to improve our site and your shopping experience. By continuing to browse
                                                        our site you accept our cookie policy . </strong>
                                                    <a href="<?= Yii::app()->request->baseUrl; ?>/<?= Helper::DrawPageLink(15); ?>">Find out more</a>
                                                    <!--<a onClick="document.getElementById('zzz').innerHTML='';" class="close_policy">Close</a>-->

                                                    <?
                                                    echo CHtml::ajaxLink(
                                                            "<img src='" . Yii::app()->request->baseUrl . "/images/close.png'/>", Yii::app()->createUrl('home/flagremove'), array(// ajaxOptions
                                                        'type' => 'POST',
                                                        'success' => "function( data )
                          {
                            if(data==0)
                            {
                              document.getElementById('zzz').innerHTML='';
                            }
                            
                          }",
                                                            //'data' => array( 'size' => 'js:$("#size_").val()', 'color' => 'js:$("#color_").val()' )
                                                            ), array(//htmlOptions
                                                        'href' => Yii::app()->createUrl('home/flagremove'),
                                                        'class' => 'close_policy',
                                                            )
                                                    );
                                                    ?>

                                                </div>
                                            </div>
                                        <? } ?>
                                    </div>
                                </div>


                                <div class="row"> 
                                    <div class="wrapper">
                                        <div class="span12"> 
                                            <a href="<?= Yii::app()->request->baseUrl; ?>/home/login" class="login"></a>
                                        </div>
                                    </div>
                                </div>


                                <div class="row"> 
                                    <div class="wrapper">
                                        <div class="span12"> 
                                            <a href="<?= Yii::app()->request->baseUrl; ?>/index.php" class="logo"></a>
                                            <div class="rside">
                                                <div class="dropdown">
                                                    <a class="dropdown-toggle cart" data-toggle="dropdown" href="#" id="cart_item">
                                                        <img src="<?= Yii::app()->request->baseUrl; ?>/images/cart_bag.png"/>
                                                        <span id="items_count" class="num_item">
                                                            <?php
                                                            if (Yii::app()->shoppingCart->getCount() > 0) {
                                                                echo Yii::app()->shoppingCart->getCount();
                                                            } else {
                                                                echo "0";
                                                            };
                                                            ?>
                                                        </span>
                                                    </a>
                                                    <ul class="dropdown-menu bag-menu" role="menu" aria-labelledby="dLabel">
                                                        <div style="width:250px;height:auto;">
                                                            <h5 class="under" style="color:#662299;">RECENTLY ADDED</h5>

                                                            <table class="table-hover leftMargin19 under2" style="width:85%;" id="recently_added">
                                                                <?php if (Helper::getLastItem() != '') { ?>
                                                                    <tr>
                                                                        <td>
                                                                            <img src="<?= Yii::app()->request->baseUrl; ?>/media/products/<?= Helper::getLastItem()->image; ?>" style="width:70px;height:100px;">
                                                                        </td>
                                                                        <td>
                                                                            <h5 style="color:#662299;"><?= Helper::getLastItem()->title; ?>
                                                                                <br>
                                                                                <!--<span style="color:#999;font-size:12px">Lorem Ipsum2</span>-->

                                                                                    <?= '&pound;' . Helper::getLastItem()->price; ?>
                                                                            </h5>

                                                                        </td>
                                                                    </tr>
                                                                    <?
                                                                } else {
                                                                    echo "<td>No items in your shopping bag</td>";
                                                                }
                                                                ?>
                                                            </table>

                                                            <a href="<?= Yii::app()->request->baseUrl; ?>/home/shoppingCart" 
                                                               class="view_checkout recent leftMargin14 topMargin10 botpad"></a>
                                                        </div>
                                                    </ul>
                                                </div>






                                                <?php if (Yii::app()->user->isGuest) { ?>
                                                    <div style="width:50px;float:left;"><a href="<?= Yii::app()->request->baseUrl; ?>/home/login" class="link">SIGN IN</a>
                                                        <a href="<?= Yii::app()->request->baseUrl; ?>/home/register" class="link">REGISTER</a></div>
                                                    <p style="float:left;"><a class='link' href="<?= Yii::app()->request->baseUrl . '/home/login' ?>">MY ACCOUNT</a></p>
                                                    <?php
                                                } else {
                                                    //echo "<span>Welcome,".Yii::app()->user->username."</span><br/><a href=''></a>";                        
                                                    echo "<span class='link'>Welcome,<span class='site'>" . Helper::GetUserData()->fname . "</span><br/>";
                                                    echo "</span><br/><a class='link' href='" . Yii::app()->request->baseUrl . '/home/myaccount' . "'>MY ACCOUNT</a>";
                                                    echo CHtml::link('Logout', array('home/logout'), array('class' => 'link'));
                                                }
                                                ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--====================================== end row ================================================-->  
                                <div class="row menu">  
                                    <div class="wrapper">
                                        <div class="span12"> 
                                            <? $current_url = Yii::app()->request->requestUri; ?>
                                            <a href="<?= Yii::app()->request->baseUrl; ?>/home/babygrows" class="<?
                                            if ($current_url == Yii::app()->request->baseUrl . '/home/babygrows') {
                                                echo 'active';
                                            } else {
                                                echo '';
                                            }
                                            ?>">BABY GROWS</a>
                                            <a href="<?= Yii::app()->request->baseUrl; ?>/home/babygirl" class="<?
                                            if ($current_url == Yii::app()->request->baseUrl . '/home/babygirl') {
                                                echo 'active';
                                            } else {
                                                echo '';
                                            }
                                            ?>" >BABY GIRL</a>
                                            <a href="<?= Yii::app()->request->baseUrl; ?>/home/babyboy" class="<?
                                            if ($current_url == Yii::app()->request->baseUrl . '/home/babyboy') {
                                                echo 'active';
                                            } else {
                                                echo '';
                                            }
                                            ?>">BABY BOY</a>
                                            <a href="<?= Yii::app()->request->baseUrl; ?>/home/unisex" class="<?
                                            if ($current_url == Yii::app()->request->baseUrl . '/home/unisex') {
                                                echo 'active';
                                            } else {
                                                echo '';
                                            }
                                            ?>">UNISEX</a>

                                            <a href="<?= Yii::app()->request->baseUrl; ?>/<?= Helper::DrawPageLink(1); ?>" class="<?
                                            if ($current_url == Yii::app()->request->baseUrl . '/' . Helper::DrawPageLink(1)) {
                                                echo 'active';
                                            } else {
                                                echo '';
                                            }
                                            ?>">ABOUT US</a>
                                            <a href="<?= Yii::app()->request->baseUrl; ?>/<?= Helper::DrawPageLink(5); ?>" class="<?
                                            if ($current_url == Yii::app()->request->baseUrl . '/' . Helper::DrawPageLink(5)) {
                                                echo 'active';
                                            } else {
                                                echo '';
                                            }
                                            ?>">CONTACT</a>
                                        </div>
                                    </div>
                                </div>   
                                <!--====================================== end row ================================================-->  