<?php
/**
 * User: xiaoge
 * At: 13-6-11 5:21
 * Email: abraham1@163.com
 */


class LoginController extends AController{
    public $layout = "//layouts/blank";

    public function filterAccessControl($filterChain) {
        /*
         * 这个Controller不需要权限控制
         */
        $filterChain->run();
    }

    public function actionIndex() {
        $login_failed = false;

        if(isset($_POST['ALoginForm']))
        {
            $model = new ALoginForm();

            $model->attributes=$_POST['ALoginForm'];


            if($model->validate() && $model->login()) {
                //echo CJSON::encode(Yii::app()->user);
                $this->redirect("/admin/default/index");
            }

            $login_failed = true;

        }

        $this->render('index', array('login_failed'=>$login_failed));
    }

    public function actionLogout() {
        Yii::app()->user->logout();
        $this->redirect("/admin/login");
    }
}