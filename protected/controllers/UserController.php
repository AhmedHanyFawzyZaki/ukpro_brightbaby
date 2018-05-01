<?php

class UserController extends AdminController {

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
                //	'accessControl', // perform access control for CRUD operations
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
        $criteria = new CDbCriteria;
        $criteria->select = 't.*';
        $criteria->condition = 'user_id=' . $id;
        $UserData = UserDetails::model()->find($criteria);

        $this->render('view', array(
            'UserData' => $UserData,
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new User;
        $UserData = new UserDetails();
        $rnd = rand(0, 9999);  // generate random number between 0-9999
        $uploadedFile = CUploadedFile::getInstance($model, 'image');

        if (!empty($uploadedFile)) {
            $fileName = "{$rnd}-{$uploadedFile}";  // random number + file name
            $model->image = $fileName;
            $uploadedFile->saveAs(Yii::app()->basePath . '/../media/members/' . $fileName);
        }


        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model);


        if (isset($_POST['User'])) {
            $model->attributes = $_POST['User'];



            //	exit();

            if ($model->save()) {


                if (isset($_POST['UserDetails'])) {
                    $UserData->attributes = $_POST['UserDetails'];
                    $UserData->user_id = $model->id;
                    $UserData->save(false);
                }




                $this->redirect(array('view', 'id' => $model->id));
                //send an email and set notification
                Yii::app()->mailer->sendMIME(
                        'from@example.com', array(
                    'm.amer@egprosolutions.com',
                        ), 'Subject', 'This is the plain text body', '<html><body>This is the HTML body</body></html>'
                );
            }
        }

        $this->render('create', array(
            'UserData' => $UserData,
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

        $criteria = new CDbCriteria;
        $criteria->select = 't.*';
        $criteria->condition = 'user_id=' . $id;
        $UserData = UserDetails::model()->find($criteria);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['User'])) {
            if ($model->image != '') {
                $_POST['User']['image'] = $model->image;
            }

            $model->attributes = $_POST['User'];

            $uploadedFile = CUploadedFile::getInstance($model, 'image');

            if (!empty($uploadedFile)) {
                if ($model->image == '') {
                    $rnd = rand(0, 9999);
                    $fileName = "{$rnd}-{$uploadedFile}";
                    $model->image = $fileName;
                }

                $uploadedFile->saveAs(Yii::app()->basePath . '/../media/members/' . $model->image);
            }


            if ($model->save()) {
                if (isset($_POST['UserDetails'])) {
                    $UserData->attributes = $_POST['UserDetails'];
                    $UserData->save(false);
                }
                $this->redirect(array('view', 'id' => $model->id));
            }
        }


        $model->password = $model->simple_decrypt($model->password);
        $this->render('update', array(
            'model' => $model,
            'UserData' => $UserData,
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
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
        else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $model = new User('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['User']))
            $model->attributes = $_GET['User'];

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
        $model = User::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'user-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    protected function beforeSave() {
        if (parent::beforeSave()) {
            $this->pwd_hash = $this->hash($this->password);
            return true;
        }
        return false;
    }

    // Authentication methods
    public function hash($value) {
        return crypt($value);
    }

    public function check($value) {
        $new_hash = crypt($value, $this->pwd_hash);
        if ($new_hash == $this->pwd_hash) {
            return true;
        }
        return false;
    }

    ///// using it in newsletter
    public function actionGet_filter_users() {
        $filter = $_POST['filter'];

        $criteria = new CDbCriteria;

        if ($filter == 0) {
            
        } else if ($filter == 1) {
            $criteria->condition = 'subscribe = 1';
        }

        $Users = User::model()->findAll($criteria);
        $i = 0;
        foreach ($Users as $User) {
            $List.='<label class="checkbox" style="padding-top:0">
	 		   <input id="NewsletterMessage_user_selection_' . $i . '" type="checkbox" name="NewsletterMessage[user_selection][]" class="listMEM" value="' . $User->id . '">
	 		   <label for="NewsletterMessage_user_selection_' . $i . '">' . $User->email . '</label>
	 		   </label>';
            $i++;
        }
        echo $List;
        Yii::app()->end();
    }

}
