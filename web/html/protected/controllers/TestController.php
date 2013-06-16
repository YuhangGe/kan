<?php
/**
 * User: xiaoge
 * At: 13-5-24 11:21
 * Email: abraham1@163.com
 */


class TestController extends Controller {
    public $t_aa;

    function actionIndex() {
     
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