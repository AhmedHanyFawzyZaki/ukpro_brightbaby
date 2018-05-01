<?php

class HomeController extends FrontController {

    /**
     * Declares class-based actions.
     */
    public $prod = null;
    public $prod_photos = null;
    public $cat_img = null;

    public function actions() {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewActionM',
            ),
        );
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex() {
        if (Yii::app()->request->cookies['userEmail'] != '' && Yii::app()->request->cookies['userPassword'] != '') {
            $identity = new UserIdentity(Yii::app()->request->cookies['userEmail'], User::model()->simple_decrypt(Yii::app()->request->cookies['userPassword']));
            $identity->authenticate();
            Yii::app()->user->login($identity);
        }

        $bannerPhotos = Banner::model()->findAll();
        $this->render('index', array('model' => $model,
            'bannerPhotos' => $bannerPhotos));
    }

    public function actionFaq() {
        $page = Pages::model()->findByPk(6);
        // renders the view file 'protected/views/site/index.php'
        // using the default layout 'protected/views/layouts/main.php'
        $model = Faq::model()->findAll();
        $this->render('faq', array('faqs' => $model, 'page' => $page));
    }

    public function actionShipping() {
        $page = Pages::model()->findByPk(4);
        // renders the view file 'protected/views/site/index.php'
        // using the default layout 'protected/views/layouts/main.php'
        $model = Shipping::model()->findAll();
        $this->render('shipping', array('infos' => $model, 'page' => $page));
    }

    public function actionPress() {
        $page = Pages::model()->findByPk(13);
        // renders the view file 'protected/views/site/index.php'
        // using the default layout 'protected/views/layouts/main.php'
        $model = Press::model()->findAll();
        $this->render('press', array('news' => $model, 'page' => $page));
    }

    /**
     * Displays the contact page
     */
    public function actionContact() {
        $page = Pages::model()->findByPk(5);
        //echo Helper::yiiparam('adminEmail');

        $model = new ContactForm;


        if (isset($_POST['ContactForm'])) {

            $model->attributes = $_POST['ContactForm'];
            if ($model->validate()) {
                $username = '=?UTF-8?B?' . base64_encode($model->username) . '?=';
                $subject = '=?UTF-8?B?' . base64_encode($model->subject) . '?=';
                $headers = "From: $username <{$model->email}>\r\n" .
                        "Reply-To: {$model->email}\r\n" .
                        "MIME-Version: 1.0\r\n" .
                        "Content-type: text/plain; charset=UTF-8";

                mail(Yii::app()->params['adminEmail'], $subject, $model->details, $headers);
                Yii::app()->user->setFlash('contact', 'Thank you for contacting us. We will respond to you as soon as possible.');
                $this->refresh();
            }
        }
        $this->render('contact', array('model' => $model, 'page' => $page));
    }

    /* registeraion steps and functions  */

    public function actionRegister() {
        $model = new User('register');
        if ($_POST['mail'] != '') {
            $model->email = $_POST['mail'];
        }

        if (isset($_POST['User'])) {
            $model->attributes = $_POST['User'];
            $model->subscribe = 1;
            if ($model->save()) {

                //create the user details  record
                $user_details = new UserDetails();
                $user_details->user_id = $model->id;
                $user_details->country_id = $model->country_id;
                $user_details->save(false);

                Yii::app()->user->id = $model->id;
                Yii::app()->user->setState('username', $model->username);
                Yii::app()->user->setState('fname', $model->fname);
                Yii::app()->user->setState('lname', $model->lname);
                Yii::app()->user->setState('email', $model->email);
                Yii::app()->user->setState('group', $model->groups_id);

                $mail = new YiiMailer();
                $mail->setLayout('test_mail');
                $mail->setFrom(Yii::app()->params['adminEmail'], 'BrightBaby');
                $mail->setTo($model->email);
                $mail->setSubject('Welcome to BrightBaby');

                $message = $model->email;

                $mail->setBody($message);


                if ($mail->send()) {

                    $name = 'userEmail'; // cookie name
                    $value = $model->email; // cookie value
                    $cookieEmail = new CHttpCookie($name, $value);
                    $cookieEmail->expire = time() + (60 * 60 * 24);
                    Yii::app()->request->cookies[$name] = $cookieEmail;

                    $pass = 'userPassword'; // cookie name
                    $value1 = $model->password; // cookie value
                    $cookiePassword = new CHttpCookie($pass, $value1);
                    $cookiePassword->expire = time() + (60 * 60 * 24);
                    Yii::app()->request->cookies[$pass] = $cookiePassword;

                    Yii::app()->user->setFlash('register-success', 'Thank you for creating an account with Bright Baby. You will receive an email shortly to confirm your registration.');
                    $model->unsetAttributes();
                    $user_details->unsetAttributes();
                    $this->redirect(array('registeration_complete'));
                } else {
                    Yii::app()->user->setFlash('error', 'Error while sending email: ' . $mail->getError());
                }
            }
        }

        $this->render('register', array(
            'model' => $model,
        ));
    }

    /**
     * Displays the login page
     */
    public function actionLogin() {
        $check = $_REQUEST['purchase'];
        $unsub = $_REQUEST['unsubscribe'];

        $forgotPassword = new User();
        if (isset($_POST['User'])) {
            $forgotPassword->attributes = $_POST['User'];

            $criteria = new CDbCriteria;
            $criteria->condition = 'LOWER(email)=:email';
            $criteria->params = array(':email' => strtolower($forgotPassword->email));
            $usermodel = User::model()->find($criteria);
            if (count($usermodel) == 0) {
                Yii::app()->user->setFlash('ErrorMsg', 'Sorry, there\'s no account associated with that email address');
            } else {

                //create randomkey
                $key = Helper::GenerateRandomKey();
                $usermodel->pass_reset = 1;
                $usermodel->pass_code = $key;
                $usermodel->save(false);

                $mail = new YiiMailer();
                $mail->setFrom(Yii::app()->params['adminEmail'], 'BrightBaby');
                $mail->setTo($forgotPassword->email);
                $mail->setSubject('BrightBaby Password reset');

                $message = 'Dear customer,

				Please follow this link to reset your password :
				Username:' . $usermodel->username . '
				URL:   ' . Yii::app()->params['webSite'] . '/home/reset/hash/' . $usermodel->pass_code . '
				';
                $mail->setBody($message);
                if ($mail->send()) {
                    Yii::app()->user->setFlash('register-success', 'Thank you! An activation email has been sent to your email address.');
                } else {
                    Yii::app()->user->setFlash('error', 'Error while sending email: ' . $mail->getError());
                }
                Yii::app()->user->setFlash('ErrorMsg', 'You will now recieve an email sent to <b> ' . $usermodel->email . ' </b> which will allow you to reset your password');
            }
        }
        $model = new LoginForm;

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['LoginForm'])) {
            if ($check == '') {



                $model->attributes = $_POST['LoginForm'];
                // validate user input and redirect to the previous page if valid
                if ($model->validate() && $model->login()) {

                    if ($unsub == '1') {
                        $this->redirect(array('unsubscribe'));
                    } else if (Yii::app()->user->group == 1) {
                        $this->redirect(array('home/index'));
                    } else {
                        $this->redirect(array('dashboard/index'));
                    }
                }
            } else {
                $model->attributes = $_POST['LoginForm'];
                // validate user input and redirect to the previous page if valid
                if ($model->validate() && $model->login()) {

                    $m_user = User::model()->findByPk(Yii::app()->user->id);
                    $name = 'userEmail'; // cookie name
                    $value = $m_user->email; // cookie value
                    $cookieEmail = new CHttpCookie($name, $value);
                    $cookieEmail->expire = time() + (60 * 60 * 24);
                    Yii::app()->request->cookies[$name] = $cookieEmail;

                    $pass = 'userPassword'; // cookie name
                    $value1 = $m_user->password; // cookie value
                    $cookiePassword = new CHttpCookie($pass, $value1);
                    $cookiePassword->expire = time() + (60 * 60 * 24);
                    Yii::app()->request->cookies[$pass] = $cookiePassword;

                    if (Yii::app()->user->group == 1) {
                        $this->redirect(array('home/shippingdetails'));
                    } else {
                        $this->redirect(array('home/shippingdetails'));
                    }
                }
            }
        }
        // display the login form
        $this->render('login', array('model' => $model,
            'forgotPassword' => $forgotPassword));
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout() {
        Yii::app()->user->logout();
        unset(Yii::app()->request->cookies['userEmail']);
        unset(Yii::app()->request->cookies['userPassword']);
        //$this->redirect(Yii::app()->homeUrl);
        $this->redirect(array('home/login'));
    }

    /* ----  load dynamic pages ------- */

    public function loadPage($id) {
        $model = Pages::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function actionSend() {
        $mail = new YiiMailer();
        //$mail->clearLayout();//if layout is already set in config
        $mail->setFrom(Yii::app()->params['adminEmail'], 'BrightBaby');
        //$mail->setTo(Yii::app()->params['adminEmail']);

        $mail->setTo('test@ukprosolutions.com');
        $mail->setSubject('Mail subject');
        $mail->setBody('Simple message');

        //$mail->send();
        // send from a view
        $mail = new YiiMailer();
        $mail->setView('registersuccess');
        $mail->setData(array('name' => 'Message to send', 'pass' => 'John Doe', 'description' => 'Contact form'));

        if ($mail->send()) {
            Yii::app()->user->setFlash('contact', 'Thank you for contacting us. We will respond to you as soon as possible.');
        } else {
            Yii::app()->user->setFlash('error', 'Error while sending email: ' . $mail->getError());
        }







        //send attachements
        /*
          $mail->setAttachment('something.pdf');
          $mail->setAttachment(array('something.pdf','something_else.pdf','another.doc'));
          $mail->setAttachment(array('something.pdf'=>'Some file','something_else.pdf'=>'Another file'));

         */
    }

    //============================================= reset password ============================================= //
    public function actionReset($hash) {

        //  echo $hash;

        $criteria = new CDbCriteria;
        $criteria->condition = 'pass_code=:Hash and pass_reset=1';
        $criteria->params = array(':Hash' => $hash);
        $user_found = User::model()->find($criteria);

        if (count($user_found) == 0) {
            $flag = 0;
            Yii::app()->user->setFlash('ErrorMsg', 'Sorry you have followed a wrong link .');
        } else {
            $flag = 1;
        }

        $model = new User('passreset');


        if (isset($_POST['User']) and count($user_found) != 0) {
            $model->attributes = $_POST['User'];

            $user_found->pass_reset = 0;
            $user_found->pass_code = '';
            $user_found->password = $model->newpassword = $_POST['User']['newpassword'];

            $user_found->save(false);

            /* $notify= new Notification();
              $notify->type=4;
              $notify->notify_from=1; // admin user has static id
              $notify->notify_to= $user_found->id;
              $notify->title= 'Password changed  ';
              $notify->details='Your password has been changed successfully .';
              $notify->save(false); */

            Yii::app()->user->setFlash('ErrorMsg', ' Please Login with your new password');

            $this->redirect(array('home/login'));
        }


        $this->render('resetpass', array('model' => $model, 'flag' => $flag));
    }

    // ===================================== end of reset password ================================================= //

    /* public function actionChangePassword()

      {
      $model= new User('passreset');
      $id=Yii::app()->user->id;
      $model=User::model()->findByPk($id);
      if(isset($_POST['User']))
      {
      $model->attributes=$_POST['User'];
      $model->pass_reset=0;
      $model->pass_code='';
      $model->password=$model->newpassword=$_POST['User']['newpassword'];
      $model->save(false);
      //Yii::app()->user->setFlash('ErrorMsg', ' Please Login with your new credentials');
      $this->redirect(Yii::app()->request->urlReferrer);

      }
      $this->redirect(Yii::app()->request->urlReferrer);
      } */


    // ================================================================================================================== //
    public function actionAddNewMail($email = '') {
        $email = $_POST['email'];
        if ($email && $email != null) {
            $criteria = new CDbCriteria;
            $criteria->condition = 'email=:email';
            $criteria->params = array(':email' => $email);
            $mail = Newsletters::model()->find($criteria);
            if ($mail != '') {
                echo "1";
            } else {
                $model = new Newsletters('newsletter');
                $model->attributes = $_POST['Newsletters'];
                $model->email = $email;

                if (!Yii::app()->user->isGuest) {
                    $model->user_id = Yii::app()->user->id;
                }
                if ($model->save()) {
                    echo "2";
                } else {
                    echo "3";
                }
            }
        }
    }

    // ================================================================================================================ //
    public function actionBabyGrows() {


        //$products=Products::model()->findAll();
        $criteria = new CDbCriteria;
        $criteria->select = 't.*';
        $criteria->condition = 'cat_id like "%4%"';
        $criteria->order = "bg_order ASC";
        $category_img = ProductCategory::model()->findByPk('4')->image;
        $this->cat_img = $category_img;
        $products = Products::model()->findAll($criteria);

        $this->render('baby_grows', array('products' => $products, 'category_img' => $category_img));
    }

    // =================================================================================================================== //
    public function actionBabyGirl() {
        $criteria = new CDbCriteria;
        $criteria->select = 't.*';
        $criteria->condition = 'cat_id like "%2%"';
        $category_img = ProductCategory::model()->findByPk('2')->image;
        $this->cat_img = $category_img;
        $products = Products::model()->findAll($criteria);
        $this->render('baby_girl', array('products' => $products, 'category_img' => $category_img));
    }

    // =================================================================================================================== //
    public function actionBabyBoy() {
        $criteria = new CDbCriteria;
        $criteria->select = 't.*';
        $criteria->condition = 'cat_id like "%1%"';
        $category_img = ProductCategory::model()->findByPk('1')->image;
        $this->cat_img = $category_img;
        $products = Products::model()->findAll($criteria);
        $this->render('baby_boy', array('products' => $products, 'category_img' => $category_img));
    }

    // =================================================================================================================== //
    public function actionUnisex() {
        $criteria = new CDbCriteria;
        $criteria->select = 't.*';
        $criteria->condition = 'cat_id like "%3%"';
        $criteria->order = "us_order ASC";
        $category_img = ProductCategory::model()->findByPk('3')->image;
        $this->cat_img = $category_img;
        $products = Products::model()->findAll($criteria);
        $this->render('unisex', array('products' => $products, 'category_img' => $category_img));
    }

    // ===================================== start of displaying product details ========================================= //
    public function actionProductDetails() {
        $id = $_REQUEST['slug'];



        $criteria = new CDbCriteria;
        $criteria->select = 't.*';
        $criteria->condition = 'slug=:slug';
        $criteria->params = array(':slug' => $id);
        $details = Products::model()->find($criteria);

        $this->prod = $details;

        /* $criteria3=new CDbCriteria;
          $criteria3->select = 't.*';
          $criteria3->condition='cat_id=:cat_id';
          $criteria3->params=array(':cat_id'=>$details->cat_id);
          $criteria3->addCondition('id !='.$details->id);
          $criteria3->limit=3;
          $similiarProducts = Products::model()->findAll($criteria3); */

        $criteria3 = new CDbCriteria;
        $criteria3->select = 't.*';
        $criteria3->condition = 'product_id=' . $details->id;
        $criteria3->order = 'sort ASC';
        $similiarProducts = RecomendedProducts::model()->findAll($criteria3);


        $criteria1 = new CDbCriteria;
        $criteria1->select = 't.*';
        $criteria1->condition = 'gallery_id=:gallery_id';
        $criteria1->params = array(':gallery_id' => $details->gallery_id);
        $photo = GalleryPhoto::model()->findAll($criteria1);
        $this->prod_photos = $photo;

        $criteria2 = new CDbCriteria;
        $criteria2->select = 't.*';
        $criteria2->condition = 'product_id=:product_id';
        $criteria2->params = array(':product_id' => $details->id);
        $sizes = ProductsSizes::model()->findAll($criteria2);

        $criteria4 = new CDbCriteria;
        $criteria4->select = 't.*';
        $criteria4->condition = 'product_id=:product_id';
        $criteria4->params = array(':product_id' => $details->id);
        $colors = ProductsColors::model()->findAll($criteria4);

        $this->render('product_details', array('details' => $details,
            'photo' => $photo,
            'colors' => $colors,
            'similiarProducts' => $similiarProducts,
            'sizes' => $sizes));
    }

    public function actionError() {
        if ($error = Yii::app()->errorHandler->error)
            $this->render("error", array("error" => $error));
    }

    // =================================================================================================================== //
    public function ing() {
        //$values=explode(',', $_REQUEST['checkedValue'] );
        $checkedValue = $_REQUEST['checkedValue'];
        $cat_id = $_REQUEST['cat_id'];
        //var_dump($checkedValue);
        $site_arr = explode(',', $checkedValue);

        for ($i = 0; $i < count($site_arr); $i++) {
            if (!empty($site_arr[$i]))
                $arr[] = $site_arr[$i];
        }

        $criteria = new CDbCriteria;
        $criteria->select = 'distinct(`product_id`)';
        //$criteria->condition='1=1';
        if (!empty($arr)) {

            $criteria->addCondition('`size` in (' . implode(',', $arr) . ')');
        }

        $products = ProductsSizes::model()->findAll($criteria);
        $list = '<ul class="thumbnails left20 topMargin20"  id="test">';
        foreach ($products as $product) {
            $criteria1 = new CDbCriteria;
            //$criteria1->select = 'distinct(`id`)';
            $criteria1->select = '*';
            //$criteria1->condition='cat_id='.$cat_id;
            $criteria1->condition = 'id=' . $product->product_id;
            if (isset($cat_id)) {
                $criteria1->addCondition('cat_id=' . $cat_id);
            }

            $product_details = Products::model()->find($criteria1);
            if (!empty($product_details)) {

                $list .= '<li class="span3 xnew">
                                <div class="thumbnail txtcenter">
                                    <a href="' . Yii::app()->request->baseUrl . '/home/productDetails/' . $product_details->slug . '"><img src="' . Yii::app()->request->baseUrl . '/media/products/' . $product_details->image . '" alt=""></a>
                                    <div class="clear"></div>
                                    <a class="title-link" href="' . Yii::app()->request->baseUrl . '/home/productDetails/' . $product_details->slug . '">' . $product_details->title . '</a>
                                    <br/>
                                    <span class="site">&pound;' . $product_details->price . '</span>
                                    <br/>
                                </div>
                            </li>';
            }
        }
        $list.='</ul>';
        echo $list;
    }

    // =================================================================================================================== //

    public function actionCart($id, $action = '') {


        //echo $id;die();


        $product = Products::model()->findByPk($id);
        $flag = "";

        if ($action == '') {
            $flag = "add";
            $sz = Sizes::model()->findByAttributes(array('size' => $_REQUEST['size']));
            if ($sz) {
                if (ProductsSizes::get_qty($product->id, $sz->id) > 0) {
                    Yii::app()->shoppingCart->put($product); //1 item with id=1, quantity=1.
                    $action = 1;
                    $_SESSION['pro_color_' . $id] = $_REQUEST['color'];
                    $_SESSION['pro_size_' . $id] = $_REQUEST['size'];
                    $_SESSION['pro_size_id_' . $id] = $sz->id;
                    echo "done";
                } else {
                    echo "sorry  we can not supply more items from this product currently";
                }
            }
        } elseif ($action == 'remove') {
            Yii::app()->shoppingCart->remove($product->getId()); //no items
            unset($_SESSION['pro_color_' . $id]);
            unset($_SESSION['pro_size_' . $id]);
            unset($_SESSION['pro_size_id_' . $id]);
            $action = 2;
        } elseif ($action == 'clear') {
            Yii::app()->shoppingCart->clear(); //no items
        }

        if ($flag != "add") {
            $this->redirect(array('shoppingCart', 'action' => $action));
        }
    }

    // ================================================================================================================ //
    public function actionupdateCart() {

        $id = $_REQUEST['id'];
        $quant = $_REQUEST['quantity'];
        $sz = $_REQUEST['size_id'];
        /* echo '*******************'.$id.'<br/>'.'--------------'.$quant; exit(); */
        $product = Products::model()->findByPk($id);


        //Yii::app()->shoppingCart->update($product,$quant);
        //echo Yii::app()->shoppingCart->getCost();


        $count = ProductsSizes::get_qty($product->id, $sz);


        if ($count > 0 and $count >= $quant) {
            Yii::app()->shoppingCart->update($product, $quant);
            echo Yii::app()->shoppingCart->getCost();
        } else {
            echo '0';
        }
        /*         * *********************To Update the quantity of the cookies*************************** */
        $i = 0;
        $cart = Yii::app()->shoppingCart->getPositions();
        foreach ($cart as $item) {
            $cartItems[$i] = array($item->id, $item->getQuantity(), $_SESSION['pro_size_' . $item->id], $_SESSION['pro_color_' . $item->id], $_SESSION['pro_size_id_' . $item->id]);
            $i++;
        }
        $value = serialize($cartItems);

        $cookie = new CHttpCookie('TstCookies', $value);
        $cookie->expire = time() + 60 * 60 * 24;
        Yii::app()->request->cookies['TstCookies'] = $cookie;
    }

    //=================================================================================================== //
    public function actionshoppingCart($action = '') {
        $model = new Orders('create');
        $cart = Yii::app()->shoppingCart->getPositions();
        $i = 0;

    	foreach ($cart as $item) {
            $cartItems[$i] = array($item->id, $item->getQuantity(), $_SESSION['pro_size_' . $item->id], $_SESSION['pro_color_' . $item->id], $_SESSION['pro_size_id_' . $item->id]);
            $i++;
        }

    	$value = serialize($cartItems);

        $cookie = new CHttpCookie('TstCookies', $value);
        $cookie->expire = time() + 60 * 60 * 24;
        Yii::app()->request->cookies['TstCookies'] = $cookie;


        if (!Yii::app()->user->isGuest) {
            $id = Yii::app()->user->id;
            $user = User::model()->findByPk($id);

            $criteria = new CDbCriteria;
            $criteria->select = 't.*';
            $criteria->condition = 'user_id=' . $id;
            $userDetailsData = UserDetails::model()->find($criteria);
        }

        $this->render('cart', array('cart' => $cart,
            'discount' => $discount,
            'model' => $model,
            'action' => $action));
    }

    // ================================================================================================================= //
    // ============================================ Check Out process ( PayPal ) ====================================== //

    public function actionCheckout2() {
        // $model = new Orders('create');
        $model = Orders::model()->findByAttributes(array('id' => Yii::app()->user->getState('orderID')));
        if (Yii::app()->user->getState('orderID') != '') {

            $paymentInfo['Order']['theTotal'] = Yii::app()->user->getState('total');
            $paymentInfo['Order']['description'] = 'BrightBaby Payment';
            $paymentInfo['Order']['quantity'] = '1';
            // call paypal
            $result = Yii::app()->Paypal->SetExpressCheckout($paymentInfo);
            if (!Yii::app()->Paypal->isCallSucceeded($result)) {
                if (Yii::app()->Paypal->apiLive === true) {
                    //Live mode basic error message
                    $error = 'We were unable to process your request. Please try again later';
                } else {
                    //Sandbox output the actual error message to dive in.
                    $error = $result['L_LONGMESSAGE0'];
                }
                echo $error;
                Yii::app()->end();
            } else {
                // send user to paypal
                $token = urldecode($result["TOKEN"]);


                $model->attributes = $_POST['Orders'];
                $model->token = $token;
                //$model->price = Yii::app()->shoppingCart->getCost();
                $model->email = Yii::app()->user->email;
                $model->price = Yii::app()->user->getState('total');
                $model->order_date = date('Y-m-d H:i:s');
                $model->status = '1';
                $model->save(false);

                //$model->token= $token;
                //$model->d_date=date('Y-m-d H:i:s');
                //$model->email=$email;
                //  $model->save(false);//// saving the order
                $payPalURL = Yii::app()->Paypal->paypalUrl . $token . '&Order=' . $model->id;

                ///// still need to save in order details from shoping cart before going to paypal
                $cart = Yii::app()->shoppingCart->getPositions();

                foreach ($cart as $item) {
                    $order_details = new OrdersDetails('create');

                    $order_details->orders_id = $model->id;
                    //$order_details->fullname = $model->fullname;
                    //$order_details->username = $model->username;
                    //$order_details->address = $model->address;
                    //$order_details->email = $model->email;
                    $order_details->price = $item->price;
                    $order_details->start_date = date('Y-m-d H:i:s');
                    $order_details->qty = $item->getQuantity();
                    $order_details->pro_id = $item->id;
                    $order_details->color = $_SESSION['pro_color_' . $item->id];
                    $order_details->size = $_SESSION['pro_size_' . $item->id];
                    $order_details->save(false);


                    $updateSoldProducts = new Products();
                    $criteria = new CDbCriteria;
                    $criteria->select = 't.*';
                    $criteria->condition = 'id=' . $item->id;
                    $updateSoldProducts = Products::model()->find($criteria);
                    $updateSoldProducts->sold+=$item->getQuantity();
                    $updateSoldProducts->save(false);
                }
            }
            $this->redirect($payPalURL);
        }
        //  $this->render('checkout',array('model'=>$model));
    }

    public function actionCheckout() {
        // $model = new Orders('create');
        $model = Orders::model()->findByAttributes(array('id' => Yii::app()->user->getState('orderID')));
        if (Yii::app()->user->getState('orderID') != '') {

            $model->attributes = $_POST['Orders'];

            $model->price = Yii::app()->user->getState('total');
            $model->order_date = date('Y-m-d H:i:s');
            $model->status = '1';
            $model->discount_val = Yii::app()->session['discount_value'];
            $model->postage_val = Yii::app()->user->getState('postage');
            $model->save(false);


            $cart = Yii::app()->shoppingCart->getPositions();

            foreach ($cart as $item) {
			    $order_details = new OrdersDetails('create');
                $order_details->orders_id = $model->id;
                $order_details->price = $item->price;
                $order_details->start_date = date('Y-m-d H:i:s');
                $order_details->qty = $item->getQuantity();
                $order_details->pro_id = $item->id;
                $order_details->color = $_SESSION['pro_color_' . $item->id];
                $order_details->size = $_SESSION['pro_size_' . $item->id];
                $order_details->save(false);


               $upsold = ProductsSizes::model()->findByAttributes(array('product_id' => $item->id, 'size' => $_SESSION['pro_size_id_' . $item->id]));
                if ($upsold) {
                    $upsold->qty -= $item->getQuantity();
                    $upsold->save(false);
                }


            }

            $supp_price = Yii::app()->user->getState('total');
            $userp = User::model()->findByPk(Yii::app()->user->id);
            if ($userp->user_credit) {
                $temp = $userp->user_credit;
                if ($temp <= $supp_price) {
                    $userp->user_credit = '0';
                } else {
                    $userp->user_credit = $userp->user_credit - $supp_price;
                }
                $userp->password = $userp->simple_decrypt($userp->password);
                $userp->save(false);
                $supp_price = $supp_price - $temp;
            }
            if ($supp_price <= '0') {
                $model->status = '2';
                $model->notif = 1;
                $model->save();

                $ord_details = OrdersDetails::model()->findAllByAttributes(array("orders_id" => $model->id));
                $mail = new YiiMailer();
                $mail->setFrom(Yii::app()->params['adminEmail'], 'BrightBaby');
                $mail->setTo(Yii::app()->params['adminEmail']);
                $mail->setSubject('Order Notification');
                $ms = "a new order has been placed by " . Yii::app()->user->name . " and you can view the order from this link :- <br />";
                $ms .= Yii::app()->request->getBaseUrl(true) . "/orders/" . $model->id;
                $mail->setBody($ms);
                $mail->send();


                $mail = new YiiMailer();
                $mail->setLayout('order_template');
                $mail->setFrom(Yii::app()->params['adminEmail'], 'BrightBaby');
                $mail->setTo($model->email);
                $mail->setSubject('Order Confirmation');



                $mail->setBody($model);
                $mail->send();


                // need to clear cart
                Yii::app()->shoppingCart->clear();
                unset(Yii::app()->request->cookies['TstCookies']);
                unset(Yii::app()->session['discount_value']);
                $this->render('confirm', array('notif' => $model->notif));
            } else {
				
				/*$Barclays = new BarclaysPayment();
				$Barclays->set_secret(Yii::app()->params['sha_password']); 
				$Barclays->set_amount($supp_price * 100);
				$Barclays->set_pspid(Yii::app()->params['pspid']); 
				$Barclays->set_currency('GBP');
				$Barclays->set_order_id($model->id); 
				$Barclays->display();*/
				
                $sha_pas = Yii::app()->params['sha_password'];
                //$hash = "ACCEPTURL=" . Yii::app()->request->getBaseUrl(true) . '/home/confirm' . $sha_pas;
                $hash = "AMOUNT=".($supp_price * 100).$sha_pas;
                //$hash .= "CANCELURL=" . Yii::app()->request->getBaseUrl(true) . '/home/cancel' . $sha_pas;
                $hash .= "CURRENCY=GBP".$sha_pas;
                //$hash .= "DECLINEURL=" . Yii::app()->request->getBaseUrl(true) . '/home/decline' . $sha_pas;
                //$hash .= "EXCEPTIONURL=" . Yii::app()->request->getBaseUrl(true) . '/home/exception' . $sha_pas;
                $hash .= "LANGUAGE=en_US".$sha_pas;
                $hash .= "ORDERID=".$model->id.$sha_pas;
                $hash .= "PSPID=".Yii::app()->params['pspid'].$sha_pas;
                //$hash .= "TITLE=BrightBaby" . $sha_pas;

                $HashDigest = sha1($hash);
				Yii::app()->shoppingCart->clear();
               	unset(Yii::app()->request->cookies['TstCookies']);
                unset(Yii::app()->session['discount_value']);
                //$this->render('confirm', array('notif' => $model->notif));
				echo '
					<form action="https://payments.epdq.co.uk/ncol/prod/orderstandard.asp" method="post" id="form1" name="form1">
						<!--<input type="hidden" name="ACCEPTURL" value="'.urlencode(Yii::app()->request->getBaseUrl(true).'/home/confirm').'"><input type="hidden" name="CANCELURL" value="'.urlencode(Yii::app()->request->getBaseUrl(true).'/home/cancel').'"><input type="hidden" name="DECLINEURL" value="'.urlencode(Yii::app()->request->getBaseUrl(true).'/home/decline').'"><input type="hidden" name="EXCEPTIONURL" value="'.urlencode(Yii::app()->request->getBaseUrl(true).'/home/exception').'">-->
						<input type="hidden" name="AMOUNT" value="'.($supp_price * 100).'">
						
						<input type="hidden" name="CURRENCY" value="GBP">
						
						
						<input type="hidden" name="LANGUAGE" value="en_US">
						<input type="hidden" name="ORDERID" value="'.$model->id.'">
						<input type="hidden" name="PSPID" value="'.Yii::app()->params['pspid'].'">
						<input type="hidden" name="SHASIGN" value="'.$HashDigest.'">
					</form>
				';
				echo '<script>document.getElementById("form1").submit();</script>';

            	/*$link_url = 'https://payments.epdq.co.uk/ncol/prod/orderstandard.asp?PSPID=' . Yii::app()->params['pspid'] . '&ORDERID=' . $model->id . '&AMOUNT=' . ($supp_price * 100) . '&CURRENCY=GBP&LANGUAGE=en_US&ACCEPTURL=' . urlencode(Yii::app()->request->getBaseUrl(true) . '/home/confirm') . '&DECLINEURL=' . urlencode(Yii::app()->request->getBaseUrl(true) . '/home/decline') . '&EXCEPTIONURL=' . urlencode(Yii::app()->request->getBaseUrl(true) . '/home/exception') . '&CANCELURL=' . urlencode(Yii::app()->request->getBaseUrl(true) . '/home/cancel') . "&SHASIGN=" . $HashDigest;
            	$link_url = trim($link_url);*/
				//die;
       /*    	echo '<script>window.location.href ="https://payments.epdq.co.uk/ncol/prod/orderstandard.asp?PSPID=' . Yii::app()->params['pspid'] . '&ORDERID=' . $model->id . '&AMOUNT=' . ($supp_price * 100) . '&CURRENCY=GBP&LANGUAGE=en_US&ACCEPTURL=' . urlencode(Yii::app()->request->getBaseUrl(true) . '/home/confirm') . '&DECLINEURL=' . urlencode(Yii::app()->request->getBaseUrl(true) . '/home/decline') . '&EXCEPTIONURL=' . urlencode(Yii::app()->request->getBaseUrl(true) . '/home/exception') . '&CANCELURL=' . urlencode(Yii::app()->request->getBaseUrl(true) . '/home/cancel') . '&SHASIGN=' . $HashDigest.'";</script>';*/
    //        	$this->redirect($link_url);




   				//echo '<meta http-equiv="refresh" content="0; url='.$link_url.'"></meta>';

            	//die;
/*
     		//	$this->redirect(array($link_url));


if (stristr($_SERVER['HTTP_USER_AGENT'], 'Firefox') )

				else
					echo '<meta http-equiv="refresh" content="0;URL='.$link_url.'"></meta>' ;
*/
            //	die;
			//	$link=serialize($link_url);

            //	$this->render('payment', array('notif' => $model->notif,'link_url'=>$link,'model'=>$model,'HashDigest'=> $HashDigest));
            }
        }
    }

    public function actionConfirm() {
        //Detect errors
        $sha_pas = Yii::app()->params['sha_password'];

        if ($_GET['STATUS']) {
            $hash = "ACCEPTANCE=" . $_GET['ACCEPTANCE'] . $sha_pas;
            $hash .= "AMOUNT=" . $_GET['amount'] . $sha_pas;
            $hash .= "BRAND=" . $_GET['BRAND'] . $sha_pas;
            $hash .= "CARDNO=" . $_GET['CARDNO'] . $sha_pas;
            $hash .= "CN=" . $_GET['CN'] . $sha_pas;
            $hash .= "CURRENCY=" . $_GET['currency'] . $sha_pas;
            $hash .= "ED=" . $_GET['ED'] . $sha_pas;
            $hash .= "IP=" . $_GET['IP'] . $sha_pas;
            $hash .= "NCERROR=" . $_GET['NCERROR'] . $sha_pas;
            $hash .= "ORDERID=" . $_GET['orderID'] . $sha_pas;
            $hash .= "PAYID=" . $_GET['PAYID'] . $sha_pas;
            $hash .= "PM=" . $_GET['PM'] . $sha_pas;
            $hash .= "STATUS=" . $_GET['STATUS'] . $sha_pas;
            $hash .= "TRXDATE=" . $_GET['TRXDATE'] . $sha_pas;

            $HashDigest = sha1($hash);

            if (strtolower($HashDigest) == strtolower($_GET['SHASIGN'])) {
                $plc = PaymentLog::model()->findByAttributes(array('user_id' => Yii::app()->user->id, 'order_hash' => strtolower($HashDigest)));

                if (!$plc) {
                    if ($_GET['STATUS'] == '5' || $_GET['STATUS'] == '9') {
                        $model = Orders::model()->findByPk($_GET['orderID']);
                        if ($model->status == '1') {
                            $model->status = '2';
                            $model->pay_id = $_GET['PAYID'];
                            $model->save();



                            $ord_details = OrdersDetails::model()->findAllByAttributes(array("orders_id" => $model->id));
                            $mail = new YiiMailer();
                            $mail->setFrom(Yii::app()->params['adminEmail'], 'BrightBaby');
                            $mail->setTo(Yii::app()->params['adminEmail']);
                            $mail->setSubject('Order Notification');
                            $ms = "a new order has been placed by " . Yii::app()->user->name . " and you can view the order from this link :- <br />";
                            $ms .= Yii::app()->request->getBaseUrl(true) . "/orders/" . $model->id;
                            $mail->setBody($ms);
                            $mail->send();

                            $order_details = OrdersDetails::model()->findAllByAttributes(array("orders_id" => $model->id));
                            $mail = new YiiMailer();
                            $mail->setLayout('order_template');
                            $mail->setFrom(Yii::app()->params['adminEmail'], 'BrightBaby');
                            $mail->setTo($model->email);
                            $mail->setSubject('Order Confirmation');


                            $mail->setBody($model);
                            $mail->send();


                            // need to clear cart
                            Yii::app()->shoppingCart->clear();
                            unset(Yii::app()->request->cookies['TstCookies']);
                            unset(Yii::app()->session['discount_value']);
                        }

                        $pl = new PaymentLog;
                        $pl->user_id = Yii::app()->user->id;
                        $pl->order_hash = strtolower($HashDigest);
                        $pl->save(false);

                        $this->render('confirm', array('notif' => $model->notif));
                    } else {

                    }
                } else {
                    throw new CHttpException(404, "this page doesn't exist");
                }
            } else {
                throw new CHttpException(404, "Wrong Redirection");
            }
        }
    }

    public function actionConfirm2() {
        $token = trim($_GET['token']);
        $payerId = trim($_GET['PayerID']);
        $criteria = new CDbCriteria;
        $criteria->condition = 'token=:Tokenw';
        $criteria->params = array(':Tokenw' => $token);
        $orders = Orders::model()->find($criteria);
        $result = Yii::app()->Paypal->GetExpressCheckoutDetails($token);
        $result['PAYERID'] = $payerId;
        $result['TOKEN'] = $token;
        $result['ORDERTOTAL'] = $orders->price;
        //Detect errors
        if (!Yii::app()->Paypal->isCallSucceeded($result)) {
            if (Yii::app()->Paypal->apiLive === true) {
                //Live mode basic error message
                $error = 'We were unable to process your request. Please try again later';
            } else {
                //Sandbox output the actual error message to dive in.
                $error = $result['L_LONGMESSAGE0'];
            }
            echo $error;
            Yii::app()->end();
        } else {
            $paymentResult = Yii::app()->Paypal->DoExpressCheckoutPayment($result);
            //Detect errors
            if (!Yii::app()->Paypal->isCallSucceeded($paymentResult)) {
                if (Yii::app()->Paypal->apiLive === true) {
                    //Live mode basic error message
                    $error = 'We were unable to process your request. Please try again later';
                } else {
                    //Sandbox output the actual error message to dive in.
                    $error = $paymentResult['L_LONGMESSAGE0'];
                }
                echo $error;
                Yii::app()->end();
            } else {
                //payment was completed successfully
                if ($orders->status == '1') {
                    $orders->status = '2';
                    $orders->save();
                    // need to clear cart
                    Yii::app()->shoppingCart->clear();
                }
                $this->render('confirm', array('orders' => $orders));
            }
        }
    }

    public function actionCancel() {
        //The token of the cancelled payment typically used to cancel the payment within your application
        //$token = trim($_GET['token']);
        //  $payerId = trim($_GET['PayerID']);
        $sha_pas = Yii::app()->params['sha_password'];

        if ($_GET['STATUS']) {
            if ($_GET['ACCEPTANCE']) {
                $hash = "ACCEPTANCE=" . $_GET['ACCEPTANCE'] . $sha_pas;
                $hash .= "AMOUNT=" . $_GET['amount'] . $sha_pas;
            } else {
                $hash = "AMOUNT=" . $_GET['amount'] . $sha_pas;
            }

            if ($_GET['BRAND']) {
                $hash .= "BRAND=" . $_GET['BRAND'] . $sha_pas;
            }
            if ($_GET['CARDNO']) {
                $hash .= "CARDNO=" . $_GET['CARDNO'] . $sha_pas;
            }
            if ($_GET['CN']) {
                $hash .= "CN=" . $_GET['CN'] . $sha_pas;
            }
            $hash .= "CURRENCY=" . $_GET['currency'] . $sha_pas;
            if ($_GET['ED']) {
                $hash .= "ED=" . $_GET['ED'] . $sha_pas;
            }
            $hash .= "IP=" . $_GET['IP'] . $sha_pas;
            if ($_GET['NCERROR']) {
                $hash .= "NCERROR=" . $_GET['NCERROR'] . $sha_pas;
            }
            $hash .= "ORDERID=" . $_GET['orderID'] . $sha_pas;
            $hash .= "PAYID=" . $_GET['PAYID'] . $sha_pas;
            if ($_GET['PM']) {
                $hash .= "PM=" . $_GET['PM'] . $sha_pas;
            }
            $hash .= "STATUS=" . $_GET['STATUS'] . $sha_pas;
            $hash .= "TRXDATE=" . $_GET['TRXDATE'] . $sha_pas;

            $HashDigest = sha1($hash);

            if (strtolower($HashDigest) == strtolower($_GET['SHASIGN'])) {
                $orders = Orders::model()->findByPk($_GET['orderID']);
                if ($orders) {
                    if ($orders->status == '1') {
                        $orders->status = '3';
                        $orders->save();
                    }
                }
                $this->render('cancel');
            }
        }
    }

    public function actionException() {
        $sha_pas = Yii::app()->params['sha_password'];

        if ($_GET['STATUS']) {
            if ($_GET['ACCEPTANCE']) {
                $hash = "ACCEPTANCE=" . $_GET['ACCEPTANCE'] . $sha_pas;
                $hash .= "AMOUNT=" . $_GET['amount'] . $sha_pas;
            } else {
                $hash = "AMOUNT=" . $_GET['amount'] . $sha_pas;
            }

            if ($_GET['BRAND']) {
                $hash .= "BRAND=" . $_GET['BRAND'] . $sha_pas;
            }
            if ($_GET['CARDNO']) {
                $hash .= "CARDNO=" . $_GET['CARDNO'] . $sha_pas;
            }
            if ($_GET['CN']) {
                $hash .= "CN=" . $_GET['CN'] . $sha_pas;
            }
            $hash .= "CURRENCY=" . $_GET['currency'] . $sha_pas;
            if ($_GET['ED']) {
                $hash .= "ED=" . $_GET['ED'] . $sha_pas;
            }
            $hash .= "IP=" . $_GET['IP'] . $sha_pas;
            if ($_GET['NCERROR']) {
                $hash .= "NCERROR=" . $_GET['NCERROR'] . $sha_pas;
            }
            $hash .= "ORDERID=" . $_GET['orderID'] . $sha_pas;
            $hash .= "PAYID=" . $_GET['PAYID'] . $sha_pas;
            if ($_GET['PM']) {
                $hash .= "PM=" . $_GET['PM'] . $sha_pas;
            }
            $hash .= "STATUS=" . $_GET['STATUS'] . $sha_pas;
            $hash .= "TRXDATE=" . $_GET['TRXDATE'] . $sha_pas;

            $HashDigest = sha1($hash);

            if (strtolower($HashDigest) == strtolower($_GET['SHASIGN'])) {
                $orders = Orders::model()->findByPk($_GET['orderID']);
                if ($orders) {
                    if ($orders->status == '1') {
                        $orders->status = '3';
                        $orders->save();
                    }
                }
                $this->render('exception');
            }
        }
    }

    public function actionDecline() {
        $sha_pas = Yii::app()->params['sha_password'];

        if ($_GET['STATUS']) {
            if ($_GET['ACCEPTANCE']) {
                $hash = "ACCEPTANCE=" . $_GET['ACCEPTANCE'] . $sha_pas;
                $hash .= "AMOUNT=" . $_GET['amount'] . $sha_pas;
            } else {
                $hash = "AMOUNT=" . $_GET['amount'] . $sha_pas;
            }

            if ($_GET['BRAND']) {
                $hash .= "BRAND=" . $_GET['BRAND'] . $sha_pas;
            }
            if ($_GET['CARDNO']) {
                $hash .= "CARDNO=" . $_GET['CARDNO'] . $sha_pas;
            }
            if ($_GET['CN']) {
                $hash .= "CN=" . $_GET['CN'] . $sha_pas;
            }
            $hash .= "CURRENCY=" . $_GET['currency'] . $sha_pas;
            if ($_GET['ED']) {
                $hash .= "ED=" . $_GET['ED'] . $sha_pas;
            }
            $hash .= "IP=" . $_GET['IP'] . $sha_pas;
            if ($_GET['NCERROR']) {
                $hash .= "NCERROR=" . $_GET['NCERROR'] . $sha_pas;
            }
            $hash .= "ORDERID=" . $_GET['orderID'] . $sha_pas;
            $hash .= "PAYID=" . $_GET['PAYID'] . $sha_pas;
            if ($_GET['PM']) {
                $hash .= "PM=" . $_GET['PM'] . $sha_pas;
            }
            $hash .= "STATUS=" . $_GET['STATUS'] . $sha_pas;
            $hash .= "TRXDATE=" . $_GET['TRXDATE'] . $sha_pas;

            $HashDigest = sha1($hash);

            if (strtolower($HashDigest) == strtolower($_GET['SHASIGN'])) {
                $orders = Orders::model()->findByPk($_GET['orderID']);
                if ($orders) {
                    if ($orders->status == '1') {
                        $orders->status = '3';
                        $orders->save();
                    }
                }
                $this->render('decline');
            }
        }
    }

    // ===================================== Account Details ============================================= //

    public function actionMyAccount() {
        $page = Pages::model()->findByPk(8);
        $this->render('account_details', array('page' => $page));
    }

    public function actionProfile() {
        $model = new User('passreset');
        $newmail = new User('mailreset');
        $newname = new User('newname');

        $id = Yii::app()->user->id;
        $userData = User::model()->findByPk($id);

        $this->render('my_account', array('model' => $model,
            'userData' => $userData,
            'newname' => $newname,
            'newmail' => $newmail));
    }

    public function actionCredit() {
        if (!Yii::app()->user->isGuest) {
            $id = Yii::app()->user->id;
            $userData = User::model()->findByPk($id);
            $sha_pas = Yii::app()->params['sha_password'];

            if ($_GET['STATUS']) {
                $hash = "ACCEPTANCE=" . $_GET['ACCEPTANCE'] . $sha_pas;
                $hash .= "AMOUNT=" . $_GET['amount'] . $sha_pas;
                $hash .= "BRAND=" . $_GET['BRAND'] . $sha_pas;
                $hash .= "CARDNO=" . $_GET['CARDNO'] . $sha_pas;
                $hash .= "CN=" . $_GET['CN'] . $sha_pas;
                $hash .= "CURRENCY=" . $_GET['currency'] . $sha_pas;
                $hash .= "ED=" . $_GET['ED'] . $sha_pas;
                $hash .= "IP=" . $_GET['IP'] . $sha_pas;
                $hash .= "NCERROR=" . $_GET['NCERROR'] . $sha_pas;
                $hash .= "ORDERID=" . $_GET['orderID'] . $sha_pas;
                $hash .= "PAYID=" . $_GET['PAYID'] . $sha_pas;
                $hash .= "PM=" . $_GET['PM'] . $sha_pas;
                $hash .= "STATUS=" . $_GET['STATUS'] . $sha_pas;
                $hash .= "TRXDATE=" . $_GET['TRXDATE'] . $sha_pas;

                $HashDigest = sha1($hash);

                if (strtolower($HashDigest) == strtolower($_GET['SHASIGN'])) {
                    $plc = PaymentLog::model()->findByAttributes(array('user_id' => Yii::app()->user->id, 'order_hash' => strtolower($HashDigest)));
                    if (!$plc) {
                        if ($_GET['STATUS'] == '5' || $_GET['STATUS'] == '9') {
                            //update credit here
                            $userData->user_credit += ($_GET['amount']);
                            $userData->password = $userData->simple_decrypt($userData->password);
                            $userData->save(false);

                            $cr = new CreditLog;
                            $cr->user_id = Yii::app()->user->id;
                            $cr->t_date = date("m/d/Y", time());
                            $cr->amount = $_GET['amount'];
                            $cr->pay_id = $_GET['PAYID'];
                            $cr->status = 2;
                            $cr->save(false);
                        } else {

                        }

                        $pl = new PaymentLog;
                        $pl->user_id = Yii::app()->user->id;
                        $pl->order_hash = strtolower($HashDigest);
                        $pl->save(false);
                    }
                } else {
                    throw new CHttpException(404, "this page doesn't exist");
                }
            }
            //$this->redirect('https://mdepayments.epdq.co.uk/ncol/test/orderstandard.asp?PSPID=epdq1038724&ORDERID=6565&AMOUNT=200&CURRENCY=GBP&LANGUAGE=en_US');
            $this->render('credit', array('userData' => $userData));
        } else {
            $this->redirect(array('login'));
        }
    }

    public function actionChangePassword() {
        //$model= new User('passreset');
        $id = Yii::app()->user->id;
        $model = User::model()->findByPk($id);
        $model->scenario = 'passreset';

        if (isset($_POST['User'])) {
            $model->attributes = $_POST['User'];
            $model->pass_reset = 0;
            $model->pass_code = '';
            $model->password = $model->newpassword; //=$_POST['User']['newpassword'];
            if ($model->save(false)) {
                Yii::app()->user->setFlash('passwordchanging', 'Your password has been successfully updated.');
                $this->redirect('profile#pass');
            }
        }

        $this->redirect(Yii::app()->request->urlReferrer);
    }

    public function actionChangeMail() {

        $id = Yii::app()->user->id;
        $newmail = User::model()->findByPk($id);
        $newmail->scenario = 'mailreset';

        if (isset($_POST['User'])) {
            $newmail->attributes = $_POST['User'];
            $newmail->email = $newmail->newmail = $_POST['User']['newmail'];
            $newmail->newmail_repeat = $_POST['User']['newmail_repeat'];
            $newmail->password = $newmail->simple_decrypt($newmail->password);
            if ($newmail->save(false)) {
                Yii::app()->user->setFlash('mailupdated', 'Your email has been successfully updated');
                $this->redirect('profile#mail');
            }
        }

        $this->redirect(Yii::app()->request->urlReferrer);
    }

    public function actionChangeName() {
        $newname = new User('newname');
        $id = Yii::app()->user->id;
        $newname = User::model()->findByPk($id);
        if (isset($_POST['User'])) {
            $newname->attributes = $_POST['User'];
            if ($_POST['User']['new_firstname'] != '' && $_POST['User']['new_lastname'] == '') {
                $newname->fname = $newname->new_firstname = $_POST['User']['new_firstname'];
                $newname->lname = $newname->lname;
                $newname->password = $newname->simple_decrypt($newname->password);
                $newname->save(false);
            } elseif ($_POST['User']['new_firstname'] == '' && $_POST['User']['new_lastname'] != '') {
                $newname->lname = $newname->new_lastname = $_POST['User']['new_lastname'];
                $newname->fname = $newname->fname;
                $newname->password = $newname->simple_decrypt($newname->password);
                $newname->save(false);
            } elseif ($_POST['User']['new_firstname'] != '' && $_POST['User']['new_lastname'] != '') {
                $newname->fname = $newname->new_firstname = $_POST['User']['new_firstname'];
                $newname->lname = $newname->new_lastname = $_POST['User']['new_lastname'];
                $newname->password = $newname->simple_decrypt($newname->password);
                $newname->save(false);
            } else {
                $newname->lname = $newname->lname;
                $newname->password = $newname->simple_decrypt($newname->password);
                $newname->fname = $newname->fname;
                $newname->save(false);
            }

            Yii::app()->user->setFlash('fullnamechange', ' Your Name has been successfully updated.');
            $this->redirect('profile#name');
        }
        $this->redirect(Yii::app()->request->urlReferrer);
    }

    public function actionOrders() {
        $id = Yii::app()->user->id;


        $criteria = new CDbCriteria;
        $criteria->select = 't.*';
        $criteria->condition = 'id=' . $id;
        $userData = User::model()->find($criteria);

        $criteria1 = new CDbCriteria;
        $criteria1->select = 't.*';
        $criteria1->condition = 'user_id=' . $id;
        $criteria1->order = "id DESC";
        $orders = Orders::model()->findAll($criteria1);

        $this->render('orders', array('orders' => $orders));
    }

    public function actionOrderDetails($action = '') {
        if (!Yii::app()->user->isGuest) {
            $order_id = Yii::app()->user->getState('orderID');

            $discount = '';

            if ($action == 'discount') {

                //// post discount code
                $discount_code = $_POST['discount_code'];
                //echo $discount_code;
                ///search for it in DB
                $criteria = new CDbCriteria();
                $criteria->condition = 'code=:discount_code';
                $criteria->params = array(':discount_code' => $discount_code);
                $discount = Discount::model()->find($criteria);
                /// if not found
                if (empty($discount)) {
                    $action = 4; /// action =4 means Invalid Discount code
                    $discount = '';
                } else {
                    /// make sure its num available not reach total num
                    if ($discount->total_num <= $discount->used_num) {
                        $action = 5; /// action =5 means This Discount code is no longer available
                        $discount = '';
                    } else {
                        $action = 6;
                        Yii::app()->session['discount'] = $discount_code;
                        Yii::app()->session['discount_value'] = $discount->percentage;
                        //unset(Yii::app()->session['discount']);
                    }
                }
            }

            $model = new Orders('create');
            $cart = Yii::app()->shoppingCart->getPositions();

            $id = Yii::app()->user->id;
            $user = User::model()->findByPk($id);

            $criteria = new CDbCriteria;
            $criteria->select = 't.*';
            $criteria->condition = 'user_id=' . $id;
            $userDetailsData = UserDetails::model()->find($criteria);


            $id = Yii::app()->user->id;

            $criteria1 = new CDbCriteria;
            $criteria1->select = 't.*';
            $criteria1->condition = 'id=' . $order_id;
            $shippingAndBilling = Orders::model()->find($criteria1);

            $this->render('order_summary', array('cart' => $cart,
                'model' => $model,
                'user' => $user,
                'shippingAndBilling' => $shippingAndBilling,
                'discount' => $discount,
                'action' => $action,
                'userDetailsData' => $userDetailsData));
        } else {
            $this->redirect(array("login", "purchase" => "1"));
        }
    }

    public function actionCalculate() {
        if (isset($_REQUEST['op'])) {

            $dis = 0;
            if (Yii::app()->session['discount_value']) {
                $dis = number_format((Yii::app()->shoppingCart->getCost() * Yii::app()->session['discount_value']) / 100, 2);
            }

            $subtotal = (Yii::app()->shoppingCart->getCost() + $_REQUEST['op']) - $dis;
            Yii::app()->user->setState('total', $subtotal);
            Yii::app()->user->setState('postage', $_REQUEST['op']);
            echo '&pound;' . $subtotal;
        }
    }

    public function actionConfirmation() {
        $this->render('confirmation');
    }

    public function actionEmailPrefrences() {
        $id = Yii::app()->user->id;
        $user = User::model()->findByPk($id);

        if (isset($_POST['User'])) {
            $user->attributes = $_POST['User'];
            $user->password = $user->simple_decrypt($user->password);
            if ($user->save()) {
                Yii::app()->user->setFlash('emailref', 'Your request has been successfully updated');
            }
        }


        $this->render('emailPrefrences', array('user' => $user));
    }

    public function actionOrder($id) {

        $criteria = new CDbCriteria;
        $criteria->select = 't.*';
        $criteria->condition = 'orders_id=' . $id;
        $orderdetails = OrdersDetails::model()->findAll($criteria);

        $criteria1 = new CDbCriteria;
        $criteria1->select = 't.*';
        $criteria1->condition = 'id=' . $id;
        $orderdata = Orders::model()->find($criteria1);

        $this->render('order_details', array('orderdetails' => $orderdetails,
            'orderdata' => $orderdata));
    }

    public function actionFlagRemove() {
        $id = Yii::app()->user->id;
        /*
          $user = User::model()->findByPk($id);
          $user->cookie_flag=0;
          $user->password=$user->simple_decrypt($user->password);
          $user->save(false);
          echo "0"; */

        Yii::app()->user->setState('close', 1);
    }

    public function actionAddress() {

        $userData = UserDetails::model()->findByAttributes(array('user_id' => Yii::app()->user->id));
        $userData->scenario = 'editshipping';

        $this->performAjaxValidation($userData);

        if (isset($_POST['UserDetails'])) {
            $userData->attributes = $_POST['UserDetails'];
            if ($_POST['UserDetails']['set'] == 'shipping_address') {

                $userData->save(false);
                Yii::app()->user->setFlash('s_save', 'Your Shipping information has been saved successfully');
                $this->redirect(array('home/address', 's' => '1'));
            }

            if ($_POST['UserDetails']['set'] == 'billing_address') {
                $userData->save(false);
                Yii::app()->user->setFlash('b_save', 'Your Billing information has been saved successfully');
                $this->redirect(array('home/address', 'b' => '1'));
            }
        }

        $this->render('address', array('userData' => $userData));
    }

    public function actionShippingDetails() {
        if (!Yii::app()->user->isGuest) {
            $userData = UserDetails::model()->findByAttributes(array('user_id' => Yii::app()->user->id));
            $model = new Orders();

            $email_error = "";

            $this->performAjaxValidation($userData);


            if (isset($_POST['UserDetails'])) {

                $email_error = "Please enter valid email";
                if (isset($_POST['email'])) {
                    if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                        $email_error = "";
                    }
                }

                if (!$email_error) {
                    if ($_POST['billing'] == 0) {
                        $_POST['UserDetails']['b_title'] = $_POST['UserDetails']['s_title'];
                        $_POST['UserDetails']['b_fname'] = $_POST['UserDetails']['s_fname'];
                        $_POST['UserDetails']['b_lname'] = $_POST['UserDetails']['s_lname'];
                        $_POST['UserDetails']['b_country_id'] = $_POST['UserDetails']['s_country_id'];
                        $_POST['UserDetails']['b_city'] = $_POST['UserDetails']['s_city'];
                        $_POST['UserDetails']['b_address'] = $_POST['UserDetails']['s_address'];
                        $_POST['UserDetails']['b_address2'] = $_POST['UserDetails']['s_address2'];
                        $_POST['UserDetails']['b_phone_day'] = $_POST['UserDetails']['s_phone_day'];
                        $_POST['UserDetails']['b_phone_evening'] = $_POST['UserDetails']['s_phone_evening'];
                        $_POST['UserDetails']['b_zipcode'] = $_POST['UserDetails']['s_zipcode'];
                    }
                    $userData->attributes = $_POST['UserDetails'];
                    if ($userData->save()) {
                        $model->attributes = $_POST['UserDetails'];
                        $model->email = $_POST['email'];
                        if ($model->save())
                            Yii::app()->user->setState('orderID', $model->id);
                        $this->redirect(array('home/orderdetails'));
                    }
                }
            }
            $this->render('shipping_details', array('userData' => $userData, "email_error" => $email_error));
        }else {
            $this->redirect(array("login", "purchase" => "1"));
        }
    }

    public function actionFiltering() {
        //$values=explode(',', $_REQUEST['checkedValue'] );
        $checkedValue = $_REQUEST['checkedValue'];
        $cat_id = $_REQUEST['cat_id'];
        //var_dump($checkedValue);
        $site_arr = explode(',', $checkedValue);

        for ($i = 0; $i < count($site_arr); $i++) {
            if (!empty($site_arr[$i]))
                $arr[] = $site_arr[$i];
        }

        $criteria = new CDbCriteria;
        //$criteria->select = 'distinct(`product_id`)';
        //$criteria->condition='1=1';
        if (!empty($arr)) {

            $criteria->addCondition('`size` in (' . implode(',', $arr) . ')');
        }

        $sizes = ProductsSizes::model()->findAll($criteria);
        $k = 0;
        foreach ($sizes as $size) {
            $pro_arr[$k] = $size->product_id;
            $k++;
        }
        $criteria2 = new CDbCriteria;
        $criteria2->condition = 'id in (' . implode(',', $pro_arr) . ')';
        $criteria2->addcondition('cat_id like "%' . $cat_id . '%"');
        $criteria2->order = "bg_order";
        $products = Products::model()->findAll($criteria2);
        $list = '<ul class="thumbnails left20 topMargin20"  id="test">';
        foreach ($products as $product_details) {

            $list .= '<li class="span3 xnew">
                                <div class="thumbnail txtcenter">
                                    <a href="' . Yii::app()->request->baseUrl . '/home/productDetails/' . $product_details->slug . '"><img src="' . Yii::app()->request->baseUrl . '/media/products/' . $product_details->image . '" alt=""></a>
                                    <div class="clear"></div>
                                    <a class="title-link" href="' . Yii::app()->request->baseUrl . '/home/productDetails/' . $product_details->slug . '">' . $product_details->title . '</a>
                                    <br/>
                                    <span class="site">&pound;' . $product_details->price . '</span>
                                    <br/>
                                </div>
                            </li>';
        }
        $list.='</ul>';
        echo $list;
    }

    public function actionRegisteration_complete() {
        if (Yii::app()->user->hasFlash('register-success')) {
            $this->render('registeration_complete');
        } else {
            $this->redirect(array('index'));
        }
    }

    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'shipping-form' || $_POST['ajax'] === 'shipping_form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionGet_hash() {
        if (!Yii::app()->user->isGuest) {
            $sha_pas = Yii::app()->params['sha_password'];
            if ($_POST['amount'] && $_POST['currency'] && $_POST['language'] && $_POST['order_id']) {
                $hash = "ACCEPTURL=" . Yii::app()->request->getBaseUrl(true) . '/home/credit' . $sha_pas;
                $hash .= "AMOUNT=" . $_POST['amount'] . $sha_pas;
                $hash .= "CANCELURL=" . Yii::app()->request->getBaseUrl(true) . '/home/cancel' . $sha_pas;
                $hash .= "CURRENCY=" . $_POST['currency'] . $sha_pas;
                $hash .= "DECLINEURL=" . Yii::app()->request->getBaseUrl(true) . '/home/decline' . $sha_pas;
                $hash .= "EXCEPTIONURL=" . Yii::app()->request->getBaseUrl(true) . '/home/exception' . $sha_pas;
                $hash .= "LANGUAGE=" . $_POST['language'] . $sha_pas;
                $hash .= "ORDERID=" . $_POST['order_id'] . $sha_pas;
                $hash .= "PSPID=" . Yii::app()->params['pspid'] . $sha_pas;
                $hash .= "TITLE=BrightBaby" . $sha_pas;

                $HashDigest = strtoupper(sha1($hash));

                echo $HashDigest;
            }
        }
    }

    public function actionTestp() {
        $this->render("testp");
    }

    public function actionTm() {
        $order = Orders::model()->findByPk(199);
        $mail = new YiiMailer();
        $mail->setLayout('test_mail');
        $mail->setFrom(Yii::app()->params['adminEmail'], 'BrightBaby');
        $mail->setTo('m.mohamed@egprosolutions.com');
        $mail->setSubject('New customer profile notification3');

        $message = 'm.mohamed@egprosolutions.com';

        $mail->setBody($order);


        if ($mail->send()) {

        }
    }

    public function actionUnsubscribe() {
        if (!Yii::app()->user->isGuest) {
            $ns = User::model()->findByPk(Yii::app()->user->id);
            if ($ns) {
                $ns->subscribe = 0;
                $ns->password = $ns->simple_decrypt($ns->password);
                $ns->save(false);
                $this->render("unsub");
            } else {
                $this->redirect(array('index'));
            }
        } else {
            $this->redirect(array("login", "unsubscribe" => 1));
        }
    }

    public function actionCt() {
        $this->render("decline");
    }

}