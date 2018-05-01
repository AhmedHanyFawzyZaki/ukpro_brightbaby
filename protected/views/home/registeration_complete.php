<!--====================================== end row ================================================-->  
<div class="row">   
    <div class="wrapper">
        <div id="test" class="page-header">
            <h2 class="site">Welcome To bright baby</h2>
        </div>
        <div class="span8" style="margin-left: 0;">
            <?php if (Yii::app()->user->hasFlash('register-success')) { ?>
            <div class="alert alert-error w" style="margin-left: 0;">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <?php echo Yii::app()->user->getFlash('register-success'); ?>.
                </div>
            <?php } ?>
        </div>
        <div class="span4">
            <img src="<?= Yii::app()->request->baseUrl; ?>/images/stay.jpg" width="100%" height="300px" class=""/>
        </div>
        <div class="clear"></div>     
    </div>
</div>
<br/><br/>   
<!--====================================== end row ================================================-->  