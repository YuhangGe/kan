<?php
/**
 * User: xiaoge
 * At: 13-5-24 11:21
 * Email: abraham1@163.com
 */


class TestController extends Controller {
    public $t_aa;

    function actionIndex() {
        $c = Photo::model()->count();
        echo $c;
        $p = ceil($c / 25);
        echo $p;
    }

    function actionDo() {
//        echo CJSON::encode($_GET);
        $this->render("do");
    }
    function actionInfo() {
        phpinfo();
    }
    function actionAvatar() {
        $this->render("avatar");
    }
}