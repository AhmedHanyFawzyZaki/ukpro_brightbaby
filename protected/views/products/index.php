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
    array('label' => 'Products Order', 'url' => array('order')),
);
?>

<h1>Manage Products</h1>

<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'products-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        //	'id',

        'title',
        array(
            'header' => 'Quantity',
            'value' => 'ProductsSizes::get_qty($data->id)'
        ),
        //	'slug',
        //'description',
        'image' => array(
            'header' => 'Main Image',
            'type' => 'html',
            'value' => '(!empty($data->image))?CHtml::image(Yii::app()->request->baseUrl."/media/products/".$data->image,"",array("style"=>"width:100px;height:75px;")):"no image"',
        ),
        'categoriesList' => array(
            'name' => 'categoriesList',
            'filter' => '',
        ),
        /*
          'price',

         */
        /* array(		
          'type'=>'html',
          'value' => 'CHtml::link( "Add Gallery!", Yii::app()->createUrl("products/addgallery",array("id"=>$data->id)),array("class"=>"add"))',
          ), */
        array(
            'class' => 'CLinkColumn',
            'label' => 'Recommended',
            'urlExpression' => 'Yii::app()->request->baseUrl."/recomendedProducts/index?id=".$data->id',
            'header' => 'Recommended Products'
        ),
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
        /* 'template'=>'{view}{update}{delete}{add}',

          'buttons'=>array(
          'add' => array(
          'imageUrl'=>Yii::app()->request->baseUrl.'/images/icons/delete.png',

          'url'=>'Yii::app()->createUrl("/products/addGallery", array("id"=>$data->id))',
          'options'=>array(
          'class'=>'add',
          ),
          'label'=>'Add Gallery',
          //'click'=>'function(){alert("Remove course  and all the related items ")}',

          ),


          ), */
        ),
    ),
));
?>
