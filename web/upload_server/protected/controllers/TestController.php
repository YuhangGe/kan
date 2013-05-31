<?php
/**
 * User: xiaoge
 * At: 13-5-24 11:21
 * Email: abraham1@163.com
 */


class TestController extends Controller {
    function actionIndex() {
        echo CJSON::encode(Yii::app()->user);
    }

    function actionInfo() {
        phpinfo();

    }
}