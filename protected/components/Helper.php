<?php

/**
 *
 *
 * @version $Id$
 * @copyright 2013
 */
class Helper {

    public static function PlayVideo($model) {
        $player = Yii::app()->controller->widget('ext.Yiitube', array('v' => $model->video, 'size' => 'small'));


        return '<div class="VideoPlay">' . $player->play() . '</div>';
    }

    public static function yiiparam($name, $default = null) {
        if (isset(Yii::app()->params[$name]))
            return Yii::app()->params[$name];
        else
            return $default;
    }

    public static function DrawPageLink($page_id) {
        $page = Pages::model()->findByPk($page_id);
        if ($page === null) {
            return 'Not-Found';
        }

        return 'home/page/view/' . $page->url;
    }

    public static function GenerateRandomKey($length = 10) {
        $chars = array_merge(range(0, 9), range('a', 'z'), range('A', 'Z'));
        shuffle($chars);
        $password = implode(array_slice($chars, 0, $length));
        return $password;
    }

    public static function displayColor($color) {
        return '<label style="width:30px;">' . $color . '</label><label style="display:inline-flex;width:20px;padding:15px;background:' . $color . '"> </label>';
    }

    public static function orderStatus($status) {
        if ($status == 1) {
            return 'Pending';
        } elseif ($status == 2) {
            return 'Completed';
        } else {
            return 'Cancelled';
        }
    }

    public static function getGalleryImages($gallery_id) {
        $criteria = new CDbCriteria();
        $criteria->condition = 'gallery_id=:UID';
        $criteria->params = array(':UID' => $gallery_id);
        $criteria->order = 'rank';
        $gallery = GalleryPhoto::model()->findAll($criteria);
        return $gallery;
    }

    public static function CalculateOrderTotal($val1, $val2) {
        $result = $val1 * ($val2 / 100);
        $result+=$val1;
        return round($result);
    }

    public static function getLastItem() {

        $cart = Yii::app()->shoppingCart->getPositions();
        $temp = array_reverse($cart);
        $last = $temp[0];
        return $last;
    }

    public static function getLastItemAjax($pro_id) {
        $product = Products::model()->findByPk($pro_id);
        return $product;
    }

    public static function GetUserData() {
        $id = Yii::app()->user->id;
        $userData = User::model()->findByPk($id);
        return $userData;
    }

    public static function cartItems() {
        $cart = Yii::app()->shoppingCart->getPositions();

        if ($cart != '') {
            $name = 'cartItems'; // cookie name
            $value = serialize($cart); // cookie value  
            $ItemsOfCart = new CHttpCookie($name, $value);
            $ItemsOfCart->expire = time() + (60 * 60 * 24);
            Yii::app()->request->cookies[$name] = $ItemsOfCart;
            return Yii::app()->request->cookies[$name];
        }
    }

}

?>