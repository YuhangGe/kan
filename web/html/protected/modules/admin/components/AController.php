<?php
/**
 * User: xiaoge
 * At: 13-5-31 12:52
 * Email: abraham1@163.com
 */


class AController extends Controller{

    public $layout = "//layouts/admin";

    public function filterAccessControl($filterChain) {

        if(!Yii::app()->user->isAdmin()) {
            $this->redirect("/admin/login");
        }
        $filterChain->run();
    }

}