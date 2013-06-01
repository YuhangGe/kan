<?php
/**
 * User: xiaoge
 * At: 13-6-1 4:52
 * Email: abraham1@163.com
 */


class SearchController extends Controller{
    public function accessRules() {
        return array(
            array(
                'deny',
                'users'=>array('?'),
            )
        );
    }

    public function actionUser() {

    }
}