<?php
/**
 * User: xiaoge
 * At: 13-6-12 11:59
 * Email: abraham1@163.com
 */


class TableController extends AController{

    public $whr = "";
    public $ord = "";
    public $lmt = "";
    public $params = array();
    public $count = 0;
    public $total_number = 0;
    public $data = array();


    private function output() {
        $rtn = array(
            'sEcho'=>$_REQUEST['sEcho'],
            'iTotalRecords'=> $this->total_number,
            'iTotalDisplayRecords'=> $this->total_number,
            'aaData'=>$this->data
        );
        echo CJSON::encode($rtn);
        Yii::app()->end();
    }
    private function check() {
        if (!isset( $_REQUEST['iDisplayStart'] ) || ! isset($_REQUEST['iDisplayLength']))
        {
            $this->output();
        }
        if(!empty($_REQUEST['sOrderBy'])) {
            $this->ord .= " ORDER BY ".strtr($_REQUEST['sOrderBy'],array(';'=>' ', '\''=>' ', '"'=>' '))." desc";
        }

        $off = intval( $_REQUEST['iDisplayStart']);
        $len = intval( $_REQUEST['iDisplayLength']);
        if($off<0 || $len>100) {
            $off = 0;
            $len = 100;
        }

        $this->lmt .= " LIMIT $off , $len ";


    }
    private function getData($table, $select = " * ", $condition=" ") {
        $this->check();
        $this->doGetData($table, $select, $condition);
    }

    private function doGetData($table, $select=" * ", $condition = "") {
        $c_sql = "select count(*) as number from $table $condition";
        $c_r = Yii::app()->db->createCommand($c_sql)->queryAll(true, $this->params);
        if($c_r===null) {
            $this->output();
        }

        $s_sql = "select $select from $table $condition {$this->ord} {$this->lmt}";
        $s_r = Yii::app()->db->createCommand($s_sql)->queryAll(true, $this->params);
        if($s_r===null) {
            $this->output();
        }

        $this->total_number = $c_r[0]['number'];

        $this->data = $s_r;

        $this->output();
    }
    public function actionActive() {
        $this->ord = "order by act_id desc";
        $this->getData("active", " act_id, act_name, act_type, begin_time, end_time, image ");
    }

    public function actionUser() {
        $this->ord = "order by user_id desc";
        $this->getData("user", " user_id, level, sex, nick_name, birthday, email, phone, small_avatar, fan_number, friend_number ");
    }

    public function actionStarAll() {
        $this->ord = "order by time desc";
        $this->getData("star");
    }

    public function actionStarSelected() {
        if(!isset($_POST['act_id'])) {
            $this->output();
        }
        $this->check();
        $this->ord = "order by act_score desc";
        $this->params[':aId'] = $_POST['act_id'];

        $c_sql = "select count(*) as number from star where act_id=:aId";
        $c_r = Yii::app()->db->createCommand($c_sql)->queryAll(true, $this->params);
        if($c_r===null) {
            $this->output();
        }

        $s_sql = "select star.* from star where star.act_id=:aId {$this->ord} {$this->lmt}";
        $s_r = Yii::app()->db->createCommand($s_sql)->queryAll(true, $this->params);
        if($s_r===null) {
            $this->output();
        }

        $this->total_number = $c_r[0]['number'];

        $this->data = $s_r;

        $this->output();
    }

    public function actionStarRank() {
        if(!isset($_POST['act_id'])) {
            $this->output();
        }
        $this->check();
        $this->params[':aId']=$_POST['act_id'];

        $this->total_number = UserActive::model()->count("act_id=:aId", $this->params);


        $sql = "select photo.user_id, photo.act_id, photo.user_name, sum(vote_number) as act_vote, sum(view_number) as act_view, sum(vote_number) * 10 + sum(view_number)  as act_score, star.user_id, star.act_id as star_id from photo left join star on photo.user_id=star.user_id and photo.act_id=star.act_id where photo.act_id=:aId group by user_id, act_id order by act_score desc {$this->lmt} ";

        $s_r = Yii::app()->db->createCommand($sql)->queryAll(true, $this->params);
        if($s_r===null || count($s_r)===0) {
            $this->total_number = 0;
            $this->output();
        }
        $this->data = $s_r;

        $this->output();
    }

    public function actionVideo() {
        $this->ord = "order by video_id desc";
        $this->getData("video", " * ");

    }

    public function actionUserVideo() {
        if(!isset($_POST['user_id'])) {
            $this->output();
        }
        $this->check();
        $this->params[':uId']=$_POST['user_id'];
        $this->total_number = Video::model()->count("user_id=:uId", array(":uId"=>$_POST['user_id']));

        $sql = "select video.*, if(winner.video_id is NULL, 0, 1)  as is_winner from video left outer join winner on winner.video_id=video.video_id and winner.user_id=:uId where video.user_id=:uId order by video.upload_time desc {$this->lmt} ";

        $s_r = Yii::app()->db->createCommand($sql)->queryAll(true, $this->params);
        if($s_r===null || count($s_r)===0) {
            $this->total_number = 0;
            $this->output();
        }
        $this->data = $s_r;

        $this->output();

    }
    public function actionNews() {
        $this->ord = "order by news_id desc";
        $this->getData("news");
    }

    public function actionNotify() {
        $this->check();
        if(!empty($_POST['user_id'])) {
            $this->params[':uId']=$_POST['user_id'];
            $this->total_number = Notify::model()->count("to_user_id=:uId", array(":uId"=>$_POST['user_id']));
            $ad = "and n.to_user_id=:uId and u.user_id=:uId";
        } else {
            $ad = "";
            $this->total_number = Notify::model()->count();
        }

        $sql = "select n.*, u.nick_name, u.user_id from notify n, user u where n.to_user_id=u.user_id $ad order by notify_id desc {$this->lmt}";

        $s_r = Yii::app()->db->createCommand($sql)->queryAll(true, $this->params);
        if($s_r===null || count($s_r)===0) {
            $this->total_number = 0;
            $this->output();
        }
        $this->data = $s_r;

        $this->output();
    }
    public function actionWinnerRank() {
        $this->check();
        $this->total_number = Video::model()->count();
        $sql = "select video.* , vote_number * 10 + view_number as score, w.user_id as winner_id from video left join winner w on video.video_id=w.video_id order by upload_time desc {$this->lmt}";

        $s_r = Yii::app()->db->createCommand($sql)->queryAll(true, $this->params);
        if($s_r===null || count($s_r)===0) {
            $this->total_number = 0;
            $this->output();
        }
        $this->data = $s_r;

        $this->output();
    }

    public function actionWinnerSelected() {
        $this->check();
        $this->total_number = Winner::model()->count();

        $sql = "select w.`time` as `time`, w.poster_url as winner_poster, v.user_id, v.video_name, v.video_id, v.user_name from winner w, video v where w.video_id=v.video_id order by w.`time` desc {$this->lmt}";

        $s_r = Yii::app()->db->createCommand($sql)->queryAll(true, $this->params);
        if($s_r===null || count($s_r)===0) {
            $this->total_number = 0;
            $this->output();
        }
        $this->data = $s_r;

        $this->output();
    }
}