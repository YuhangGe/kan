<?php
/**
 * User: xiaoge
 * At: 13-5-24 11:19
 * Email: abraham1@163.com
 */


class UploadController extends Controller{
    public function accessRules()
    {
        return array(
            array('deny',
                'actions'=>array(),
                'users'=>array('?'),
            )
        );
    }

    public function actionPhoto() {

    }

    public function actionAvatar() {

    }


}