<?php

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class FrontController extends CController {

    /**
     * @var string the default layout for the controller view. Defaults to '//layouts/column1',
     * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
     */
    public $layout = '//layouts/main';

    /**
     * @var array context menu items. This property will be assigned to {@link CMenu::items}.
     */
    public $menu = array();

    /**
     * @var array the breadcrumbs of the current page. The value of this property will
     * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
     * for more details on how to specify this property.
     */
    public $breadcrumbs = array();

    public function init() {
        $parameters = Settings::model()->findByPk(1);


        Yii::app()->params['google'] = $parameters['google'];
        Yii::app()->params['twitter'] = $parameters['twitter'];
        Yii::app()->params['pinterest'] = $parameters['pinterest'];
        Yii::app()->params['support_email'] = $parameters['support_email'];
        Yii::app()->params['email'] = $parameters['email'];
        Yii::app()->params['adminEmail'] = $parameters['email'];
        Yii::app()->params['facebook'] = $parameters['facebook'];
        Yii::app()->params['paypal_email'] = $parameters['paypal_email'];
        Yii::app()->params['tumblr'] = $parameters['tumblr'];
        Yii::app()->params['customers_phone'] = $parameters['customers_phone'];
        Yii::app()->params['vat'] = $parameters['vat'];
        Yii::app()->params['address'] = $parameters['address'];
        Yii::app()->params['company_registration'] = $parameters['company_registration'];
        Yii::app()->params['postage_costs'] = $parameters['postage_costs'];
        Yii::app()->params['babygirlImage'] = $parameters['baby_girl_image'];
        Yii::app()->params['babyboyImage'] = $parameters['baby_boy_image'];
        Yii::app()->params['pspid'] = $parameters['pspid'];
        Yii::app()->params['sha_password'] = $parameters['sha_password'];
        Yii::app()->params['facebook_description'] = $parameters['facebook_description'];
    }

    public function actions() {
        return array(
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            'page' => array(
                'class' => 'CViewAction',
            ),
            'yiichat' => array('class' => 'YiiChatAction'), // <- ADD THIS LINE
        );
    }

}