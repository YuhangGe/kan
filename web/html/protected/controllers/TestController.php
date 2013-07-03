<?php
/**
 * User: xiaoge
 * At: 13-5-24 11:21
 * Email: abraham1@163.com
 */


class TestController extends Controller {
    public $t_aa;

    function actionIndex() {
        $sql = "CREATE TABLE `setting` (
  `key` varchar(30) NOT NULL,
  `value` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
        Yii::app()->db->createCommand($sql)->query();

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