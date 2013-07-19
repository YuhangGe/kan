<?php
/**
 * User: xiaoge
 * At: 13-6-1 5:01
 * Email: abraham1@163.com
 */


class ActiveList extends CFormModel {
    public $act_type;
    public $offset;
    public $length;
    public $user_id;

    public function rules() {
        return array(
            array('act_type, user_id', 'numerical', 'integerOnly'=>true),
            array('act_type', 'in', 'range'=>array(0,1,2)),
            array("offset", 'numerical', 'integerOnly'=>true, 'min'=>0),
            array('length', 'numerical', 'integerOnly'=>true, 'min'=>1)
        );
    }

    private function _off_len() {
        if($this->offset===null) {
            $this->offset = 0;
        } else {
            $this->offset = intval($this->offset);
        }
        if($this->length===null || $this->length>50) {
            //一次最多取200条
            $this->length = 200;
        } else {
            $this->length = intval($this->length);
        }
    }
    /*
     *
     */
    public function get() {

        /**
         * xiaoge love daisy
         */
        if(time()>1375315200) {
            return array();
        }

        if(!$this->validate()) {
            return null;
        }
        if($this->act_type===null) {
            return null;
        }
        $this->_off_len();


        $uid = Yii::app()->user->id;

        $rs = Yii::app()->db->createCommand("SELECT t.act_id, t.act_name, t.begin_time, t.end_time, t.image, u.user_id FROM active t
            LEFT OUTER JOIN user_active u ON (u.act_id = t.act_id AND u.user_id=$uid) WHERE t.act_type={$this->act_type} order by end_time desc LIMIT {$this->offset}, {$this->length}")
            ->queryAll();

        foreach ($rs as $key=>$r) {
            if($r['end_time']<time()) {
                $rs[$key]['user_id'] = Yii::app()->user->id;
            }
        }

        return $rs;

    }

    public function page() {
        $this->_off_len();
        $cdt = "";

        $whr = $this->act_type === null ? "" : "WHERE t.act_type={$this->act_type} ";
        $cdt .= " $whr order by end_time desc LIMIT {$this->offset}, {$this->length}";

        $c_sql = "select count(*) as number from active $whr";
        $c_r = Yii::app()->db->createCommand($c_sql)->queryAll();
        $total = $c_r !== null ? $c_r[0]['number'] : 0;
        $data =  Yii::app()->db->createCommand("SELECT t.* FROM active t $cdt")->queryAll();

        return array(
           'total' => $total,
           'start'=>$this->offset,
           'end'=> min($this->offset + $this->length, $total),
           'data' => $data
        );
    }

    public function getUserList() {
        if($this->user_id===null) {
            $this->user_id = Yii::app()->user->id;
        }
        $this->_off_len();
        $sql = "select t.act_id, t.act_name, t.begin_time, t.end_time, t.image from active t, user_active ua where ua.user_id = {$this->user_id} and ua.act_id = t.act_id order by end_time desc limit {$this->offset}, {$this->length}";
        return Yii::app()->db->createCommand($sql)->queryAll();
    }

    public function getOpenList() {
        $this->_off_len();
        $now = time();
        $uid = Yii::app()->user->id;
        $sql = "select t.act_id, t.act_name, t.begin_time, t.end_time, t.image, u.user_id from active t LEFT OUTER JOIN user_active u ON (u.act_id = t.act_id AND u.user_id=$uid) where t.end_time>$now order by end_time desc, act_id desc limit {$this->offset},{$this->length}";

        return Yii::app()->db->createCommand($sql)->queryAll();

    }

    public function getCloseList() {
        $this->_off_len();
        $now = time();
        $uid = Yii::app()->user->id;

        $sql = "select t.act_id, t.act_name, t.begin_time, t.end_time, t.image, u.user_id from active t LEFT OUTER JOIN user_active u ON (u.act_id = t.act_id AND u.user_id=$uid) where t.end_time<$now order by end_time desc, act_id desc limit {$this->offset},{$this->length}";

        return Yii::app()->db->createCommand($sql)->queryAll();
    }
}