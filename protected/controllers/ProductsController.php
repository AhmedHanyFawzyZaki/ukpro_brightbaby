<?php

class ProductsController extends AdminController {

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
        $model = new Products;


        if ($model->gallery_id == '') {


            $gallery = new Gallery();
            $gallery->name = true;
            $gallery->description = true;
            $gallery->versions = array(
                'small' => array(
                    'resize' => array(200, null),
                ),
                'medium' => array(
                    'resize' => array(800, null),
                )
            );
            $gallery->save();
        }
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        $model->gallery_id = $gallery->id;

        if (isset($_POST['Products'])) {
            if ($_POST['Products']['sizing'] == null) {
                $sizing = '
					<table class="table table-bordered">
                        <thead>
                            <tr>
                            <th>header</th>
                            <th>header</th>
                            <th>header</th>
                            <th>header</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            <td>cell</td>
                            <td>cell</td>
                            <td>cell</td>
                            <td>cell</td>
                            </tr>
                            
                            <tr>
                            <td>cell</td>
                            <td>cell</td>
                            <td>cell</td>
                            <td>cell</td>
                            </tr>
                            
                            <tr>
                            <td>cell</td>
                            <td>cell</td>
                            <td>cell</td>
                            <td>cell</td>
                            </tr>
                            
                            <tr>
                            <td>cell</td>
                            <td>cell</td>
                            <td>cell</td>
                            <td>cell</td>
                            </tr>
                        </tbody>
                    </table>';
                $_POST['Products']['sizing'] = $sizing;
            }
            if ($_POST['Products']['love_it'] == null) {
                $loveit = '
						<ul class="tab_ul">
	                       <li><b class="maincolor">Luxuriously soft 100% organic cotton</b><br/>
	                       <i>to keep them snug and cosy</i></li>
	                        
	                       <li><b class="maincolor">Integrated scratch mittens</b><br/>
	                       <i>so there little sharp nails do no damage</i></li>
	                        
	                       <li><b class="maincolor">Extra long feet </b><br/>
	                       <i>so they last longer for the big foot babies out there</i></li>
	                        
	                       <li><b class="maincolor">Slip preventing foot grips</b><br/>
	                       <i>for those table top dancing babies</i></li>
	                        
	                       <li><b class="maincolor">Easy open and close front poppers</b><br/>
	                       <i>to make life easier for mum</i></li>
	                    </ul>
						';
                $_POST['Products']['love_it'] = $loveit;
            }
            // ======================== Creating Slug ================================== //
            $slug = $_POST['Products']['title'];
            $_POST['Products']['slug'] = Products::model()->slugify($slug);
            // ======================================================================== //
            $model->attributes = $_POST['Products'];
            $rnd = rand(0, 9999);  // generate random number between 0-9999
            $uploadedFile = CUploadedFile::getInstance($model, 'image');

            if (!empty($uploadedFile)) {
                $fileName = "{$rnd}-{$uploadedFile}";  // random number + file name
                $model->image = $fileName;
                $uploadedFile->saveAs(Yii::app()->basePath . '/../media/products/' . $fileName);
            }


            if ($model->save()) {

                $szs = $_POST['Products']['sizes'];
                for ($i = 0; $i <= sizeof($szs) - 1; $i++) {
                    $product_details = new ProductsSizes();
                    $product_details->product_id = $model->id;
                    $product_details->size = $szs[$i];
                    $product_details->qty = $_POST['qty_' . $szs[$i]];
                    $product_details->isNewRecord = true;
                    $product_details->save(false);
                }


                $clrs = $_POST['Products']['colors'];
                for ($i = 0; $i <= sizeof($clrs) - 1; $i++) {
                    $product_colors_details = new ProductsColors();
                    $product_colors_details->product_id = $model->id;
                    $product_colors_details->color_id = $clrs[$i];
                    $product_colors_details->isNewRecord = true;
                    $product_colors_details->save(false);
                }

                //$product_details->save(false);

                $this->redirect(array('view', 'id' => $model->id));
            }
        }

