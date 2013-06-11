<?php

class DefaultController extends AController
{


    private function checkAccess() {
        if(!Yii::app()->user->isAdmin()) {
            $this->redirect("/admin/default/login");
        }
    }
	public function actionIndex()
	{

		$this->render('index');
	}
    public function actionAdd() {
        $this->render("index");
    }


}