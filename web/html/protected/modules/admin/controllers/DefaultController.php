<?php

class DefaultController extends AController
{

	public function actionIndex()
	{
		$this->render('index');
	}

    public function actionAdd() {
        $this->render("add");
    }

    public function actionDetail() {
        $this->render("detail");
    }

    public function actionGetDetail() {
        if(!isset($_POST['act_id'])) {
            $this->sendAjax(null);
        }
        $aid = intval($_POST['act_id']);
        if(empty($aid)||$aid<0) {
            $this->sendAjax(null);
        }
        $act = Active::model()->findByPk($_POST['act_id']);
        if($act===null) {
            $this->sendAjax(null);
        } else {
            $this->sendAjax($act, true);
        }
    }

    public function actionSearch() {
        if(!isset($_POST['search_type']) || !isset($_POST['search_value'])) {
            $this->sendAjax(null);
        }
        $st = $_POST['search_type'];
        $sv = $_POST['search_value'];
        $m = new SearchActiveForm();
        if($st==="act_name") {
            $m->act_name = $sv;
        } elseif ($st==="act_id") {
            $m->act_id = $sv;
        } else {
            $this->sendAjax(null);
        }

        $rtn = array();
        if($m->validate()) {
            $rtn = $m->search(SearchActiveForm::ADMIN_SELECT);
        }

        $this->sendAjax($rtn, true);
    }

    public function actionCreate() {
        $m = new Active();
        $m->attributes = $_POST;
        if($m->validate() && $m->save()) {
            if(mkdir(Yii::app()->params['uploadDir']."/photo/".$m->act_id)) {
                $this->sendAjax(array("act_id"=>$m->act_id), true);
            } else {
                $this->sendAjax(null);
            }
        } else {
            $this->sendAjax(null);
        }
    }

    public function actionModify() {
        if(!isset($_POST['act_id'])) {
            $this->sendAjax(null);
        }
        $aid = intval($_POST['act_id']);

        $m = Active::model()->findByPk($aid);

        if($m===null) {
            $this->sendAjax(null);
        }

        $m->attributes = $_POST;
        if($m->validate() && $m->save()) {
            $this->sendAjax(array('act_id'=>$m->act_id), true);
        } else {
            $this->sendAjax(null);
        }
    }

    public function actionDelete() {
        if(!isset($_POST['password']) || !isset($_POST['act_id'])) {
            $this->sendAjax(null);
        }
        if(PwdHelper::encode($_POST['password'])!==Yii::app()->params['adminPassword']) {
            $this->sendAjax(null);
        }
        $aid = intval($_POST['act_id']);
        if(empty($aid)) {
            $this->sendAjax(null);
        }


        if(UserActive::model()->deleteAllByAttributes(array("act_id"=>$aid)) &&
            Active::model()->deleteByPk($aid)){
            $this->sendAjax(true, true);
        } else {
            $this->sendAjax(null);
        }


    }
}