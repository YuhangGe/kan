<?php
/**
 * User: xiaoge
 * At: 13-5-31 10:33
 * Email: abraham1@163.com
 */


class UserController extends AController {
    public function actionIndex() {
        $this->render("index");
    }

    public function actionDetail() {
        $this->render("detail");
    }

    public function actionGetDetail() {
        if(!isset($_POST['user_id'])) {
            $this->sendAjax(null);
        }
        $aid = intval($_POST['user_id']);
        if(empty($aid)||$aid<0) {
            $this->sendAjax(null);
        }
        $act = User::model()->findByPk($_POST['user_id']);
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
        $m = new SearchUserForm();
        if($st==="nick_name") {
            $m->nick_name = $sv;
        } elseif ($st==="user_id") {
            $m->user_id = $sv;
        } else {
            $this->sendAjax(null);
        }

        $rtn = array();
        if($m->validate()) {
            $rtn = $m->search(SearchUserForm::ADMIN_SELECT);
        }

        $this->sendAjax($rtn, true);
    }

    public function actionStar() {
        $this->render("star");
    }
}