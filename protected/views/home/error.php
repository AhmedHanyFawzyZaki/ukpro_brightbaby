<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle=Yii::app()->name . ' - Error';
$this->breadcrumbs=array(
  'Error',
);
?>

<div class="content">

<div class="emak-academy">

  <h2 style="margin-top:20px;margin-left:20px;">Error <?php echo $error['code']; ?></h2>
<h3 style="margin-top:20px;margin-left:20px;">

<?php echo CHtml::encode($error['message']); ?>
</h3>

</div>
</div>