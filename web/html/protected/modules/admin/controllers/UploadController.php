<?php
/**
 * User: xiaoge
 * At: 13-6-13 2:14
 * Email: abraham1@163.com
 */


class UploadController extends AController{

    private function savePhoto($name, $dir, $file_name) {
        if(!isset($_FILES[$name])) {
            return false;
        }
        $file = $_FILES[$name];
        if(!empty($file['error'])) {
            return false;
        }
        $ftype = $file['type'];
        if(!in_array($ftype, array('image/jpg', 'image/jpeg', 'image/bmp', 'image/gif', 'image/gif', 'image/png'))) {
            return false;
        }

//        echo CJSON::encode($file);


        $temp_arr = explode(".", $file['name']);
        $file_ext = array_pop($temp_arr);
        $file_ext = trim($file_ext);
        $file_ext = strtolower($file_ext);

        if(!in_array($file_ext, array('jpg', 'jpeg', 'png', 'bmp', 'gif'))) {
            return false;
        }

        if(move_uploaded_file($file['tmp_name'], Yii::app()->params['uploadDir']."/".$dir."/".$file_name.".".$file_ext)) {
            return $dir."/".$file_name.".".$file_ext;
        } else {
            return false;
        }
    }

    public function actionImage() {
        if(!isset($_FILES['image_file'])) {
            $this->sendAjax(null);
        }

        $dir = "image";
        $_tag = time().rand(0, 1000000);
        $i_fn = "img_".$_tag;

        $sif = $this->savePhoto("image_file", $dir, $i_fn);
        if($sif==false) {
            $this->sendAjax(null);
        }
        $s_path = Yii::app()->params['staticServer'];
        $this->sendAjax(array(
            'image_url'=>  $s_path.'/'.$sif
        ), true);
    }

    public function actionAdvertisement() {
        if(!isset($_FILES['image_file'])) {
            $this->sendAjax(null);
        }

        $dir = "image";
        $_tag = time().rand(0, 1000000);
        $i_fn = "ad_".$_tag;

        $sif = $this->savePhoto("image_file", $dir, $i_fn);
        if($sif==false) {
            $this->sendAjax(null);
        }

        $s_path = Yii::app()->params['staticServer'];
        $this->sendAjax(array(
            'image_url'=>  $s_path.'/'.$sif
        ), true);
    }
    public function actionApk() {



        if(!isset($_FILES['apk_file'])) {
            $this->sendAjax(null);
        }
        $file = $_FILES['apk_file'];

        if(!empty($file['error'])) {
            $this->sendAjax($file['error'], false);
        }

        if(strtoupper(substr(PHP_OS, 0, 3)) === 'WIN'){
            $r_s = "protected\\modules\\admin\\controllers";
            $f_s = "download\\kankan.apk";
        } else {
            $r_s = "protected/modules/admin/controllers";
            $f_s = "download/kankan.apk";
        }
        $dir = dirname(__FILE__);

        $filename = str_replace($r_s, $f_s, $dir);

//        if(file_exists($filename)) {
//            unlink($filename);
//        }

        if(move_uploaded_file($file['tmp_name'], $filename)) {
            $this->sendAjax(true, true);
        } else {
            $this->sendAjax(null);
        }

    }
}