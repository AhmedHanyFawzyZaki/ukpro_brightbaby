<?php

class OrdersController extends AdminController {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Orders;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Orders'])) {
            $model->attributes = $_POST['Orders'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Orders'])) {
            $old_status = $model->status;
            $model->attributes = $_POST['Orders'];
            $new_status = $model->status;
            if ($model->save()) {
                if ($old_status == '2' && $new_status == '4') {
                    $order_details = OrdersDetails::model()->findAllByAttributes(array("orders_id" => $model->id));
                    if ($order_details) {
                        foreach ($order_details as $od) {
                            $sz = Sizes::model()->findByAttributes(array('size' => $od->size));
                            if ($sz) {
                                $upq = ProductsSizes::model()->findByAttributes(array('product_id' => $od->pro_id, 'size' => $sz->id));
                                if($upq){
                                    $upq->qty += $od->qty;
                                    $upq->save(false);
                                }
                            }
                        }
                    }
                    //send email to the user
                    $user = User::model()->findByPk($model->user_id);
                    $user->user_credit += $model->price;
                    if ($user->save(false)) {
                        $mail = new YiiMailer();
                        $mail->setFrom(Yii::app()->params['adminEmail'], 'BrightBaby');
                        $mail->setTo($model->email);
                        $mail->setSubject('Order Refunded');

                        $message = 'Your order has been refunded and the amount you have paid has been transfered to your account as points, please check your credit notes by visiting your Bright Baby profile page, Or just <a target="_Blank" href="' . Yii::app()->getBaseUrl('webroot') . '/home/credit"> click here </a> to be redirected to your account.<br> If your browser doesn\'t support redirect process, then copy and paste the following link to your browser URL: <br>"' . Yii::app()->getBaseUrl('webroot') . '/home/credit"' . '<br><br><br><span style="color:red;">Some Important Remarks: </span><br>- 1&pound;=100 points<br>- The refunded order has been requested since (' . $model->order_date . ')<br><br> Thank you for ordering from <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Bright Baby';

                        $mail->setBody($message);
                        $mail->send();
                    }
                }

                if ($old_status == "1" && $new_status == "2") {
                    $order_details = OrdersDetails::model()->findAllByAttributes(array("orders_id" => $model->id));
                    if ($order_details) {
                        foreach ($order_details as $od) {
                            $sz = Sizes::model()->findByAttributes(array('size' => $od->size));
                            if ($sz) {
                                $upq = ProductsSizes::model()->findByAttributes(array('product_id' => $od->pro_id, 'size' => $sz->id));
                                if($upq){
                                    $upq->qty -= $od->qty;
                                    $upq->save(false);
                                }
                            }
                        }
                    }


                    $mail = new YiiMailer();
                    $mail->setFrom(Yii::app()->params['adminEmail'], 'BrightBaby');
                    $mail->setTo($model->email);
                    $mail->setSubject('Order Confirmation');

                    foreach ($order_details as $item) {
                        $size = "N/A";
                        if ($item->size) {
                            $size = $item->size;
                        }
                        $list.='
							<tr>
								<td style="width:10%;">
				   							<img src="' . Yii::app()->getBaseUrl(true) . '/media/products/' . $item->productName->image . '" style="height:130px;" />
									</td>

									<td style="width:10%;"><b>Product</b><br/><br/>
										<span style="margin-top: 20px;float: left;">
											' . $item->productName->title . '
										</span>
									</td>
									<td style="width:11%;"><b>Product Size</b>
										<br /><br /><span style="margin-top: 20px;float: left;">' . $size . '</span>
									</td>
									<td style="width:7%;" ><b style="margin-top: 10px;">Qty</b>
											<br /><br />' . $item->qty . '

									</td>
									<td style="width:9%;"><b>Unit Price</b>
										<br /><br /><span style="margin-top: 20px;float: left;">&pound;' . $item->price . '</span>
									</td>
									<td style="width:6%;background:#ccc;" ><b>Total</b>
									<br /><br />
									<span  style="float: left;">&pound;' . ($item->price * $item->qty) . '</span>
									</td>
								</tr>';
                    }

                    $message = '<br/><div>Your order id : ' . $model->id . '   and the order total price : ' . $model->price . ' &pound;</div><br />
                        <table style="margin-bottom: 20px;width: 100%;margin-top: 20px;">
                        		<tbody>
								' . $list . '
							</tbody>
						</table>

						<br/>

						';

                    $mail->setBody($message);
                    $mail->send();
                }
                $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $this->loadModel($id)->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
        }
        else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    /* public function actionIndex()
      {
      $dataProvider=new CActiveDataProvider('Orders');
      $this->render('index',array(
      'dataProvider'=>$dataProvider,
      ));
      }

      /**
     * Manages all models.
     */
    public function actionIndex() {
        $model = new Orders('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Orders']))
            $model->attributes = $_GET['Orders'];

        $this->render('index', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = Orders::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'orders-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
