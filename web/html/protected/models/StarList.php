<?php
/**
 * User: xiaoge
 * At: 13-6-25 1:52
 * Email: abraham1@163.com
 */


class StarList extends CFormModel{
    public $type;
    public $offset;
    public $length;
    public $act_id;

    public function rules() {
        return array(
            array('type', 'required'),
            array('type', 'in', 'range'=>array("time", "act")),
            array("act_id", 'numerical', 'integerOnly'=>true),
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

        $this->_off_len();


        if($this->type === "time") {
            $sql = "select star.*, act.act_name from star, active act where act.act_id=star.act_id order by time desc limit {$this->offset}, {$this->length}";
            return Yii::app()->db->createCommand($sql)->queryAll();

        } elseif($this->type==="act" && $this->act_id!==null) {
            $sql = "select star.*, act.act_name from star, active act where star.act_id={$this->act_id} and act.act_id=star.act_id order by time desc limit {$this->offset}, {$this->length}";
            return Yii::app()->db->createCommand($sql)->queryAll();

        } else {
            return array();
        }

    }
}