        //$model->gallery_id= $gallery->id;
        $gallery = Gallery::model()->findByPk($model->gallery_id);


        $this->render('create', array(
            'model' => $model, 'gallery' => $gallery
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // ==================================================================================================================================== // 
        $criteria = new CDbCriteria;
        $criteria->select = 't.*';
        $criteria->condition = 'product_id=' . $model->id;
        $sizes = ProductsSizes::model()->findAll($criteria);

        $i = 0;
        foreach ($sizes as $key) {
            $arr[$i] = $key['size'];
            $i++;
        }
        // ==================================================================================================================================== //
        // ==================================================================================================================================== // 
        $criteria = new CDbCriteria;
        $criteria->select = 't.*';
        $criteria->condition = 'product_id=' . $model->id;
        $colors = ProductsColors::model()->findAll($criteria);

        $i = 0;
        foreach ($colors as $key) {
            $arrOfColors[$i] = $key['color_id'];
            $i++;
        }
        // ==================================================================================================================================== //
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Products'])) {

            ProductsSizes::DelAll($model->id);
            if (!empty($_POST['Products']['sizes'])) {

                $szs = $_POST['Products']['sizes'];
                for ($i = 0; $i <= sizeof($szs) - 1; $i++) {
                    $product_details = new ProductsSizes();
                    $product_details->product_id = $model->id;
                    $product_details->size = $szs[$i];
                    $product_details->qty = $_POST['qty_' . $szs[$i]];
                    $product_details->isNewRecord = true;
                    $product_details->save(false);
                }
            }
            ProductsColors::DelAll($model->id);
            if (!empty($_POST['Products']['colors'])) {

                $clrs = $_POST['Products']['colors'];
                for ($i = 0; $i <= sizeof($clrs) - 1; $i++) {
                    $product_colors_details = new ProductsColors();
                    $product_colors_details->product_id = $model->id;
                    $product_colors_details->color_id = $clrs[$i];
                    $product_colors_details->isNewRecord = true;
                    $product_colors_details->save(false);
                }
            }

            if ($model->image != '') {
                $_POST['Products']['image'] = $model->image;
            }

            // ======================== Creating Slug ================================== //
            $slug = $_POST['Products']['title'];
            $_POST['Products']['slug'] = Products::model()->slugify($slug);
            // ======================================================================== //
            $model->attributes = $_POST['Products'];
            $uploadedFile = CUploadedFile::getInstance($model, 'image');

            if (!empty($uploadedFile)) {
                $rnd = rand(0, 9999);
                $fileName = "{$rnd}-{$uploadedFile}";
                $model->image = $fileName;

                $uploadedFile->saveAs(Yii::app()->basePath . '/../media/products/' . $model->image);
            }
            if ($model->save()) {




                $this->redirect(array('view', 'id' => $model->id));
            }
        }
        $gallery = Gallery::model()->findByPk($model->gallery_id);


        /* $criteria=new CDbCriteria;
          $criteria->select = 'size';
          $criteria->condition='product_id=:product_id';
          $criteria->params=array(':product_id'=>$model->id);
          $usermodel=ProductsSizes::model()->findAll($criteria); */


        $this->render('update', array(
            'model' => $model,
            'gallery' => $gallery,
            'arr' => $arr,
            'arrOfColors' => $arrOfColors,
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
    public function actionIndex() {
        $model = new Products('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Products']))
            $model->attributes = $_GET['Products'];

        $this->render('index', array(
            'model' => $model,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $dataProvider = new CActiveDataProvider('Products');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = Products::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'products-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionOrder() {
        $products = Products::model()->findAll();

        if ($_POST['save']) {
            foreach ($products as $prod) {
                $prod->bg_order = $_POST['bg_' . $prod->id];
                $prod->us_order = $_POST['us_' . $prod->id];
                $prod->save(false);
            }
        }

        $this->render('products_order', array('products' => $products));
    }

}
