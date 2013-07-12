<?php
/**
 * User: xiaoge
 * At: 13-6-27 2:53
 * Email: abraham1@163.com
 */


class NotifyForm extends CFormModel{
    public $user_id;
    public $offset;
    public $length;
    public $notify_id;

    public function rules(){
        return array(
            array('user_id', 'required'),
            array('user_id, notify_id', 'numerical', 'integerOnly'=>true),
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
            //一次最多取50条
            $this->length = 50;
        } else {
            $this->length = intval($this->length);
        }
    }

    public function unread_list() {
        $this->_off_len();
        $sql = "select * from notify where to_user_id={$this->to_user_id} and is_read=0 order by time desc limit {$this->offset},{$this->length}";
        return Yii::app()->db->createCommand($sql)->queryAll();
    }

    public function all_list() {
        $this->_off_len();

        $sql = "select * from notify where to_user_id={$this->user_id} order by time desc limit {$this->offset},{$this->length}";
        return Yii::app()->db->createCommand($sql)->queryAll();
    }

    public function all_list_unread_prefix() {
        $this->_off_len();


        $sql = "select * from notify where to_user_id={$this->user_id} order by is_read, notify_id desc limit {$this->offset},{$this->length}";
        return  Yii::app()->db->createCommand($sql)->queryAll();


    }
    public function unread_count() {
        $sql = "select count(*) as num from notify where to_user_id={$this->user_id} and is_read=0";
        $r = Yii::app()->db->createCommand($sql)->queryAll();
        if($r!==null) {
            return $r[0]['num'];
        } else {
            return 0;
        }
    }
    public function set_read() {
        $sql = "update notify set is_read=1 where to_user_id={$this->user_id}";
        Yii::app()->db->createCommand($sql)->query();
        return true;
    }

    public function set_read_one() {
        $sql = "update notify set is_read=1 where notify_id={$this->notify_id} and to_user_id={$this->user_id}";
        Yii::app()->db->createCommand($sql)->query();
        return true;
    }
}