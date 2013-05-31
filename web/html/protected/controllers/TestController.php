<?php
/**
 * User: xiaoge
 * At: 13-5-24 11:21
 * Email: abraham1@163.com
 */


class TestController extends Controller {
    public $t_aa;

    function actionIndex() {
        echo PwdHelper::encode("123456");
    }
    function actionDo() {
        $this->render("do");
    }
    function actionInfo() {
        phpinfo();
    }
}