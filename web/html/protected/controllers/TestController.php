<?php
/**
 * User: xiaoge
 * At: 13-5-24 11:21
 * Email: abraham1@163.com
 */


class TestController extends Controller {
    public $t_aa;

    function actionIndex() {
        $sql = "select * from user where user_id=1";
        $r = Yii::app()->db->createCommand($sql)->queryAll();
        print_r($r);
    }

    function actionDo() {
//        echo CJSON::encode($_GET);
        $this->render("do");
    }
    function actionGoodInfo() {
        phpinfo();
    }
    function actionAvatar() {
        $this->render("avatar");
    }
}