<?php

class NewsletterMessageController extends AdminController {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
                //'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'users' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

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
        $model = new NewsletterMessage;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['NewsletterMessage'])) {
            $model->attributes = $_POST['NewsletterMessage'];
            if ($model->save()) {
                $parameters = Settings::model()->findByPk(1);
                $site_mail = $parameters['email'];

                $mail = new YiiMailer();
                $mail->setLayout('newsletter');
                $mail->setFrom($site_mail, 'BrightBaby');
                $mail->setSubject($model->subject);

                /*$criteria = new CDbCriteria;
                $criteria->order = 'id DESC';
                $criteria->limit = '6';
                $prods = Products::model()->findAll($criteria);

                $message = "";

                for ($i = 3; $i < 6; $i++) {
                    $message .= '<div style="float:left;width:100px;padding:10px;margin-left:65px;text-align:center;font-size: 12px;">
                <a style="text-decoration:none;color:#000;" href="' . yii::app()->getBaseUrl(true) . '/home/productDetails/' . $prods[$i]->slug . '"><img style="border: 1px solid #640092;width:100px;height:100px;" src="http://brightbaby.domains4reg.com/media/products/' . $prods[$i]->image . '" alt="" /></a>
                <a style="text-decoration:none;color:#000;" href="' . yii::app()->getBaseUrl(true) . '/home/productDetails/' . $prods[$i]->slug . '"><p style="padding:0;">' . $prods[$i]->title . '</p></a>
                <span>&pound; ' . $prods[$i]->price . '</span>
            </div>';
                }
                
                $message .= '<div style="width: 100%;height: 30px;clear: both;"></div>';

                for ($i = 3; $i < 6; $i++) {
                    $message .= '<div style="float:left;width:100px;padding:10px;margin-left:65px;text-align:center;font-size: 12px;">
                <a style="text-decoration:none;color:#000;" href="' . yii::app()->getBaseUrl(true) . '/home/productDetails/' . $prods[$i]->slug . '"><img style="border: 1px solid #640092; width:100px;height:100px;" src="http://brightbaby.domains4reg.com/media/products/' . $prods[$i]->image . '" alt="" /></a>
                <a style="text-decoration:none;color:#000;" href="' . yii::app()->getBaseUrl(true) . '/home/productDetails/' . $prods[$i]->slug . '"><p style="padding:0;">' . $prods[$i]->title . '</p></a>
                <span>&pound; ' . $prods[$i]->price . '</span>
            </div>';
                }
                
                $message .= '<div style="width: 100%;height: 30px;clear: both;"></div>';
                
                $mail->setBody($message);*/
                ///// get user email
                $model = NewsletterMessage::model()->findByPk($model->id);
                //array('m.amer@ukprosolutions.com','test2@ukprosolutions.com','test@ukprosolutions.com');
                //echo $model->List_arr2;die();
                $recs = "";
                if ($_POST['NewsletterMessage']['filter']) {
                    $recs = $model->List_arr2;
                } else {
                    $temp = array();
                    if ($model->users_id) {
                        $criteria = new CDbCriteria;
                        $criteria->addInCondition('id', explode(',', $model->users_id));
                        $users = User::model()->findAll($criteria);
                        if ($users) {
                            foreach ($users as $u) {
                                $temp[] = $u->email;
                            }
                        }
                    }
                    $recs = $temp;
                }
                $mail->setTo($recs);
                $mail->send();

                $this->redirect(array('view', 'id' => $model->id));
            }
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

        if (isset($_POST['NewsletterMessage'])) {
            $model->attributes = $_POST['NewsletterMessage'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
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
        } else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $model = new NewsletterMessage('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['NewsletterMessage']))
            $model->attributes = $_GET['NewsletterMessage'];

        $this->render('index', array(
            'model' => $model,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new NewsletterMessage('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['NewsletterMessage']))
            $model->attributes = $_GET['NewsletterMessage'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = NewsletterMessage::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'newsletter-message-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
