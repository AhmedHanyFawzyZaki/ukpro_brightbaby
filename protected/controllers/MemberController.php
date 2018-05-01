<?php

class MemberController extends FrontController
{

	protected function beforeAction($actions)
	{

		if(! User::CheckPermission('member') )
		{
			Yii::app()->user->setFlash('ErrorMsg', ' Please Login First ');


			$this->redirect('home/login');

		}

		return parent::beforeAction($actions);
	}



	public function actionIndex()
	{

	//if company edit profile
		$profile = new User();
		//get company id
		$prof_id=Yii::app()->user->id;
		//get company object
		$profile= User::model()->findByPk($prof_id);

		//get the trainer details
		$criteria=new CDbCriteria;
		$criteria->condition='user_id=:userID';
		$criteria->params=array(':userID'=>$prof_id);
		$user_details= UserDetails::model()->find($criteria); // $params is not needed




		$this->render('index' ,array('prof_id'=>$prof_id,
		 								'profile'=>$profile,

										));
	}





	public function actionUpdateprofile()
	{
		$trainer_id=Yii::app()->user->id;
		$user= new user();
		$user = User::model()->findByPk($trainer_id);
		$criteria=new CDbCriteria;
		$criteria->condition='user_id=:userID';
		$criteria->params=array(':userID'=>$user->id);
		$user_details= UserDetails::model()->find($criteria); // $params is not needed

		//get location details
		$location = new Location();



	if(isset($_POST['User'], $_POST['UserDetails']))
		{
			if( $user->image != ''){
				$_POST['User']['image'] = $user->image;
			}
			$user->attributes=$_POST['User'];

			$user_details->attributes=$_POST['UserDetails'];
						// validate BOTH $a and $b
			$valid=$user->validate();
			$valid=$user_details->validate() && $valid;

			if($valid)
			{


				$uploadedFile=CUploadedFile::getInstance($user,'image');

				if(! empty ($uploadedFile)){
					if($user->image =='')
					{
						$rnd = rand(0,9999);
						$fileName = "{$rnd}-{$uploadedFile}";
						$user->image=	$fileName;
					}

						$uploadedFile->saveAs(Yii::app()->basePath.'/../media/members/'.$user->image);
				}

				// use false parameter to disable validation
				$user->save(false);
				$user_details->user_id= $user->id;
				$user_details->company_id= $trainer_id;
				$user_details->save(false);
				Yii::app()->user->setFlash('EmpUpdate','The Profile data has been updated successfully.');
				//	$this->redirect(array('updatemployee','id'=>$id));
				// ...redirect to another page
			}



		}

		//$location->location= $user_details->UserCountry->title;
		$user->password=$user->simple_decrypt($user->password);
		$this->render('updateprofile',array('user'=>$user ,
											'user_details'=>$user_details,

													));

	}


	public function actionAjaxRequest()
	{
		$course_id = $_POST['course_id'];
		$course_level = $_POST['course_level'];
		$trainer_id=Yii::app()->user->id;


		$request= new CourseCompleted();;
		$request->user_id=$trainer_id;
		$request->course_id=$course_id;
		$request->level=$course_level;
	    $request->payment_date=date("F j, Y, g:i a");

		$course= Course::model()->findByPk($course_id);

		$user_details= User::model()->findByPk($trainer_id);

		if($user_details->user_credit > $course->cost)
		{
		$credit= $user_details->user_credit - $course->cost;

			$user_details->user_credit=$credit;
			$user_details->save(false);
			$request->paid_points=$course->cost;
			$request->status=1;
		}


		$request->save(false);
		//echo "some sort of response 	$corse_id  and $course_level ";

		Yii::app()->end();
	}






	public function actionBuy($Package){




		$pack_details= Package::model()->findByPk($Package);
	// set
		$paymentInfo['Order']['theTotal'] = $pack_details->cost;
		$paymentInfo['Order']['description'] =  $pack_details->title .'-'. $pack_details->desc;
		$paymentInfo['Order']['quantity'] = '1';



		// call paypal
		$result = Yii::app()->Paypal->SetExpressCheckout($paymentInfo);
		//Detect Errors
		if(!Yii::app()->Paypal->isCallSucceeded($result)){
			if(Yii::app()->Paypal->apiLive === true){
				//Live mode basic error message
				$error = 'We were unable to process your request. Please try again later';
			}else{
				//Sandbox output the actual error message to dive in.
				$error = $result['L_LONGMESSAGE0'];
			}
			echo $error;
			Yii::app()->end();

		}else {
			// send user to paypal
			$token = urldecode($result["TOKEN"]);

			$payPalURL = Yii::app()->Paypal->paypalUrl.$token.'&Package='.$Package;


			$payment_info= new Payment();
			$payment_info->user_id=Yii::app()->user->id;
			$payment_info->token= $token;
			$payment_info->status='Pending';
			$payment_info->p_date=date('Y-m-d H:i:s');
			$payment_info->package_id=$Package;
			$payment_info->save(false);


			$this->redirect($payPalURL);
		}
	}

	public function actionConfirm()
	{


		$token = trim($_GET['token']);
		$payerId = trim($_GET['PayerID']);

	  //get the package details

		$criteria = new CDbCriteria;
		$criteria->condition='token=:Tokenw';
		$criteria->params=array(':Tokenw'=>$token);
	    //$paymet_details= Payment::model()->findAll($criteria)->id;

	//	echo $paymet_details;
		//echo  $token .'************'.$paymet_details->package_id.'=='. $package_info->cost.'sss'.$paymet_details->status.'==';

		$package_info= Package::model()->findByPk($paymet_details->package_id);


		$result = Yii::app()->Paypal->GetExpressCheckoutDetails($token);

		$result['PAYERID'] = $payerId;
		$result['TOKEN'] = $token;
		$result['ORDERTOTAL'] =  $package_info->cost ;




	//Detect errors
		if(!Yii::app()->Paypal->isCallSucceeded($result)){
			if(Yii::app()->Paypal->apiLive === true){
				//Live mode basic error message
				$error = 'We were unable to process your request. Please try again later';
			}else{
				//Sandbox output the actual error message to dive in.
				$error = $result['L_LONGMESSAGE0'];
			}
			echo $error;
			Yii::app()->end();
		}else{

			$paymentResult = Yii::app()->Paypal->DoExpressCheckoutPayment($result);
			//Detect errors
			if(!Yii::app()->Paypal->isCallSucceeded($paymentResult)){
				if(Yii::app()->Paypal->apiLive === true){
					//Live mode basic error message
					$error = 'We were unable to process your request. Please try again later';
				}else{
					//Sandbox output the actual error message to dive in.
					$error = $paymentResult['L_LONGMESSAGE0'];
				}
				echo $error;
				Yii::app()->end();
			}else{
				//payment was completed successfully

				if($paymet_details->status=='Pending')
				{
				  $paymet_details->status='Complated';
				  $paymet_details->save();

					$user_details= User::model()->findBuPk(Yii::app()->user->id);
					$credit=$user_details->user_credit +$package_info->points;

					$user_details->user_credit=$credit;
					$user_details->save(false);

				}
				$this->render('confirm');
			}

		}
	}

	public function actionCancel()
	{
		//The token of the cancelled payment typically used to cancel the payment within your application
		$token = $_GET['token'];

		$this->render('cancel');
	}


}