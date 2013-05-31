<?php
/**
 * User: xiaoge
 * At: 13-5-24 11:19
 * Email: abraham1@163.com
 */


class UploadController extends Controller{
    function actionIndex() {
        $this->actionImage();
    }
    function actionImage() {
        print_r($_FILES);
        move_uploaded_file($_FILES['file']['tmp_name'], "../static/".$_FILES['file']['name']);
    }
}