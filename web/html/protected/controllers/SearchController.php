<?php
/**
 * User: xiaoge
 * At: 13-6-1 4:52
 * Email: abraham1@163.com
 */


class SearchController extends Controller{
    public function accessRules() {
        return array(
            array(
                'deny',
                'users'=>array('?'),
            )
        );
    }

    public function actionUser() {
        $m = new SearchUserForm();
        $m->attributes = $_POST;
        if(!$m->validate()) {
            $this->sendAjax(null);
        }
        $rs = $m->search();
        if($rs!==null) {
            $this->sendAjax($rs, true);
        } else {
            $this->sendAjax(null);
        }
    }

    public function actionPhoto() {
        $m = new SearchPhotoForm();
        $m->attributes = $_POST;
        if(!$m->validate()) {
            $this->sendAjax(null);
        }
        $rs = $m->search();
        if($rs!==null) {
            $this->sendAjax($rs, true);
        } else {
            $this->sendAjax(null);
        }
    }
    public function actionActive() {
        $m = new SearchActiveForm();
        $m->attributes = $_POST;
        if(!$m->validate()) {
            $this->sendAjax(null);
        }
        $rs = $m->search();
        if($rs!==null) {
            $this->sendAjax($rs, true);
        } else {
            $this->sendAjax(null);
        }
    }
    public function actionVideo() {
        $m = new SearchVideoForm();
        $m->attributes = $_POST;
        if(!$m->validate()) {
            $this->sendAjax(null);
        }
        $rs = $m->search();
        if($rs!==null) {
            $this->sendAjax($rs, true);
        } else {
            $this->sendAjax(null);
        }
    }
}