<?php
/**
 * User: xiaoge
 * At: 13-6-27 2:49
 * Email: abraham1@163.com
 */


class NotifyController extends Controller{
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
        $m = new NotifyForm();
        $m->attributes = $_POST;
        $m->user_id = Yii::app()->user->id;
        if($m->validate()) {
            $this->sendAjax($m->unread_list(), true);
        } else {
            $this->sendAjax(null);
        }
    }

    public function actionAllList() {
        $m = new NotifyForm();
        $m->attributes = $_POST;
        $m->user_id = Yii::app()->user->id;
        if($m->validate()) {
            $this->sendAjax($m->all_list(), true);
        } else {
            $this->sendAjax(null);
        }
    }

    public function actionUnreadCount() {
        $m = new NotifyForm();
        $m->user_id = Yii::app()->user->id;
        return $this->sendAjax(array("count" => intval($m->unread_count())), true);
    }

    public function actionSetRead() {
        $m = new NotifyForm();
        $m->user_id = Yii::app()->user->id;
        if($m->validate() && $m->set_read()) {
            $this->sendAjax(true, true);
        } else {
            $this->sendAjax(null);
        }
    }
}