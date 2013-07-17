<?php
/**
 * User: xiaoge
 * At: 13-7-17 5:53
 * Email: abraham1@163.com
 */


class NotifyController extends AController{

    public function actionPost() {
        $m = new Notify();
        $m->content = $_POST['content'];
        $m->to_user_id = $_POST['to_user_id'];
        $m->type = 0;
        $m->time = time();

        if($m->validate() && $m->save(false)) {
            $this->sendAjax(true, true);
        } else {
            $this->sendAjax(null);
        }


    }

    public function actionModify() {
        if(!isset($_POST['notify_id'])) {
            $this->sendAjax(null);
        }
        $r = Notify::model()->findByPk($_POST['notify_id']);
        if($r===null) {
            $this->sendAjax(null);
        }
        $r->content = $_POST['content'];
        if($r->validate() && $r->save(false)) {
            $this->sendAjax(true, true);
        } else {
            $this->sendAjax(null);
        }
    }
    public function actionDelete() {
        if(!isset($_POST['password']) || !isset($_POST['notify_id'])) {
            $this->sendAjax(null);
        }
        if(PwdHelper::encode($_POST['password'])!==Yii::app()->params['adminPassword']) {
            $this->sendAjax(null);
        }
        $aid = intval($_POST['notify_id']);
        if(empty($aid)) {
            $this->sendAjax(null);
        }


        if(Notify::model()->deleteAllByAttributes(array("notify_id"=>$aid))){
            $this->sendAjax(true, true);
        } else {
            $this->sendAjax(null);
        }

    }

    public function actionSearch() {
        if(empty($_POST['search_value'])) {
            $this->sendAjax(null);
        }
        $sql = "select u.nick_name, u.user_id from notify n, user u where u.user_id = n.to_user_id and n.content like :cnt";

        $rs = Yii::app()->db->createCommand($sql)->queryAll(true, array(':cnt'=>'%'.strtr($_POST['search_value'],array('%'=>'\%', '_'=>'\_', '\\'=>'\\\\')).'%'));

        $this->sendAjax($rs, true);
    }
}