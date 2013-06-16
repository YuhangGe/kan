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
        if($off<0 || $len>200) {
            $off = 0;
            $len = 200;
        }

        $this->lmt .= " LIMIT $off , $len ";


    }
    private function getData($table, $select = " * ", $condition=" ") {
        $this->check();
        $this->doGetData($table, $select, $condition);
    }

    private function doGetData($table, $select=" * ", $condition = "") {
        $c_sql = "select count(*) as number from $table $condition {$this->ord}";
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
        $this->getData("active", " act_id, act_name, act_type, begin_time, end_time, image ");
    }

    public function actionUser() {
        $this->getData("user", " user_id, level, sex, nick_name, birthday, email, phone, small_avatar, fan_number, friend_number ");
    }

    public function actionStarSelected() {
        if(!isset($_POST['act_id'])) {
            $this->output();
        }
        $this->check();
        $this->ord = "order by act_score desc";
        $this->params[':aId'] = $_POST['act_id'];
        $this->doGetData("star", " * ", "where act_id=:aId");
    }

    public function actionStarRank() {
        if(!isset($_POST['act_id'])) {
            $this->output();
        }
        $this->total_number = 30;
        $sql = "select user_id, act_id, user_name, sum(vote_number) as act_vote, sum(view_number) as act_view, sum(vote_number) * 10 + sum(view_number)  as act_score from photo where act_id=:aId group by user_id, act_id order by act_score desc limit {$this->total_number}";
        $this->params[':aId']=$_POST['act_id'];

        $s_r = Yii::app()->db->createCommand($sql)->queryAll(true, $this->params);
        if($s_r===null || count($s_r)===0) {
            $this->total_number = 0;
            $this->output();
        }
        $this->data = $s_r;

        $this->output();
    }
}