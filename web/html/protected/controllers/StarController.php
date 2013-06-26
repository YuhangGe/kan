<?php
/**
 * User: xiaoge
 * At: 13-6-25 1:51
 * Email: abraham1@163.com
 */


class StarController extends Controller{
    public function accessRules()
    {
        return array(
            array(
                'deny',
                'users'=>array('?'),
            )
        );
    }
    public function actionTimeList() {
        $m = new StarList();
        $m->attributes = $_POST;
        $m->type="time";
        if($m->validate()) {
            $this->sendAjax($m->get(), true);
        } else {
            $this->sendAjax(null);
        }
    }
    public function actionActList() {
        $m = new StarList();
        $m->attributes = $_POST;
        $m->type="act";
        if($m->validate()) {
            $this->sendAjax($m->get(), true);
        } else {
            $this->sendAjax(null);
        }
    }
}