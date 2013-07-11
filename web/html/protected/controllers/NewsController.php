<?php
/**
 * User: xiaoge
 * At: 13-7-11 4:38
 * Email: abraham1@163.com
 */


class NewsController extends Controller {
    public function accessRules()
    {
        return array(
            array(
                'deny',
                'users'=>array('?'),
            )
        );
    }
    public function actionAllList() {
        $m = new NewsForm();
        $m->attributes = $_POST;
        if($m->validate()) {
            $this->sendAjax($m->all_list(), true);
        } else {
            $this->sendAjax(null);
        }
    }
}