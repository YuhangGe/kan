<?php
/**
 * User: xiaoge
 * At: 13-6-2 10:46
 * Email: abraham1@163.com
 */


class PhotoController extends Controller{
    public function accessRules()
    {
        return array(
            array(
                'deny',
                'users'=>array('?'),
            )
        );
    }

    public function actionPost() {

    }

    public function actionLocation() {

    }
    public function actionTime() {

    }

    public function actionHot() {

    }
}