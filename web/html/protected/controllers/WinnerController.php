<?php
/**
 * User: xiaoge
 * At: 13-7-5 1:32
 * Email: abraham1@163.com
 */


class WinnerController extends Controller{
    public function accessRules()
    {
        return array(
            array(
                'deny',
                'users'=>array('?'),
            )
        );
    }

    public function actionUserList() {
        $m = new WinnerList();
        $m->attributes = $_POST;
        $m->type="user";
        if($m->validate()) {
            $this->sendAjax($m->get(), true);
        } else {
            $this->sendAjax(null);
        }
    }
    public function actionVideoList() {
        $m = new WinnerList();
        $m->attributes = $_POST;
        $m->type="video";
        if($m->validate()) {
            $this->sendAjax($m->get(), true);
        } else {
            $this->sendAjax(null);
        }
    }
}