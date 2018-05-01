<?php
$this->widget('application.extensions.fancybox.EFancyBox', array(
    'target' => '.add',
    'config' => array(
        maxWidth => 800,
        maxHeight => 900,
        fitToView => false,
        width => '70%',
        height => '70%',
        autoSize => false,
        closeClick => false,
        openEffect => 'none',
        closeEffect => 'none',
        type => 'iframe'
    ),
));
?> 




<?php
$this->breadcrumbs = array(
    'Products' => array('index'),
    'Manage',
);

$this->menu = array(
    array('label' => 'List Products', 'url' => array('index')),
    array('label' => 'Create Products', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('products-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Products Order</h1>


<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn'));  ?>
<div class="search-form" style="display:none">
    <?php
//$this->renderPartial('_search',array(
//'model'=>$model,
//)); 
    ?>
</div><!-- search-form -->

<?php if ($products) { ?>
    <form method="post">
        <table>
            <tr>
                <th>Product</th>
                <th>BabyGrows order</th>
                <th>Unisex order</th>
            </tr>

            <?php foreach ($products as $prod) { ?>
                <tr>
                    <td><?php echo $prod->title; ?></td>
                    <td><input type="text" name="bg_<?php echo $prod->id; ?>" value="<?php echo $prod->bg_order; ?>" /></td>
                    <td><input type="text" name="us_<?php echo $prod->id; ?>" value="<?php echo $prod->us_order; ?>" /></td>
                </tr>
            <?php } ?>

        </table>
        <input type="submit" name="save" value="Save Order" />
    </form>
<?php } ?>

