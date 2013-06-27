<?php
/**
 * User: xiaoge
 * At: 13-6-10 3:08
 * Email: abraham1@163.com
 */


class ChatController extends Controller{
    public function accessRules()
    {
        return array(
            array(
                'deny',
                'users'=>array('?'),
            )
        );
    }
    public function actionUnreadList() {
        $m = new ChatForm();
        $m->attributes = $_POST;
        $m->to_user_id = Yii::app()->user->id;
        if($m->validate()) {
            $this->sendAjax($m->unread_list(), true);
        } else {
            $this->sendAjax(null);
        }
    }

    public function actionAllList() {
        $m = new ChatForm();
        $m->attributes = $_POST;
        $m->to_user_id = Yii::app()->user->id;
        if($m->validate()) {
            $this->sendAjax($m->all_list(), true);
        } else {
            $this->sendAjax(null);
        }
    }

    public function actionDialog() {
        $m = new ChatForm();
        $m->attributes = $_POST;
        $m->to_user_id = Yii::app()->user->id;
        if($m->validate()) {
            $this->sendAjax($m->dialog(), true);
        } else {
            $this->sendAjax(null);
        }
    }

    public function actionUnreadCount() {
        $m = new ChatForm();
        $m->to_user_id = Yii::app()->user->id;
        return $this->sendAjax(array("count" => (int)$m->unread_count()), true);
    }

    public function actionSetRead() {
        $m = new ChatForm();
        $m->attributes = $_POST;
        $m->to_user_id = Yii::app()->user->id;
        if($m->validate() && $m->set_read()) {
            $this->sendAjax(true, true);
        } else {
            $this->sendAjax(null);
        }
    }

    public function actionPost() {
        $m = new Chat();
        $m->attributes = $_POST;
        $m->time = time();
        $m->from_user_id = Yii::app()->user->id;
        if($m->validate() && $m->save(false)) {
            $this->sendAjax(true, true);
        } else {
            $this->sendAjax(null);
        }
    }
}