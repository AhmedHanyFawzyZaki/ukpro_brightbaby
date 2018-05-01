<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->username.' Profile',
);

$this->menu=array(
	array('label'=>'List User','url'=>array('index')),
	array('label'=>'Create User','url'=>array('create')),
	array('label'=>'Update User','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete User','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h1>View User - <?php echo $model->fname." ".$model->lname ;?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(

		array(
			'name'=>'groups_id',
			'type'=>'raw',
			 'value'=>$model->usergroup->group_title
				),


		//'username',

		'email',

		'fname',
		'lname',
		'subscribe'=>array(
			'name'=>'subscribe',
			'value'=>$model->getSubscribeValue($model->subscribe),
			),
		
		's_title'=>array(
			'name'=>'s_title',
			'value'=>$UserData->getTitleValue($UserData->s_title),
			),
		's_fname'=>array(
			'name'=>'s_fname',
			'value'=>$UserData->s_fname,
			),
		's_lname'=>array(
			'name'=>'s_lname',
			'value'=>$UserData->s_lname,
			),
		's_address'=>array(
			'name'=>'s_address',
			'value'=>$UserData->s_address,
			),
		's_address2'=>array(
			'name'=>'s_address2',
			'value'=>$UserData->s_address2,
			),
		's_country_id'=>array(
			'name'=>'s_country_id',
			'value'=>$UserData->ShippingUserCountry->name,
			),
		's_city'=>array(
			'name'=>'s_city',
			'value'=>$UserData->s_city,
			),
		's_zipcode'=>array(
			'name'=>'s_zipcode',
			'value'=>$UserData->s_zipcode,
			),
		's_phone_day'=>array(
			'name'=>'s_phone_day',
			'value'=>$UserData->s_phone_day,
			),
		's_phone_evening'=>array(
			'name'=>'s_phone_evening',
			'value'=>$UserData->s_phone_evening,
			),



		'b_title'=>array(
			'name'=>'b_title',
			'value'=>$UserData->getTitleValue($UserData->b_title),
			),
		'b_fname'=>array(
			'name'=>'b_fname',
			'value'=>$UserData->b_fname,
			),
		'b_lname'=>array(
			'name'=>'b_lname',
			'value'=>$UserData->b_lname,
			),
		'b_address'=>array(
			'name'=>'b_address',
			'value'=>$UserData->b_address,
			),
		'b_address2'=>array(
			'name'=>'b_address2',
			'value'=>$UserData->b_address2,
			),
		'b_country_id'=>array(
			'name'=>'b_country_id',
			'value'=>$UserData->BillingUserCountry->name,
			),
		'b_city'=>array(
			'name'=>'b_city',
			'value'=>$UserData->b_city,
			),
		'b_zipcode'=>array(
			'name'=>'b_zipcode',
			'value'=>$UserData->b_zipcode,
			),
		'b_phone_day'=>array(
			'name'=>'b_phone_day',
			'value'=>$UserData->b_phone_day,
			),
		'b_phone_evening'=>array(
			'name'=>'b_phone_evening',
			'value'=>$UserData->b_phone_evening,
			),


		/*array(
		'name'=>'image',
		'type'=>'raw',
		'value'=>CHtml::image(Yii::app()->request->baseUrl.'/media/members/'.$model->image,$model->username,array('width'=>250)),
		),*/

		//'details',
	
	), 
)); ?>
