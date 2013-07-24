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
        $r = Setting::model()->findByAttributes(array("key"=>$_POST['key']));
        if($r === null || empty($r->value)) {
            $this->sendAjax(array('key'=>$_POST['key'], 'value'=>null));
        } else {
            $this->sendAjax(array('key'=>$_POST['key'], 'value'=>$r->value));

        }
    }

    public function actionBackground() {
        $rs = Setting::model()->findAllBySql("select * from setting where `key` in('background_720','background_768')");
        $bg_720 = null;
        $bg_768 = null;
        foreach ($rs as $r) {
            if($r->key==='background_720') {
                $bg_720 = $r->value;
            } elseif($r->key==='background_768') {
                $bg_768 = $r->value;
            }
        }

        $this->sendAjax(array(
            'background_720' => $bg_720,
            'background_768'=> $bg_768
        ), true);
    }

}