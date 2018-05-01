<?php
$this->breadcrumbs = array(
    'Products' => array('index'),
    $model->title,
);

$this->menu = array(
    array('label' => 'List Products', 'url' => array('index')),
    array('label' => 'Create Products', 'url' => array('create')),
    array('label' => 'Update Products', 'url' => array('update', 'id' => $model->id)),
    array('label' => 'Delete Products', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    //array('label'=>'Manage Products','url'=>array('index')),
    array('label' => 'Products Order', 'url' => array('order')),
);
?>

<h1>View Products #<?php echo $model->title; ?></h1>

<?php
$this->widget('bootstrap.widgets.TbDetailView', array(
    'data' => $model,
    'attributes' => array(
        //	'id',
        /* 'cat_id'=>array(
          'name'=>'cat_id',
          'value'=>$model->productCategory->name,
          ), */
        'categoriesList',
        'title',
        'price',
        array(
            'label' => 'Quantity',
            'value' => ProductsSizes::get_qty($model->id),
        ),
        //'slug',
        'image' => array(
            'name' => 'image',
            'type' => 'raw',
            'value' => CHtml::image(Yii::app()->request->baseUrl . '/media/products/' . $model->image, $model->title, array('width' => 250)),
        ),
        'description' => array(
            'name' => 'description',
            'type' => 'raw',
        ),
        'sizing' => array(
            'name' => 'sizing',
            'type' => 'raw',
        ),
        'love_it' => array(
            'name' => 'love_it',
            'type' => 'raw',
        ),
        'delivery' => array(
            'name' => 'delivery',
            'type' => 'raw',
        ),
        'look_after_me' => array(
            'name' => 'look_after_me',
            'type' => 'raw',
        ),
    ),
));

$gallery = Helper::getGalleryImages($model->gallery_id);
?>

<ul>
    <?
    //if(! $gallery===null){
    foreach ($gallery as $image) {
        ?>

        <li class="span2">
            <a href="#" class="thumbnail" rel="tooltip" data-title="<?= $image['name'] ?>">
                <img src="<?= Yii::app()->getBaseUrl(true) ?>/gallery/<?= $image['id'] ?>small.jpg" alt="">
            </a>
        </li>

    <? }  //}  ?>
</ul>
