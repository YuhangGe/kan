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

    public function rules() {
        return array(
            array('act_type', 'numerical', 'integerOnly'=>true),
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
        if(!$this->validate()) {
            return null;
        }
        if($this->act_type===null) {
            return null;
        }
        $this->_off_len();


        $uid = Yii::app()->user->id;

        return Yii::app()->db->createCommand("SELECT t.act_id, t.act_name, t.begin_time, t.end_time, t.image, u.user_id FROM active t LEFT OUTER JOIN user_active u ON (u.act_id = t.act_id AND u.user_id=$uid) WHERE t.act_type={$this->act_type} order by end_time desc LIMIT {$this->offset}, {$this->length}")
            ->queryAll();
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

}