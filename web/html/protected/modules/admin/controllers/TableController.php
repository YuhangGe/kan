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
            $this->ord .= " ORDER BY ".$_REQUEST['sOrderBy']." desc";
        }

        $off = intval( $_REQUEST['iDisplayStart']);
        $len = intval( $_REQUEST['iDisplayLength']);
        if($off<0 || $len>50) {
            $off = 0;
            $len = 50;
        }

        $this->lmt .= " LIMIT $off , $len ";


    }
    public function actionActive() {
        $this->check();
        $c_sql = "select count(*) as number from active {$this->ord}";
        $c_r = Yii::app()->db->createCommand($c_sql)->queryAll(true, $this->params);
        if($c_r===null) {
            $this->output();
        }

        $s_sql = "select act_id, act_name, act_type, begin_time, end_time, image from active {$this->ord} {$this->lmt}";
        $s_r = Yii::app()->db->createCommand($s_sql)->queryAll(true, $this->params);
        if($s_r===null) {
            $this->output();
        }

        $this->total_number = $c_r[0]['number'];

        $this->data = $s_r;

        $this->output();
    }
}