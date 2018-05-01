<?php

$this->pageTitle=Yii::app()->name . ' -'. $pages->title;
?>




<!--====================================== end row ================================================-->  
<div class="row">   
<div class="wrapper">
				<div style="width: 100%; float: left;" class="page-header">
                    <h2 style="width: 100%; float: left;" class="site" ><?= $pages->title ;?></h2>
                    <p style="width: 100%; float: left;"><?= $pages->intro ;?></p>
                </div> 
            <div class="span7"> 
            <div class="static no_bg">
                  
                <div style="width: 100%; float: left;">              
                    <?= $pages->details ;?>
                </div>
                <div class="clear"></div>            
            </div>
            </div>
            
            
            <div class="span5">
            <img src="<?=Yii::app()->request->baseUrl;?>/media/<?= $pages->image ;?>" width="100%" height="300px" class=""/>
            </div>
</div>
</div>
<br/><br/>   
<!--====================================== end row ================================================-->  