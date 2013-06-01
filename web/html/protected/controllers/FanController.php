<?php
/**
 * User: xiaoge
 * At: 13-5-27 2:54
 * Email: abraham1@163.com
 */


class FanController extends Controller {
    public function accessRules()
    {
        return array(
            array(
                'deny',
                'users'=>array('?'),
            )
        );
    }

    public function actionFriend() {
        if(!isset($_POST['friend_id'])) {
            return;
        }
        $uff = new UserFriendForm();
        $uff->user_id = intval($_POST['friend_id']);
        if(!$uff->validate() || !$uff->friend()) {
            $this->sendAjax(null);
        } else {
            $this->sendAjax(true);
        }
    }

    public function actionUnfriend() {
        if(!isset($_POST['friend_id'])) {
            return;
        }
        $uff = new UserFriendForm();
        $uff->user_id = intval($_POST['friend_id']);
        if(!$uff->validate() || !$uff->friend("unfriend")) {
            $this->sendAjax(null);
        } else {
            $this->sendAjax(true);
        }
    }

    public function actionUnfollow() {
        if(!isset($_POST['follow_id'])) {
            return;
        }
        $uf = new UserFanForm();
        $uf->user_id = $_POST['follow_id'];
        $uf->fan_id  = Yii::app()->user->id;
        $uf->fan_name = Yii::app()->user->name;

        if(!$uf->validate() || !$uf->unfollow()) {
            $this->sendAjax(null);
        } else {
            $this->sendAjax(true);
        }

    }
    public function actionFollow() {
        if(!isset($_POST['follow_id'])) {
            return;
        }
        $uf = new UserFanForm();
        $uf->user_id = $_POST['follow_id'];
        $uf->fan_id  = Yii::app()->user->id;
        $uf->fan_name = Yii::app()->user->name;

        if(!$uf->validate() || !$uf->follow()) {
            $this->sendAjax(null);
        } else {
            $this->sendAjax(true);
        }

    }
}