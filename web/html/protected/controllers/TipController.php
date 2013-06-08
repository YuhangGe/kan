<?php
/**
 * User: xiaoge
 * At: 13-6-1 4:33
 * Email: abraham1@163.com
 */

/*
 * 对外公开的Tip控制器，比如检查email是否被占用，phone, nickname
 *
 */
class TipController extends Controller {
    private function check($type, $val) {
        $record = User::model()->findIdByAttributes(array($type=>$val));

        if($record==null) {
            return false;
        } else {
            return true;
        }
    }

    public function actionCemail() {
        if(!isset($_POST['email'])) {
            $this->sendAjax(null);
        } else {
            $this->sendAjax($this->check("email", $_POST['email']), true);
        }
    }
    public function actionCnickname() {
        if(!isset($_POST['nick_name'])) {
            $this->sendAjax(null);
        } else {
            $this->sendAjax($this->check("nick_name", $_POST['nick_name']), true);
        }
    }
    public function actionCphone() {
        if(!isset($_POST['phone'])) {
            $this->sendAjax(null);
        } else {
            $this->sendAjax($this->check("phone", $_POST['phone']), true);
        }
    }
}