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
    public function actionQuickUser() {
        $u = new UpdateUserForm();
        $u -> attributes = $_POST;
        if($u->updateQuick()) {
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
        if(!isset($_FILES['image_file']) || !isset($_FILES['small_file'])) {
            $this->sendAjax(null);
        }
        $uid = Yii::app()->user->id;
        $dir = "avatar";
        $_tag = time().rand(0, 1000000);
        $i_fn = "large_".$uid."_".$_tag;
        $s_fn = "small_".$uid."_".$_tag;

        $iif = FileHelper::savePhoto("image_file", $dir, $i_fn);
        if($iif==false) {
            $this->sendAjax(null);
        }

        $sif = FileHelper::savePhoto("small_file", $dir, $s_fn);
        if($sif==false) {
            unlink(Yii::app()->params['uploadDir']."/".$iif);
            $this->sendAjax(null);
        }

        $s_path = Yii::app()->params['staticServer'];

        $u = new UpdateUserForm();
        $u -> big_avatar = $s_path.'/'.$iif;
        $u -> small_avatar = $s_path.'/'.$sif;

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