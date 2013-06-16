<?php
/**
 * User: xiaoge
 * At: 13-6-14 10:55
 * Email: abraham1@163.com
 */


class StarController extends AController{
    public function actionIndex() {
        $this->render("index");
    }

    public function actionChoose() {
        $m = new StarForm();
        $m->attributes = $_POST;
        if($m->validate() && $m->choose()) {
            $this->sendAjax(true, true);
        } else {
            $this->sendAjax(null);
        }
    }

    public function actionCancel() {
        $m = new StarForm();
        $m->attributes = $_POST;
        if($m->validate() && $m->cancel()) {
            $this->sendAjax(true, true);
        } else {
            $this->sendAjax(null);
        }
    }

    public function actionPoster() {
        $m = new StarForm();
        $m->attributes = $_POST;
        if($m->validate() && $m->poster()) {
            $this->sendAjax(true, true);
        } else {
            $this->sendAjax(null);
        }
    }
}