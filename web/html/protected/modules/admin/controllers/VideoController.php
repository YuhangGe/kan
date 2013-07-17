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

    public function actionUser() {
        $this->render("user");
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

    public function actionPoster() {
        if(!isset($_FILES['image_file']) || empty($_POST['video_id'])) {
            $this->sendAjax(null);
        }
        $r = Video::model()->findByPk($_POST['video_id']);
        if($r===null) {
            $this->sendAjax(null);
        }
        $dir = "poster";
        $_tag = time().rand(0, 10000);
        $i_fn = "video_".$_POST['video_id']."_".$_tag;

        $sif = FileHelper::savePhoto("image_file", $dir, $i_fn);
        if($sif===false) {
            $this->sendAjax(null);
        }

       if(Video::model()->updateAll(array('poster_url'=>Yii::app()->params['staticServer']."/".$sif), "video_id=:pId", array(':pId'=>$_POST['video_id']))){
           $this->sendAjax(true, true);
       } else {
           $this->sendAjax(null);
       }

    }

    public function actionModifyHot() {
        if(!isset($_POST['video_id']) || !isset($_POST['vote_number']) || !isset($_POST['view_number'])) {
            $this->sendAjax(null);
        }

        $vn1 = intval($_POST['vote_number']);
        $vn2 = intval($_POST['view_number']);

        if(($vn1!==0 && empty($vn1)) || ($vn2!==0 && empty($vn2))) {
            $this->sendAjax(null);
        }

        if(Video::model()->updateByPk($_POST['video_id'], array("vote_number"=>$vn1, "view_number"=>$vn2))){
            $this->sendAjax(true, true);
        } else {
            $this->sendAjax(null);
        }
    }

    public function actionModify() {
        $m = new StarForm();
        $m->attributes = $_POST;

        if($m->validate() && $m->video()) {
            $this->sendAjax(true, true);
        } else {
            $this->sendAjax(null);
        }

    }

    public function actionDelete() {
        if(!isset($_POST['password']) || !isset($_POST['video_id'])) {
            $this->sendAjax(null);
        }
        if(PwdHelper::encode($_POST['password'])!==Yii::app()->params['adminPassword']) {
            $this->sendAjax(null);
        }
        $aid = intval($_POST['video_id']);
        if(empty($aid)) {
            $this->sendAjax(null);
        }

        Winner::model()->deleteAllByAttributes(array("video_id"=>$aid));
        VideoVote::model()->deleteAllByAttributes(array("video_id"=>$aid));

        if(Video::model()->deleteAllByAttributes(array("video_id"=>$aid))){
            $this->sendAjax(true, true);
        } else {
            $this->sendAjax(null);
        }


    }
}