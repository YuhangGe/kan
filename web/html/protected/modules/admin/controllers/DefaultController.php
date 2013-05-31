<?php

class DefaultController extends AController
{
    public function filterAccessControl($filterChain) {
        /*
         * 这个Controller包括Login和Logout，不需要权限控制
         */
        $filterChain->run();
    }

    private function checkAccess() {
        if(!Yii::app()->user->isAdmin()) {
            $this->redirect("/admin/default/login");
        }
    }
	public function actionIndex()
	{
        $this->checkAccess();

		$this->render('index');
	}
    public function actionSearch() {
        $this->checkAccess();

    }
    public function actionLogin() {
        $model = new ALoginForm();
        if(isset($_POST['ALoginForm']))
        {
            $model->attributes=$_POST['ALoginForm'];


            if($model->validate() && $model->login()) {
                //echo CJSON::encode(Yii::app()->user);
                $this->redirect("/admin/default/index");
            }


        }

        $this->render('login', array("model"=>$model));
    }

    public function actionLogout() {
        Yii::app()->user->logout();
        $this->redirect("/admin/default/login");
    }

}