<?php  // set the page title


$this->pageTitle=Yii::app()->name . ' - Shipping';
?>






<!--====================================== end row ================================================-->  
<div class="row">   
<div class="wrapper">
            <div class="span12 minheight"> 
            <div class="static no_bg">
                <div class="page-header">
                <h2 class="site"><?= $page->title ;?></h2>
                <p><?= $page->intro ;?></p>
                </div> 
            <span class='txt'>
            <div class="accordion" id="accordion2">
                <?php
                $i=0;
                foreach ($infos as $info ){ if($i==0) { $class='accordion-body collapse in';}else{$class='accordion-body collapse';}?>
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="site accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#<?= $info->id ;?>">
                            <b class="arrow_bold"><img src="<?= Yii::app()->request->baseUrl ;?>/images/arr.png"/></b><?= $info[question] ;?>
                            </a>
                        </div>
                        <div id="<?= $info->id ;?>" class="<?= $class ;?>">
                            <div class="accordion-inner">
                                <?= $info[answer] ;?>
                            </div>
                        </div>
                    </div>
                <?$i++;}?> 
                                   
            </div>    
            </span>
            <div class="clear"></div>            
            </div>
            </div>
</div>
</div>
<br/><br/>   
<!--====================================== end row ================================================-->