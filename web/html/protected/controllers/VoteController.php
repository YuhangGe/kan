<?php
/**
 * User: xiaoge
 * At: 13-6-7 10:40
 * Email: abraham1@163.com
 */


class VoteController extends Controller{
    public function accessRules()
    {
        return array(
            array(
                'deny',
                'users'=>array('?'),
            )
        );
    }
    public function actionPhoto() {
        $m = new VoteForm();
        $m->attributes = $_POST;
        $m->type = "photo";
        if($m->validate() && $m->vote()) {
            $this->sendAjax(true, true);
        } else {
            $this->sendAjax(null);
        }
    }
    public function actionVideo() {
        $m = new VoteForm();
        $m->attributes = $_POST;
        $m->type = "video";
        if($m->validate() && $m->vote()) {
            $this->sendAjax(true, true);
        } else {
            $this->sendAjax(null);
        }
    }
}