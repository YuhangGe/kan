<?php
/**
 * User: xiaoge
 * At: 13-5-31 11:36
 * Email: abraham1@163.com
 */


class VideoController extends AController{
    public function actionIndex() {
        $this->render("index");
    }

    public function actionDetail() {
        $this->render("detail");
    }

    public function actionGetDetail() {
        if(!isset($_POST['video_id'])) {
            $this->sendAjax(null);
        }
        $aid = intval($_POST['video_id']);
        if(empty($aid)||$aid<0) {
            $this->sendAjax(null);
        }
        $act = Video::model()->findByPk($aid);
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
        $m = new SearchVideoForm();
        if($st==="video_name") {
            $m->video_name = $sv;
        } elseif ($st==="video_id") {
            $m->video_id = $sv;
        } else {
            $this->sendAjax(null);
        }

        $rtn = array();
        if($m->validate()) {
            $rtn = $m->search(SearchVideoForm::ADMIN_SELECT);
        }

        $this->sendAjax($rtn, true);
    }
}