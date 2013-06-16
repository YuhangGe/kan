<?php
/**
 * User: xiaoge
 * At: 13-6-3 3:36
 * Email: abraham1@163.com
 */


class VideoController extends Controller{
    public function actionLocationList() {
        $m = new VideoList();
        $m->attributes = $_POST;
        $m->type = "location";
        if($m->validate()) {
            $list = $m->get();
            $this->sendAjax($list, true);
        } else {
            $this->sendAjax(null);
        }

    }
    public function actionTimeList() {
        $m = new VideoList();
        $m->attributes = $_POST;
        $m->type = "time";
        if($m->validate()) {
            $list = $m->get();
            $this->sendAjax($list, true);
        } else {
            $this->sendAjax(null);
        }
    }

    public function actionViewList() {
        $m = new VideoList();
        $m->attributes = $_POST;
        $m->type = "view";
        if($m->validate()) {
            $list = $m->get();
            $this->sendAjax($list, true);
        } else {
            $this->sendAjax(null);
        }
    }

    public function actionRandList() {
        $m = new VideoList();
        $m->attributes = $_POST;
        $m->type="rand";
        if($m->validate()) {
            $list = $m->get();
            $this->sendAjax($list, true);
        } else {
            $this->sendAjax(null);
        }
    }

    public function actionUserList() {
        $m = new VideoList();
        $m->attributes = $_POST;
        $m->type="user";
        if($m->validate()) {
            $list = $m->get();
            $this->sendAjax($list, true);
        } else {
            $this->sendAjax(null);
        }
    }

    public function actionActiveList() {
        $m = new VideoList();
        $m->attributes = $_POST;
        $m->type = "active";
        if($m->validate()) {
            $list = $m->get();
            $this->sendAjax($list, true);
        } else {
            $this->sendAjax(null);
        }
    }
}