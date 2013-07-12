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
        $m = new SearchForm();
        $m->attributes = $_POST;
        $m->type="user";

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
        $m = new SearchForm();
        $m->attributes = $_POST;
        $m->type = "active";
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
        $m = new SearchForm();
        $m->attributes = $_POST;
        $m->type = "video";
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