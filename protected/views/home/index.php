<?php
/* @var $this SiteController */

$this->pageTitle = Yii::app()->name;
?>

<!--====================================== end row ================================================-->  
<div class="row">	
    <div class="wrapper">
        <div class="span12">        
            <div id="myCarousel" class="carousel slide  myslide"  style="margin-top:-12px;">
                <!-- Carousel items -->
                <div class="carousel-inner">
                    <?php
                    $i = 0;
                    foreach ($bannerPhotos as $photo) {
                        if ($i == 0) {
                            $class = 'active item';
                        } else {
                            $class = 'item';
                        }
                        ?>

                        <div class="<?= $class; ?>">
                            <img src="<?= Yii::app()->request->baseUrl; ?>/media/banner/<?= $photo->image; ?>" width="980" height="753" alt=""/>
                        </div>
                        <?php
                        $i++;
                    }
                    ?>

                </div>      
            </div>  
        </div>
    </div>
</div>  
<br/> 
<!--====================================== end row ================================================--> 
<div class="row">	
    <div class="wrapper">
        <?php
        $sett = Settings::model()->findByPk('1');
        ?>
        <a href="<?= Yii::app()->request->baseUrl; ?>/home/babyboy" style='background: url("<?= Yii::app()->request->baseUrl; ?>/media/<?= $sett->baby_boy_image; ?>") !important;border: 2px solid #660066;' class="span6 boy"></a>
        <a href="<?= Yii::app()->request->baseUrl; ?>/home/babygirl" style='background: url("<?= Yii::app()->request->baseUrl; ?>/media/<?= $sett->baby_girl_image; ?>") !important;border: 2px solid #660066;' class="span6 girl"></a>
    </div>
</div>
<br/><br/>   
<!--====================================== end row ================================================-->  