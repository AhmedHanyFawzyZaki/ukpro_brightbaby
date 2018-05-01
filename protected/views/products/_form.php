<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'products-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
    'type' => 'horizontal',
        ));
?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

<div class="control-group ">
    <div class="control-label required">
        <label> Type <span class="required">*</span></label>
    </div>
    <div class="controls">
        <?php echo $form->checkBoxList($model, 'categories', ProductCategory::model()->getCategories(), array('multiple' => true, 'class' => 'listMEM')); ?>
    </div>
</div>

<?php echo $form->textFieldRow($model, 'title', array('class' => 'span5', 'maxlength' => 250)); ?>

<?php echo $form->textFieldRow($model, 'price', array('class' => 'span2', 'maxlength' => 50, 'append' => '&pound;')); ?>



<?php
echo $form->fileFieldRow($model, 'image', array('class' => 'span5', 'maxlength' => 250));
if ($model->isNewRecord != '1' and $model->image != '') {
    echo "<p>" . Chtml::image(Yii::app()->baseUrl . '/media/products/' . $model->image, 'image', array('width' => 200, 'style' => 'margin:0 180px 10px;')) . "</p>";
}
?>

<div class="control-group ">
    <div class="control-label">
        <label> Gallery</label>
    </div>
    <div class="controls">
        <div class="container">
            <div class="row">
                <?php echo CHtml::activeHiddenField($model, 'gallery_id'); ?>
                <div class="span<?php echo(isset($_GET['w']) ? $_GET['w'] : '12') ?>" style="width:900px;margin-left:-155px;">
                    <?php
                    $this->widget('GalleryManager', array(
                        'gallery' => $gallery,
                    ));
                    ?>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="control-group ">
    <div class="control-label required">
        <label> Colors <span class="required">*</span></label>
    </div>
    <div class="controls">
        <?= CHtml::checkBoxList('Products[colors]', $arrOfColors, CHtml::listData(Colors::model()->findAll(), 'id', 'title'), array('style' => 'float: left;margin-right: 8px;')); ?>
    </div>
</div>

<div class="control-group ">
    <div class="control-label required">
        <label> Sizes <span class="required">*</span></label>
    </div>
    <div class="controls">
        <?php // echo CHtml::checkBoxList('Products[sizes]', $arr, CHtml::listData(Sizes::model()->findAll(), 'id', 'size'), array('style' => 'float: left;margin-right: 8px;')); ?>
        <?php
        $sizes = Sizes::model()->findAll();
        if ($sizes) {
            foreach ($sizes as $sz) {
                $q = "";
                $sel = "";
                if (!$model->isNewRecord) {
                    $q = 'value="' . ProductsSizes::get_qty($model->id, $sz->id) . '"';
                    $t = ProductsSizes::model()->findByAttributes(array('product_id' => $model->id, 'size' => $sz->id));
                    if ($t) {
                        $sel = "checked";
                    }
                }
                echo '<div style="margin-bottom: 5px;">';
                echo '<input id="psz_' . $sz->id . '" ' . $sel . ' type="checkbox" name="Products[sizes][]" value="' . $sz->id . '" style="float: left;margin-right: 8px;height:22px;">';
                echo '<label for="psz_' . $sz->id . '" style="width:200px;float:left;line-height: 30px;">' . $sz->size . '</label>';
                echo '<input type="text" class="sub_qty" name="qty_' . $sz->id . '" placeholder="quantity" style="width:80px;float:left;" ' . $q . ' />';
                echo '<div style="clear:both;"></div>';
                echo '</div>';
            }
        }
        ?>
    </div>
</div>

<div class="control-group ">
    <div class="control-label required">
        <label>Total Amount</label>
    </div>
    <div class="controls">
        <input type="text" id="tot_qty" class="span5" style="cursor: pointer;" readonly />
    </div>
</div>

<?php // echo $form->textFieldRow($model, 'quantity', array('class' => 'span2')); ?>

<div class="control-group ">
    <div class="control-label required">
        <label>Description</label>
    </div>
    <div class="controls" style="margin-left:0px;">
        <?php
        $this->widget('application.extensions.eckeditor.ECKEditor', array(
            'model' => $model,
            'attribute' => 'description',
        ));
        ?>
    </div>
</div>


<? if (!$model->isNewRecord) { ?>

    <div class="control-group ">
        <div class="control-label required">
            <label> Sizes</label>
        </div>
        <div class="controls" style="margin-left:0px;">
            <?php
            $this->widget('application.extensions.eckeditor.ECKEditor', array(
                'model' => $model,
                'attribute' => 'sizing',
            ));
            ?>
        </div>
    </div>

    <div class="control-group ">
        <div class="control-label required">
            <label>Why we love it?</label>
        </div>
        <div class="controls" style="margin-left:0px;">
            <?php
            $this->widget('application.extensions.eckeditor.ECKEditor', array(
                'model' => $model,
                'attribute' => 'love_it',
            ));
            ?>
        </div>
    </div>
<? } ?>

<div class="control-group ">
    <div class="control-label required">
        <label>Delivery</label>
    </div>
    <div class="controls" style="margin-left:0px;">
        <?php
        $this->widget('application.extensions.eckeditor.ECKEditor', array(
            'model' => $model,
            'attribute' => 'delivery',
        ));
        ?>
    </div>
</div>

<div class="control-group ">
    <div class="control-label required">
        <label>Look After Product</label>
    </div>
    <div class="controls" style="margin-left:0px;">
        <?php
        $this->widget('application.extensions.eckeditor.ECKEditor', array(
            'model' => $model,
            'attribute' => 'look_after_me',
        ));
        ?>
    </div>
</div>


<div class="form-actions">
    <?php
    $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType' => 'submit',
        'type' => 'primary',
        'label' => $model->isNewRecord ? 'Create' : 'Save',
    ));
    ?>
</div>

<?php $this->endWidget(); ?>


<?php
Yii::app()->clientScript->registerScript('qty','
    $(".sub_qty").on("input",function(){
        qty();
    });
    
    qty();
    
    function qty(){
        var x = 0;
        $(".sub_qty").each(function(){
            x += parseInt($(this).val());
        });
        $("#tot_qty").val(x);
    }
');
?>