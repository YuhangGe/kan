<?php
/**
 * User: xiaoge
 * At: 13-5-24 11:21
 * Email: abraham1@163.com
 */


class TestController extends Controller {
    public $t_aa;

    function actionIndex() {
        $r = Yii::app()->db->createCommand("select * from user where nick_name like :nn")->queryAll(true, array(':nn'=>'%白羊座%'));
        echo CJSON::encode($r);
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