<?php
/**
 * User: xiaoge
 * At: 13-7-3 11:08
 * Email: abraham1@163.com
 */


class SettingController extends AController{
    private function saveEach($key, $value) {
        $m = Setting::model()->findByPk($key);
        if($m === null) {
            $m = new Setting();
            $m->key = $key;
        }
        $m->value = $value;
        return $m->save();
    }
    public function actionSave() {
        if(empty($_POST['setting'])) {
            $this->sendAjax(null);
        }
        $data = $_POST['setting'];
        foreach ($data as $key=>$value) {
            if($this->saveEach($key, $value)===false) {
                $this->sendAjax(null);
            }
        }

        $this->sendAjax(true, true);

    }

    public function actionIndex() {
        $setting = Setting::model()->findAll();
        $data = array();
        foreach ($setting as $s) {
            $data[$s->key] = $s->value;
        }

        $this->render("index", array('setting'=>$data));
    }

    public function actionNews() {
        $this->render("news");
    }
}