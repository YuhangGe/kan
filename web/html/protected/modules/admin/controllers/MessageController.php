<?php
/**
 * User: xiaoge
 * At: 13-7-17 4:55
 * Email: abraham1@163.com
 */


class MessageController extends AController{
    public function actionNews() {
        $this->render("news");
    }
    public function actionNotify() {
        $this->render("notify");
    }
}