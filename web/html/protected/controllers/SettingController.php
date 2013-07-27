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
        $key_list = $_POST['key'];
        if(is_array($key_list)) {
            foreach ($key_list as $key=>$k) {
                $key_list[$key] = "'$k'";
            }
            $key_v = join(",", $key_list);
        } else {
            $key_v = "'$key_list'";
        }
        $sql = "select * from setting where `key` in($key_v)";
        $this->sendAjax(Yii::app()->db->createCommand($sql)->queryAll(), true);
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