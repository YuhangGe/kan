<?php
/**
 * User: xiaoge
 * At: 13-7-3 11:03
 * Email: abraham1@163.com
 */


class SettingController extends Controller{
    public function actionGet() {
        if(empty($_POST['key'])) {
            $this->sendAjax(null);
        }
        $r = Setting::model()->find("key=:k", array(":k"=>$_POST['key']));
        if($r === null) {
            $this->sendAjax(array('key'=>$_POST['key'], 'value'=>null));
        } else {
            $this->sendAjax(array('key'=>$_POST['key'], 'value'=>$r->value));

        }
    }


}