<?php
/**
 * User: xiaoge
 * At: 13-6-16 12:21
 * Email: abraham1@163.com
 */


class FileHelper {
    public static function directSaveFile($src_file, $dst_file, $dir) {
        $temp_arr = explode(".", $src_file['name']);
        $file_ext = array_pop($temp_arr);
        $file_ext = trim($file_ext);
        $file_ext = strtolower($file_ext);

        if(move_uploaded_file($src_file['tmp_name'], Yii::app()->params['uploadDir']."/".$dir."/".$dst_file.".".$file_ext)) {
            return $dir."/".$dst_file.".".$file_ext;
        } else {
            return false;
        }
    }

    public static function saveVideo($name, $dir, $file_name) {
        if(!isset($_FILES[$name])) {
            return false;
        }
        $file = $_FILES[$name];
        if(!empty($file['error'])) {
            return false;
        }
        $ftype = $file['type'];
        if(!in_array($ftype, array(''))) {
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
    }
    public static function savePhoto($name, $dir, $file_name) {
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
}