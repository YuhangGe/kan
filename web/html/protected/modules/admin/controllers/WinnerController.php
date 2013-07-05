<?php
/**
 * User: xiaoge
 * At: 13-7-5 11:22
 * Email: abraham1@163.com
 */


class WinnerController extends AController{
    public function actionIndex() {
        $this->render("index");
    }
    public function actionChoose() {
        $m = new WinnerForm();
        $m->attributes = $_POST;
        if($m->validate() && $m->choose()) {
            $this->sendAjax(true, true);
        } else {
            $this->sendAjax(null);
        }
    }

    public function actionCancel() {
        $m = new WinnerForm();
        $m->attributes = $_POST;
        if($m->validate() && $m->cancel()) {
            $this->sendAjax(true, true);
        } else {
            $this->sendAjax(null);
        }
    }

    public function actionPoster() {
        $m = new WinnerForm();
        $m->attributes = $_POST;
        if($m->validate() && $m->poster()) {
            $this->sendAjax(true, true);
        } else {
            $this->sendAjax(null);
        }
    }

}