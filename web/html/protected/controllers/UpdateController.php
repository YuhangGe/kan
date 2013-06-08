<?php
/**
 * User: xiaoge
 * At: 13-6-1 4:38
 * Email: abraham1@163.com
 */


class UpdateController extends Controller{
    public function accessRules() {
        return array(
            array(
                'deny',
                'users'=>array('?'),
            )
        );
    }

    public function actionUser() {
        $u = new UpdateUserForm();
        $u -> attributes = $_POST;
        if($u->update()) {
            $this->sendAjax(true);
        } else {
            $this->sendAjax(null);
        }
    }

    public function actionPassword() {
        $u = new UpdateUserForm();
        $u -> attributes = $_POST;
        if($u->updatePassword()) {
            $this->sendAjax(true);
        } else {
            $this->sendAjax(null);
        }
    }

    public function actionAvatar() {
        $u = new UpdateUserForm();
        $u -> attributes = $_POST;
        if($u->updateAvatar()) {
            $this->sendAjax(true);
        } else {
            $this->sendAjax(false);
        }
    }
    public function actionLocation() {
        $m = new LocationForm();
        $m->attributes = $_POST;
        $m->user_id = Yii::app()->user->id;
        if($m->update()) {
            $this->sendAjax(true, true);
        } else {
            $this->sendAjax(null);
        }
    }
}