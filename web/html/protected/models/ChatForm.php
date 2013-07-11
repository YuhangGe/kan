<?php
/**
 * User: xiaoge
 * At: 13-6-10 3:17
 * Email: abraham1@163.com
 */


class ChatForm extends CFormModel{
    public $to_user_id;
    public $from_user_id;
    public $offset;
    public $length;

    public function rules(){
        return array(
            array('to_user_id, from_user_id', 'numerical', 'integerOnly'=>true),
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
        if($this->to_user_id === null) {
            return array();
        }
        $this->_off_len();
        $sql = "SELECT c.*, u.nick_name as user_name, u.small_avatar as user_avatar FROM (select * from chat where to_user_id={$this->to_user_id} and `is_read`=0 order by msg_id desc) as c, user as u
            where c.from_user_id=u.user_id  group by from_user_id order by msg_id desc limit {$this->offset},{$this->length}";
        return Yii::app()->db->createCommand($sql)->queryAll();
    }

    public function all_list() {
        if($this->to_user_id === null) {
            return array();
        }
        $this->_off_len();

        $sql = "SELECT c.*, u.nick_name as user_name, u.small_avatar as user_avatar FROM (select * from chat where to_user_id={$this->to_user_id} order by msg_id desc) as c, user as u
            where c.from_user_id=u.user_id  group by from_user_id order by msg_id desc limit {$this->offset},{$this->length}";
        return Yii::app()->db->createCommand($sql)->queryAll();
    }

    public function all_list_unread_prefix() {
        $this->_off_len();


        $sql = "SELECT c.*, u.nick_name as user_name, u.small_avatar as user_avatar FROM (select * from chat where to_user_id={$this->to_user_id} order by is_read, msg_id desc) as c, user as u
            where c.from_user_id=u.user_id  group by from_user_id order by msg_id desc limit {$this->offset},{$this->length}";

        return Yii::app()->db->createCommand($sql)->queryAll();

    }

    public function unread_count() {
        if($this->to_user_id === null) {
            return array();
        }
        return Chat::model()->count("to_user_id={$this->to_user_id} and is_read=0");
    }
    public function set_read() {
        if($this->from_user_id === null || $this->to_user_id === null) {
            return array();
        }

        $sql = "update chat set is_read=1 where to_user_id={$this->to_user_id} and from_user_id={$this->from_user_id}";
        Yii::app()->db->createCommand($sql)->query();
        return true;
    }

    public function dialog() {
        if($this->from_user_id === null || $this->to_user_id === null) {
            return array();
        }
        $this->_off_len();
        return Chat::model()->findAll('(to_user_id=:tId and from_user_id=:fId) or (to_user_id=:fId and from_user_id=:tId) limit :off, :len',
            array(':tId'=>$this->to_user_id, ':fId'=>$this->from_user_id, ':off'=>$this->offset, ':len'=>$this->length)
        );

    }

}